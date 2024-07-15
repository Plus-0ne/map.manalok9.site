<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class AdminsController extends Controller
{
    public function index() {
        JavaScript::put([
            'urlBase' => URL::to('/'),
            'assetUrl' => asset('/')
        ]);

        // Get all markers
        $admins = Admins::all();

        $data = [
            'title' => 'Marker lists',
            'admins' => $admins
        ];
        return view('admin.admins',$data);
    }
}
