<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AiringController;

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

Route::group([
    'prefix' => 'airing',
    'middleware' => 'jwt.verify'
], function () {
    Route::get('/', [AiringController::class, 'index']);
    Route::get('/{id}', [AiringController::class, 'show']);
    Route::post('/', [AiringController::class, 'store']);
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class,'login'])->name('login');
    Route::post('/register', [AuthController::class,'register']);
});

Route::group([
    'middleware' => 'jwt.verify'
], function () {
    Route::post('/logout', [AuthController::class,'logout']);
    Route::post('/refresh', [AuthController::class,'refresh']);
    Route::get('/me', [AuthController::class,'me']);
    Route::POST('/file', [UserController::class,'uploadFile']);
});