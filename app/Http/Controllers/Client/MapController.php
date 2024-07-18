<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\MarkersIcon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class MapController extends Controller
{
    /**
     * Show map page
     * @return \Illuminate\Contracts\View\View
     */
    public function index() {

        JavaScript::put([
            'urlBase' => URL::to('/'),
            'assetUrl' => asset('/'),
            'isAuthenticated' => Auth::guard('admins')->check()
        ]);

        // Get all markers
        $markers_icon = MarkersIcon::all();

        $data = [
            'title' => 'Manalo Resort Hotel Map',
            'markers' => $markers_icon
        ];
        return view('home',$data);
    }
}
