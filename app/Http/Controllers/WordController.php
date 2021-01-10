<?php

namespace App\Http\Controllers;

use App\Imports\WordsImport;
use App\Models\Lesson;
use App\Models\Word;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WordController extends Controller
{
    function bulkImport($excelFile , $id)
    {
        Excel::import(new WordsImport($id), $excelFile);
    }

    function getWordsByLessonId($id)
    {
        $words = Word::where('lesson_id', $id)->with('wordData')->get();
        return response()->json(['status' => 'ok', 'data' => $words]);
    }

    function postAddWord(Request $request)
    {
        $word = Word::create($request->all());
        return response()->json(['status' => 'ok' , 'message' => 'word created successfully']);
    }

    function postDeleteWord(Request $request)
    {
        $id = $request->input('id');
        Word::destroy($id);
        return response()->json(['status' => 'ok', 'message' => 'word deleted successfully']);
    }
}
