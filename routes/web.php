<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\WordController;
use \App\Http\Controllers\LevelController;
use \App\Http\Controllers\MeaningController;
use \App\Http\Controllers\WordDataController;
use \App\Http\Controllers\SentenceController;
use \App\Http\Controllers\LessonController;
use \App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::post('login', [AdminController::class, 'postAdminLogin']);
    Route::post('user/create', [UserController::class, 'createUser']);
});


Route::get('api/test', [\App\Http\Controllers\ApiController::class, 'getAllData']);
