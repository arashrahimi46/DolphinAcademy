<?php

use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminController;
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

    Route::post('user/create', [UserController::class, 'createUser']);
});

Route::post('api/admin/login', [AdminController::class, 'postAdminLogin']);

Route::post('api/user/login', [UserController::class, 'postUserLogin']);
Route::post('api/user/signup', [UserController::class, 'createUser']);

Route::get('auth/google', [\App\Http\Controllers\GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [\App\Http\Controllers\GoogleController::class, 'handleGoogleCallback']);


Route::get('api/test', [\App\Http\Controllers\ApiController::class, 'getAllData']);

Route::get('clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

Route::get('api/unauthorized', function () {
    return response()->json(['status' => 'failed', 'message' => 'user is not authenticated']);
})->name('unauthorized');

Route::get('export/words2', [WordController::class, 'export']);
