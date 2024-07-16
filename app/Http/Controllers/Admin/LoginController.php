<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CustomHelper;
use App\Http\Controllers\Controller;
use App\Models\Admins;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class LoginController extends Controller
{
    /**
     * Show login page
     * @return \Illuminate\Contracts\View\View
     */
    public function index() {
        JavaScript::put([
            'urlBase' => URL::to('/'),
            'assetUrl' => asset('/')
        ]);
        $data = [
            'title' => 'Admin'
        ];
        return view('admin.login',$data);
    }

    /**
     * Validate login
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validation(Request $request) {

        // Check ajax request
        if (!$request->ajax()) {
            $data = [
                'status' => 'error',
                'message' => 'Invalid Request! Please try again.'
            ];
            return response()->json($data);
        }

        // Create validation rules
        $validate = Validator::make($request->all(),[
            'email_address' => 'required',
            'password' => 'required'
        ],[
            'email_address.required' => 'Please enter your email address!',
            'password.required' => 'Please enter your password!'
        ]);

        // If validation fails
        if ($validate->fails()) {
            $data = [
                'status' => 'warning',
                'message' => $validate->errors()->first()
            ];
            return response()->json($data);
        }

        // Get admin details using email address
        $emailExist = Admins::where('email_address' , $request->input('email_address'))->first();

        // If email address not found
        if (!$emailExist) {
            $data = [
                'status' => 'warning',
                'message' => 'Email address not found!'
            ];
            return response()->json($data);
        }

        // If admin account is disabled
        if ($emailExist->status < 1) {
            $data = [
                'status' => 'warning',
                'message' => 'This account has been deactivated!'
            ];
            return response()->json($data);
        }
        // Create credential array
        $cred = [
            'email_address' => $request->input('email_address'),
            'password' => $request->input('password')
        ];

        // Attempt login admins
        if (!Auth::guard('admins')->attempt($cred)) {

            $data = [
                'status' => 'warning',
                'message' => 'Failed to logged in admin!'
            ];
            return response()->json($data);

        }

        // Return success response
        $descripton = Auth::guard('admins')->user()->first_name.' logged in at '.Carbon::now();


        $logs = CustomHelper::createLogMessages([
            'uuid' => Str::uuid(),
            'trigger_uuid' => Auth::guard('admins')->user()->uuid,
            'title' => 'success',
            'description' => $descripton,
            'type' => 'auth',
        ]);

        $data = [
            'status' => 'success',
            'message' => 'Admin logged in successfully!',
            'logs' => $logs
        ];

        return response()->json($data);
    }

    /**
     * Logout account
     * @param Request $request
     * @return \Illuminate\Routing\Redirector
     */
    public function logout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
