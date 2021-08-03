<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function getAllData()
    {
        $allData = Category::with(['levels', 'levels.lessons', 'levels.lessons.words'
            , 'levels.lessons.words.meanings', 'levels.lessons.words.wordData', 'levels.lessons.words.meanings.sentences'])->get();

        return response()->json(['status' => 'ok', 'data' => $allData]);
    }
}
