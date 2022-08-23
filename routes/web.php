<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AICategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [CategoryController::class, 'index']);
Route::get('/texttospeech', [AICategoryController::class, 'texttospeech']);
Route::get('/speechtotext', [AICategoryController::class, 'speechtotext']);
Route::get('/textextract', [AICategoryController::class, 'textextract']);
Route::get('/objectrecognisation', [AICategoryController::class, 'objectrecognisation']);
Route::get('/comprehend', [AICategoryController::class, 'comprehend']);
