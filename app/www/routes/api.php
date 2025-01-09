<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/user', function (Request $request) {
        return [
            'data' => $request->user(),
            'success' => true,
        ];
    });
});

Route::group(['prefix' => '/book'], function () {
    Route::get('/get', [BookController::class, 'get']);
});

Route::group(['prefix' => '/genre'], function () {
    Route::get('/get', [GenreController::class, 'get']);
});
