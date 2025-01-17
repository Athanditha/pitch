<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PusherController;

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

// Test environment setup route
Route::post('/testing/setup', function () {
    if (!app()->environment('production')) {
        App::detectEnvironment(function() {
            return 'testing';
        });
        return response()->json(['status' => 'ok', 'environment' => 'testing']);
    }
    return response()->json(['status' => 'error', 'message' => 'Not allowed in production'], 403);
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/message', [PusherController::class, 'index'])->middleware(['auth']);
Route::post('/broadcast', [PusherController::class, 'broadcast'])->middleware(['auth']);
Route::post('/receive', [PusherController::class, 'receive'])->middleware(['auth']);

// Add the logout route
Route::post('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout')->middleware('auth');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
