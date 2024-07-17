<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class IconController extends Controller
{
    public function index() {
        JavaScript::put([
            'urlBase' => URL::to('/'),
            'assetUrl' => asset('/')
        ]);

        // $system_logs = SystemLogs::all();

        $data = [
            'title' => 'Icons',
            // 'system_logs' => $system_logs
        ];
        return view('admin.icons',$data);
    }
}
