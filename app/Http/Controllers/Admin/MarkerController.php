<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarkerAttachmentsModel;
use App\Models\MarkerModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MarkerController extends Controller
{
    /**
     * Create new marker pin
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request) {

        // Check if request is ajax
        if (!$request->ajax()) {

            $data = [
                'status' => 'error',
                'message' => 'Invalid request! Please try again.'
            ];

            return response()->json($data);
        }

        // Validate all request
        $validate = $this->validateRequest($request);

        // Return json response if validate failed
        if ($validate) {
            return response()->json($validate);
        }

        // Upload image file then get the temp folder path
        $uploadToTemp = $this->uploadMarkerImageFile($request);
        if ($uploadToTemp['status'] != 'success') {

            $data = [
                'status' => 'warning',
                'message' => $uploadToTemp['message']
            ];

            return response()->json($data);

        }

        // Initiate DB transaction
        DB::beginTransaction();

        // Create uuid
        do {
            $uuid = Str::uuid();
        } while (MarkerModel::where('uuid', '=', $uuid)->first()  instanceof MarkerModel);

        // Create new marker
        $create = MarkerModel::create([
            'uuid' => $uuid,
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'title' => $request->input('location'),
            'description' => $request->input('description'),
            'thumbnail' => 'null',
        ]);


        // If marker is not saved remove image in temp folder
        if (!$create->save()) {

            File::delete($uploadToTemp['file_details']['path']);

            $data = [
                'status' => 'warning',
                'message' => 'Failed to create new marker!'
            ];

            return response()->json($data);
        }

        // Create uuid
        do {
            $auuid = Str::uuid();
        } while (MarkerAttachmentsModel::where('uuid', '=', $auuid)->first()  instanceof MarkerAttachmentsModel);

        // Move file
        try {
            $newPath = public_path() . '/img/markers/';
            $oldPath = $uploadToTemp['file_details']['path'];

            if (!File::exists($oldPath)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Source file does not exist.'
                ]);
            }

            if (!File::exists($newPath)) {
                File::makeDirectory($newPath, $mode = 0777, true, true);
            }

            $fileName = basename($oldPath); // Extract the filename from the old path
            $newFilePath = $newPath . $fileName;

            if (!File::move($oldPath, $newFilePath)) {
                File::delete($oldPath);

                DB::rollback();
            }




        } catch (\Throwable $th) {
            Log::error('File move error: ', ['exception' => $th]);

            File::delete($uploadToTemp['file_details']['path']);

            DB::rollback();

            $data = [
                'status' => 'warning',
                'message' => $th->getMessage()
            ];

            return response()->json($data);
        }

        // Save marker file image details to marker attachments table
        $createAttach = MarkerAttachmentsModel::create([
            'uuid' => $auuid,
            'marker_uuid' => $uuid,
            'title' => null,
            'description' => null,
            'path' => 'img/markers/'.$fileName,
            'format' => 'img',
            'type' => 'image',
        ]);

        // If not saved rollback database transaction and remove file image in temp folder
        if (!$createAttach->save()) {

            File::delete($newFilePath);

            DB::rollback();

            $data = [
                'status' => 'warning',
                'message' => 'Failed to save attachment details!'
            ];

            return response()->json($data);
        }

        DB::commit();

        $data = [
            'status' => 'success',
            'message' => 'New marker has been added!'
        ];

        return response()->json($data);

    }

    /**
     * Validate request for creating new marker
     * @param Request $request
     * @return string|array
     */
    public function validateRequest($request) {
        // Check if image has been uploaded return warning message if image not uploaded
        if (!$request->hasFile('file_image')) {
            $data = [
                'status' => 'warning',
                'message' => 'Please upload image for 360 feature!'
            ];

            return $data;
        }

        // Create validation rules
        $validate = Validator::make($request->all(),[
            'latitude' => 'required',
            'longitude' => 'required',
            'location' => 'required',
            'file_image' => 'mimes:jpg,bmp,png'
        ],[
            'latitude.required' => 'Latitude value not found! Please try again.',
            'longitude.required' => 'Longitude value not found! Please try again. ',
            'location.required' => 'Please enter location!',
            'file_image.mimes' => 'Please upload a validate image!'
        ]);

        // If validation rules fails return warning message
        if ($validate->fails()) {
            $data = [
                'status' => 'warning',
                'message' => $validate->errors()->first()
            ];

            return $data;
        }
    }

    /**
     * Upload marker image file to temp file
     * @param Request $request
     * @return string|array
     */
    public function uploadMarkerImageFile($request) {
        $path = public_path().'/img/markers';
        $file = $request->file('file_image');
        $imageName = time().'.'.$file->getClientOriginalExtension();
        $extension = $file->getClientOriginalExtension();

        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        try {

            $tempPath = public_path('/img/temp/');

            $file->move($tempPath, $imageName);


            $data = [
                'status' => 'success',
                'file_details' => [

                    'title' => null,
                    'description' => null,
                    'path' => $tempPath.$imageName,
                    'format' => $extension,
                    'type' => 'image',

                ],
            ];

            return $data;

        } catch (\Throwable $th) {

            $data = [
                'error' => 'error',
                'message' => $th
            ];

            return $data;
        }
    }

    /**
     * Get all markers
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request) {
        if (!$request->ajax()) {
            $data = [
                'status' => 'error',
                'message' => 'Invalid request! Please try again.'
            ];

            return response()->json($data);
        }

        $markers = MarkerModel::with('markerAttachment')->get();

        $data = [
            'status' => 'success',
            'message' => 'Marker fetched successfully!',
            'markers' => $markers
        ];

        return response()->json($data);
    }

    /**
     * Delete marker
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request) {
        // Check if request is ajax
        if (!$request->ajax()) {
            $data = [
                'status' => 'error',
                'message' => 'Invalid request! Please try again.'
            ];

            return response()->json($data);
        }

        // Get marker
        $marker = MarkerModel::where('uuid',$request->input('uuid'))->first();

        // Check if marker is deleted
        if (!$marker->delete()) {
            $data = [
                'status' => 'error',
                'message' => 'Failed to delete marker! Please try again.'
            ];

            return response()->json($data);
        }

        // Return json success
        $data = [
            'status' => 'success',
            'message' => 'Marker deleted successfully!'
        ];

        return response()->json($data);
    }

    /**
     * Move marker to new position
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function move(Request $request) {
        // Check if request is ajax
        if (!$request->ajax()) {
            $data = [
                'status' => 'error',
                'message' => 'Invalid request! Please try again.'
            ];

            return response()->json($data);
        }

        // Create validation rules
        $rules = [
            'id' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ];

        // Create validation messages
        $warningMessage = [
            'id.required' => 'ID value not found!',
            'lat.required' => 'Latitude value not found!',
            'lng.required' => 'Longitude value not found!'
        ];

        // Validate request
        $validate = Validator::make($request->all(),$rules,$warningMessage);

        // If validation failes return warning message
        if ($validate->fails()) {
            $data = [
                'status' => 'warning',
                'message' => $validate->errors()->first()
            ];

            return response()->json($data);
        }

        // Find marker
        $marker = MarkerModel::find($request->input('id'));

        // If marker not found return warning response
        if (!$marker) {
            $data = [
                'status' => 'warning',
                'message' => 'Marker not found!'
            ];

            return response()->json($data);
        }

        // Update marker values
        $marker->latitude = $request->input('lat');
        $marker->longitude = $request->input('lng');

        // If mark is not saved return warning response
        if (!$marker->save()) {
            $data = [
                'status' => 'error',
                'message' => 'Failed to update marker!'
            ];

            return response()->json($data);
        }

        // If saved return succes response
        $data = [
            'status' => 'success',
            'message' => 'Marker moved successfully!'
        ];

        return response()->json($data);

    }
}
