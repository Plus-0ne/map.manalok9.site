<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class LoginController extends Controller
{
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

    public function validation(Request $request) {
        if (!$request->ajax()) {
            $data = [
                'status' => 'error',
                'message' => 'Invalid Request! Please try again.'
            ];
            return response()->json($data);
        }

        $validate = Validator::make($request->all(),[
            'email_address' => 'required',
            'password' => 'required'
        ],[
            'email_address.required' => 'Please enter your email address!',
            'password.required' => 'Please enter your password!'
        ]);

        if ($validate->fails()) {
            $data = [
                'status' => 'warning',
                'message' => $validate->errors()->first()
            ];
            return response()->json($data);
        }
        $cred = [
            'email_address' => $request->input('email_address'),
            'password' => $request->input('password')
        ];

        if (!Auth::guard('admins')->attempt($cred)) {

            $data = [
                'status' => 'warning',
                'message' => 'Failed to logged in admin!'
            ];
            return response()->json($data);

        }

        $data = [
            'status' => 'success',
            'message' => 'Admin logged in successfully!'
        ];
        return response()->json($data);
    }

    public function logout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
