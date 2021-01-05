<?php

namespace App\Http\Controllers;

use App\Imports\WordDataImport;
use App\Imports\WordsImport;
use App\Models\Word;
use App\Models\WordData;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WordDataController extends Controller
{
    function bulkImport($excelFile, $id)
    {
        Excel::import(new WordDataImport($id), $excelFile);
    }

    function getWordDataByWordId($id)
    {
        $data = WordData::where('word_id', $id)->get();
        return response()->json(['status' => 'ok', 'data' => $data]);
    }

    function postAddWordData(Request $request)
    {
        $wordData = WordData::create($request->all());
        return response()->json(['status' => 'ok', 'message' => 'word data created successfully']);
    }

    function postDeleteWordData(Request $request)
    {
        $id = $request->input('id');
        WordData::destroy($id);
        return response()->json(['status' => 'ok', 'message' => 'word data deleted successfully']);
    }
}
