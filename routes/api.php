<?php

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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('data/import/bulk', [AdminController::class, 'postAdminBulkImport']);
    Route::get('categories', [AdminController::class, 'getAllCategories']);
    Route::get('levels/{category_id}', [LevelController::class, 'getLevelsByCategoryId']);
    Route::get('lessons/{level_id}', [LessonController::class, 'getLessonsByLevelId']);
    Route::get('words/{lesson_id}', [WordController::class, 'getWordsByLessonId']);
    Route::get('word_data/{word_id}', [WordDataController::class, 'getWordDataByWordId']);
    Route::get('meanings/{word_id}', [MeaningController::class, 'getMeaningsByWordId']);
    Route::get('sentences/{meaning_id}', [SentenceController::class, 'getSentencesByMeaningId']);
    Route::post('levels/add' , [LevelController::class , 'postAddLevel']);
    Route::post('lessons/add' , [LessonController::class , 'postAddLesson']);
    Route::post('words/add' , [WordController::class , 'postAddWord']);
    Route::post('word_data/add' , [WordDataController::class , 'postAddWordData']);
    Route::post('meanings/add' , [MeaningController::class , 'postAddMeaning']);
    Route::post('sentences/add' , [SentenceController::class , 'postAddSentence']);
    Route::post('levels/delete' , [LevelController::class , 'postDeleteLevel']);
    Route::post('lessons/delete' , [LessonController::class , 'postDeleteLesson']);
    Route::post('words/delete' , [WordController::class , 'postDeleteWord']);
    Route::post('word_data/delete' , [WordDataController::class , 'postDeleteWordData']);
    Route::post('meanings/delete' , [MeaningController::class , 'postDeleteMeaning']);
    Route::post('sentences/delete' , [SentenceController::class , 'postDeleteSentence']);
});

