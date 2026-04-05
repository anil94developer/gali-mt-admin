<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\GameController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*chat-api's*/
Route::post('/chatstore', [UserController::class, 'chatstore']);
Route::post('/chatstore-audio', [UserController::class, 'chatstoreAudio']);
Route::post('/chatlist', [UserController::class, 'chatlist']);

Route::post('register',[UserController::class, 'register'])->name('register');
Route::post('result-history',[GameController::class, 'result_history'])->name('result_history');
