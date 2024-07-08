<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class MapController extends Controller
{
    public function index() {

        JavaScript::put([
            'urlBase' => URL::to('/'),
            'assetUrl' => asset('/'),
            'isAuthenticated' => Auth::guard('admins')->check()
        ]);
        $data = [
            'title' => 'Home'
        ];
        return view('home',$data);
    }
}
