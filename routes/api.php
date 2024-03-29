<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\WordController;
use \App\Http\Controllers\LevelController;
use \App\Http\Controllers\MeaningController;
use \App\Http\Controllers\WordDataController;
use \App\Http\Controllers\SentenceController;
use \App\Http\Controllers\LessonController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\IconController;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('data/import/bulk', [AdminController::class, 'postAdminBulkImport']);
    Route::get('categories', [AdminController::class, 'getAllCategories']);
    Route::post('category/add', [AdminController::class, 'addCategory']);
    Route::get('levels/{category_id}', [AdminController::class, 'getCategoryData']);
    Route::get('lessons/{level_id}', [AdminController::class, 'getCategoryData']);
    Route::get('words/{lesson_id?}', [WordController::class, 'getWordsByLessonId']);
    Route::get('word_data/{word_id}', [WordDataController::class, 'getWordDataByWordId']);
    Route::get('meanings/{word_id?}', [MeaningController::class, 'getMeaningsByWordId']);
    Route::get('sentences/{meaning_id?}', [SentenceController::class, 'getSentencesByMeaningId']);
    Route::get('icons/get', [IconController::class, 'getAll']);
    Route::post('levels/add', [AdminController::class, 'addCategory']);
    Route::post('lessons/add', [AdminController::class, 'addCategory']);
    Route::post('words/add', [WordController::class, 'postAddWord']);
    Route::post('word_data/add', [WordDataController::class, 'postAddWordData']);
    Route::post('meanings/add', [MeaningController::class, 'postAddMeaning']);
    Route::post('sentences/add', [SentenceController::class, 'postAddSentence']);
    Route::post('levels/delete', [LevelController::class, 'postDeleteLevel']);
    Route::post('lessons/delete', [LevelController::class, 'postDeleteLevel']);
    Route::post('words/delete', [WordController::class, 'postDeleteWord']);
    Route::post('word_data/delete', [WordDataController::class, 'postDeleteWordData']);
    Route::post('meanings/delete', [MeaningController::class, 'postDeleteMeaning']);
    Route::post('sentences/delete', [SentenceController::class, 'postDeleteSentence']);
    Route::post('admin/logout', [AdminController::class, 'postAdminLogout']);
    Route::get('export/words', [WordController::class, 'export']);
    Route::get('export/meanings', [MeaningController::class, 'export']);
    Route::get('export/sentences', [SentenceController::class, 'export']);
    Route::get('export/category', [LessonController::class, 'export']);
    Route::post('search/words', [WordController::class, 'search']);
    Route::post('words/edit', [WordController::class, 'postEditWord']);
    Route::post('category/edit', [AdminController::class, 'postEditCategory']);
    Route::post('sentence/edit', [SentenceController::class, 'postEditSentence']);
    Route::post('meaning/edit', [MeaningController::class, 'postEditMeaning']);
    Route::post('sync/update', [AdminController::class, 'postUpdateSync']);
    Route::post('sync/get', [AdminController::class, 'postGetSync']);
});

