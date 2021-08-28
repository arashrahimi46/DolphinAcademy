<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meaning;
use App\Models\MeaningSentence;
use App\Models\Sentence;
use App\Models\Word;
use App\Models\WordLesson;
use App\Models\WordMeaning;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function getAllData()
    {
        $allData = Category::with(['words'
            , 'words.meanings', 'words.meanings.sentences'])->get();

        return response()->json(['status' => 'ok', 'data' => $allData]);
    }

    function getAllDataSeperated(){
        $categories = Category::all();
        $words = Word::all();
        $meanings = Meaning::all();
        $sentences = Sentence::all();
        $wordLessons = WordLesson::all();
        $wordMeanings = WordMeaning::all();
        $meaningSentences= MeaningSentence::all();
        return response()->json(['status' => 'ok', 'data' => ["categories" => $categories , 'words' => $words ,
            'meanings' => $meanings , 'sentences' => $sentences , 'wordLessons' => $wordLessons ,
            'wordMeanings' => $wordMeanings , 'meaningSentences' => $meaningSentences]]);
    }
}
