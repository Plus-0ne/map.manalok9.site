<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class DashboardController extends Controller
{
    public function index() {
        JavaScript::put([
            'urlBase' => URL::to('/'),
            'assetUrl' => asset('/')
        ]);

        $system_logs = SystemLogs::all();

        $data = [
            'title' => 'Admin',
            'system_logs' => $system_logs
        ];
        return view('admin.dashboard',$data);
    }
}
