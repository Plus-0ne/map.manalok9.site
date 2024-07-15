<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CustomHelper;
use App\Http\Controllers\Controller;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class AdminsController extends Controller
{
    /**
     * Admin accounts page
     * @return \Illuminate\Contracts\View\View
     */
    public function index() {
        JavaScript::put([
            'urlBase' => URL::to('/'),
            'assetUrl' => asset('/')
        ]);

        // Get all markers
        $admins = Admins::all();

        $data = [
            'title' => 'Admin account lists',
            'admins' => $admins
        ];
        return view('admin.admins',$data);
    }

    /**
     * Create new admin
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
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'email_address' => 'required|email:rfc,dns',
            'password' => 'required',
            'verify_password' => 'required',
        ];
        // Create warning messages
        $warningMessage = [
            'last_name.required' => 'Please enter last name!',
            'first_name.required' => 'Please enter first name!',
            'middle_name.required' => 'Please enter middle name / Initial!',
            'email_address.required' => 'Please enter email address!',
            'email_address.email' => 'Please enter a valid email address!',
            'password.required' => 'Please enter password!',
            'verify_password.required' => 'Please verify your password!',
        ];

        // Validate requests
        $validate = Validator::make($request->all(),$rules,$warningMessage);

        // If validation fails
        if ($validate->fails()) {
            $data = [
                'status' => 'warning',
                'message' => $validate->errors()->first()
            ];
            return response()->json($data);
        }

        // Compare password
        if ($request->input('password') != $request->input('verify_password')) {
            $data = [
                'status' => 'warning',
                'message' => 'Password did not matched!'
            ];
            return response()->json($data);
        }

        // Get admin details using email address
        $emailExist = Admins::where('email_address' , $request->input('email_address'))->first();

        // If email address exist
        if ($emailExist) {
            $data = [
                'status' => 'warning',
                'message' => 'Email address already registered!'
            ];
            return response()->json($data);
        }

        // Create uuid
        do {
            $uuid = Str::uuid();
        } while (Admins::where('uuid', '=', $uuid)->first()  instanceof Admins);

        // Create attribute and values
        $data = [
            'uuid' => $uuid,
            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'email_address' => $request->input('email_address'),
            'password' => Hash::make($request->input('password')),
            'status' => 1
        ];

        // Create admin record
        $create = Admins::create($data);

        // If admin not saved
        if (!$create->save()) {
            $data = [
                'status' => 'error',
                'message' => 'Failed to create new admin!'
            ];
            return response()->json($data);
        }

        // Admin added successfully
        $data = [
            'status' => 'success',
            'message' => 'Admin created successfully!'
        ];
        return response()->json($data);
    }

    /**
     * Delete admin
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request) {

        // Check ajax request
        if (!$request->ajax()) {
            $data = [
                'status' => 'error',
                'message' => 'Invalid Request! Please try again.'
            ];
            return response()->json($data);
        }

        $countAdmins = Admins::all();

        if ($countAdmins->count() < 1) {
            $data = [
                'status' => 'warning',
                'message' => 'No admin found!'
            ];
            return response()->json($data);
        }

        if ($countAdmins->count() == 1) {
            $data = [
                'status' => 'warning',
                'message' => 'You need 1 admin registered in this web app!'
            ];
            return response()->json($data);
        }

        // Convert uuid to id
        $id = CustomHelper::convertUuidToId($request->input('uuid'),Admins::class);

        // Check if id is null
        if ($id == null) {
            $data = [
                'status' => 'warning',
                'message' => 'ID not found!'
            ];
            return response()->json($data);
        }



        $admin = Admins::find($id);


        // Check Admin self delete
        if ($admin->id == Auth::guard('admins')->user()->id) {
            $data = [
                'status' => 'warning',
                'message' => 'Account cannot be deleted!'
            ];
            return response()->json($data);
        }

        if (!$admin->delete()) {
            $data = [
                'status' => 'error',
                'message' => 'Failed to delete admin!'
            ];
            return response()->json($data);
        }

        $data = [
            'status' => 'success',
            'message' => 'Admin deleted successfully!'
        ];
        return response()->json($data);
    }
}
