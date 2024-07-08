<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Client\MapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[MapController::class , 'index'])->name('home');

Route::prefix('admin')->group(function () {

    Route::get('/',[LoginController::class , 'index'])->name('admin');

    Route::post('/validation',[LoginController::class , 'validation'])->name('admin.validation');

    Route::middleware(['auth:admins'])->group(function () {

        Route::get('/logout',[LoginController::class , 'logout'])->name('logout');
    });
});

