<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CustomHelper;
use App\Http\Controllers\Controller;
use App\Models\MarkersIcon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class IconController extends Controller
{
    /**
     * Show icon page
     * @return \Illuminate\Contracts\View\View
     */
    public function index() {
        JavaScript::put([
            'urlBase' => URL::to('/'),
            'assetUrl' => asset('/')
        ]);

        $marker_icons = MarkersIcon::all();

        $data = [
            'title' => 'Icons',
            'marker_icons' => $marker_icons
        ];
        return view('admin.icons',$data);
    }

    /**
     * Create new icon
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request) {
        // Check ajax request
        if (!$request->ajax()) {
            $data = [
                'status' => 'error',
                'message' => 'Invalid Request! Please try again.'
            ];
            return response()->json($data);
        }

        // Create validation rules
        $rules = [
            'title' => 'required',
            'file' => 'image|mimes:png,PNG'
        ];

        // Create warning messages
        $warningMessage = [
            'title.required' => 'Please enter icon title!',
            'file.image' => 'Please upload image file!',
            'file.mimes' => 'Invalid file format! Please upload PNG.'
        ];

        // Validate request
        $validate = Validator::make($request->all(),$rules,$warningMessage);

        // Throw validation warning messages
        if ($validate->fails()) {
            $data = [
                'status' => 'warning',
                'message' => $validate->errors()->first()
            ];

            return response()->json($data);
        }

        // Attempt to upload icon
        $uploadIcon = CustomHelper::uploadIconImages($request);

        // Check if error occurred while uploading
        if ($uploadIcon['status'] == 'error') {

            return response()->json($uploadIcon);

        }

        // Create uuid
        do {
            $uuid = Str::uuid();
        } while (MarkersIcon::where('uuid', '=', $uuid)->first()  instanceof MarkersIcon);

        $create = MarkersIcon::create([
            'uuid' => $uuid,
            'name' => $request->input('title'),
            'path' => $uploadIcon['path'],
            'type' => $uploadIcon['type'],
            'format' => $uploadIcon['format'],
        ]);

        if (!$create->save()) {

            File::delete($uploadIcon['fullpath']);

            $data = [
                'status' => 'error',
                'message' => 'Failed to create new icon!'
            ];

            return response()->json($data);
        }

        $data = [
            'status' => 'success',
            'message' => 'New marker icon created!'
        ];

        return response()->json($data);
    }

    public function remove(Request $request) {
        // Check ajax request
        if (!$request->ajax()) {
            $data = [
                'status' => 'error',
                'message' => 'Invalid Request! Please try again.'
            ];
            return response()->json($data);
        }

        // Create validation rules and validate request
        $validate = Validator::make($request->all(),[
            'uuid' => 'required'
        ],[
            'uuid.required' => 'UUID not found! Please try again.'
        ]);

        // Throw validation warning message
        if ($validate->fails()) {
            $data = [
                'status' => 'warning',
                'message' => $validate->errors()->first()
            ];
            return response()->json($data);
        }

        // Convert uuid to id
        $id = CustomHelper::convertUuidToId($request->input('uuid'),MarkersIcon::class);

        // Find Marker icon using id
        $icon = MarkersIcon::find($id);

        // If icon not found
        if (!$icon) {
            $data = [
                'status' => 'warning',
                'message' => 'Marker icon not found!'
            ];
            return response()->json($data);
        }

        // If icon not deleted
        if (!$icon->delete()) {
            $data = [
                'status' => 'warning',
                'message' => 'Failed to delete icon!'
            ];
            return response()->json($data);
        }

        // If icon is deleted
        $data = [
            'status' => 'success',
            'message' => 'Icon deleted!'
        ];
        return response()->json($data);
    }
}
