<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MarkerController;
use App\Http\Controllers\Admin\PinMarkerController;
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

Route::get('/get', [MarkerController::class, 'get'])->name('marker.get');
/**
 * Admin prefixed routes
 * @param String 'admin'
 * @return \Illuminate\Routing\RouteRegistrar
 */
Route::prefix('admin')->group(function () {

    /**
     * Login form for admin users
     * @param String '/'
     * @param Controller [LoginController::class
     * @param Function 'index']
     * @return \Illuminate\Routing\Route
     */
    Route::get('/',[LoginController::class , 'index'])->name('admin');

    /**
     * Validate user credentials
     * @param String '/validation'
     * @param Controller [LoginController::class
     * @param Function 'validation']
     * @return \Illuminate\Routing\Route
     */
    Route::post('/validation', [LoginController::class, 'validation'])->name('admin.validation');

    /**
     * Authenticate route for admins
     * @param String ['auth:admins']
     * @return  \Illuminate\Routing\RouteRegistrar
     */
    Route::middleware(['auth:admins'])->group(function () {

        /**
         * logout route for admin
         * @param String '/logout'
         * @param Controller [LoginController::class
         * @param Function 'logout']
         * @return \Illuminate\Routing\RouteRegistrar
         */
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

        /**
         * Marker prefix for routes
         * @param String 'marker'
         * @return \Illuminate\Routing\RouteRegistrar
         */
        Route::prefix('marker')->group(function () {

            Route::post('/create', [MarkerController::class, 'create'])->name('marker.create');



        });

        Route::prefix('dashboard')->group(function () {

            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        });

        Route::prefix('markers')->group(function () {

            Route::get('/', [PinMarkerController::class, 'index'])->name('markers');
        });
    });
});

