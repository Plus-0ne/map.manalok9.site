<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IconController;
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
         * @return \Illuminate\Routing\Route
         */
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

        /**
         * Marker prefix for routes
         * @param String 'marker'
         * @return \Illuminate\Routing\RouteRegistrar
         */
        Route::prefix('marker')->group(function () {

            /**
             * Create marker
             * @param String '/create'
             * @param Controller [MarkerController::class
             * @param Function 'create']
             * @return \Illuminate\Routing\Route
             */
            Route::post('/create', [MarkerController::class, 'create'])->name('marker.create');

            /**
             * Delete marker
             * @param String '/delete'
             * @param Controller [MarkerController::class
             * @param Function 'delete']
             * @return \Illuminate\Routing\Route
             */
            Route::post('/delete', [MarkerController::class, 'delete'])->name('marker.delete');

            /**
             * Move marker
             * @param String '/move'
             * @param Controller [MarkerController::class
             * @param Function 'move']
             * @return \Illuminate\Routing\Route
             */
            Route::post('/move', [MarkerController::class, 'move'])->name('marker.move');

        });

        /**
         * Route prefix for dashboard
         * @param String 'dashboard'
         * @return \Illuminate\Routing\RouteRegistrar
         */
        Route::prefix('dashboard')->group(function () {

            /**
             * Dashboard route
             * @param String '/'
             * @param Controller [DashboardController::class
             * @param Function 'index']
             * @return \Illuminate\Routing\Route
             */
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        });

        Route::prefix('markers')->group(function () {

            Route::get('/', [PinMarkerController::class, 'index'])->name('markers');
        });

        Route::prefix('admins')->group(function () {

            Route::get('/', [AdminsController::class, 'index'])->name('admins');
            Route::post('/create', [AdminsController::class, 'create'])->name('admins.create');

            Route::post('/delete', [AdminsController::class, 'delete'])->name('admins.delete');
        });

        Route::prefix('icons')->group(function () {
            Route::get('/', [IconController::class, 'index'])->name('icons');
            Route::post('/create', [IconController::class, 'create'])->name('icons.create');

            Route::post('/remove', [IconController::class, 'remove'])->name('icons.remove');
        });

        Route::prefix('account')->group(function () {
            Route::get('/', [AccountController::class, 'index'])->name('account');

            Route::post('/name/update', [AccountController::class, 'nameUpdate'])->name('account.name.update');
            Route::post('/password/update', [AccountController::class, 'passwordUpdate'])->name('account.password.update');
        });
    });
});

