<?php

use App\Http\Controllers\AICategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\speechController;

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

Route::get('/speech', [SpeechController::class, 'speechToText']);
Route::get('/text', [SpeechController::class, 'textToSpeech']);
Route::get('/getText', [SpeechController::class, 'textExtract']);
Route::get('/textspeechaws', [SpeechController::class, 'textToSpeechAWS']);
Route::post('/comprehend', [AICategoryController::class, 'AWScomprehend']);
Route::post('/imagerecognization', [AICategoryController::class, 'AWSimagerecognization']);
