<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class AccountController extends Controller
{
    /**
     * Show profile page
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
            'title' => 'Profile setting',
            'admins' => $admins
        ];
        return view('admin.profile',$data);
    }

    /**
     * Update name
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function nameUpdate(Request $request) {

        // Check if request is ajax
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
            'middle_name' => 'required'
        ];

        // Create validation messages
        $warningMessage = [
            'last_name.required' => 'Please enter your last name!',
            'first_name.required' => 'Please enter your first name!',
            'middle_name.required' => 'Please enter your middle name!'
        ];

        // Validate requests
        $validate = Validator::make($request->all(),$rules,$warningMessage);

        // Return validation message if failed
        if ($validate->fails()) {
            $data = [
                'status' => 'warning',
                'message' => $validate->errors()->first()
            ];
            return response()->json($data);
        }

        // Get authenticated admin details
        $update = Auth::guard('admins')->user();

        // Update authenticated admin details
        $update->last_name = $request->input('last_name');
        $update->first_name = $request->input('first_name');
        $update->middle_name = $request->input('middle_name');

        // Return warning message if saving failed
        if (!$update->save()) {

            $data = [
                'status' => 'warning',
                'message' => 'Failed to update details!'
            ];
            return response()->json($data);
        }

        $data = [
            'status' => 'success',
            'message' => 'Update success!'
        ];
        return response()->json($data);

    }

    /**
     * Password update
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function passwordUpdate(Request $request) {

        // Check if request is ajax
        if (!$request->ajax()) {
            $data = [
                'status' => 'error',
                'message' => 'Invalid Request! Please try again.'
            ];
            return response()->json($data);
        }

        // Create validation rules
        $rules = [
            'cPassword' => 'required',
            'nPassword' => 'required',
            'vPassword' => 'required'
        ];

        // Create validation messages
        $warningMessage = [
            'cPassword.required' => 'Please enter your current password!',
            'nPassword.required' => 'Please enter your new password!',
            'vPassword.required' => 'Please verify your new password!'
        ];

        // Validate requests
        $validate = Validator::make($request->all(),$rules,$warningMessage);

        // Return validation message if failed
        if ($validate->fails()) {
            $data = [
                'status' => 'warning',
                'message' => $validate->errors()->first()
            ];
            return response()->json($data);
        }

        // Get authenticated admin details
        $update = Auth::guard('admins')->user();

        // Check if current password is correct
        if (!Hash::check($request->input('cPassword'),$update->password)) {
            $data = [
                'status' => 'warning',
                'message' => 'Incorrect password!'
            ];
            return response()->json($data);
        }

        // Checkif password is verified
        if (!$request->input('nPassword') === $request->input('vPassword')) {
            $data = [
                'status' => 'warning',
                'message' => 'Password did not matched! Please verify again.'
            ];
            return response()->json($data);
        }

        // Update current password with new password
        $update->password = Hash::make($request->input('nPassword'));

        // Return error message if update not successful
        if (!$update->save()) {
            $data = [
                'status' => 'error',
                'message' => 'Failed to update password!'
            ];
            return response()->json($data);
        }

        // Return success message if update successful
        $data = [
            'status' => 'success',
            'message' => 'Password successfully changed!'
        ];
        return response()->json($data);
    }
}
