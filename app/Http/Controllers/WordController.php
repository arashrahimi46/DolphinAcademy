<?php

namespace App\Http\Controllers;

use App\Imports\WordsImport;
use App\Models\Word;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WordController extends Controller
{
    function bulkImport($excelFile , $id)
    {
        Excel::import(new WordsImport($id), $excelFile);
    }

    function getWordsByLessonsId($id)
    {
        $words = Word::where('lesson_id', $id)->get();
        return response()->json(['status' => 'ok', 'data' => $words]);
    }

    function postAddLevel(Request $request)
    {
        $word = Word::create($request->all());
        return response()->json(['status' => 'ok' , 'message' => 'word created successfully']);
    }
}
