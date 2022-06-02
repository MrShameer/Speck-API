<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SimulationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [UserController::class, 'register']);
Route::get('email/verify/{id}',[UserController::class, 'verify'])->name('verification.verify');
Route::get('email/resend', [UserController::class, 'resend'])->name('verification.resend');
Route::post('/login', [UserController::class, 'login']);

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::post('info',[SimulationController::class, 'info']);
    // Route::post('/user', function (Request $request) {
    //     return $request->user();
    //     return $request->bearerToken();
    // });

});
