<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarkerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class PinMarkerController extends Controller
{
    public function index() {
        JavaScript::put([
            'urlBase' => URL::to('/'),
            'assetUrl' => asset('/')
        ]);

        // Get all markers
        $markers = MarkerModel::with('markerAttachments')->get();
        
        $data = [
            'title' => 'Marker lists',
            'markers' => $markers
        ];
        return view('admin.marker',$data);
    }
}
