<?php

namespace App\Http\Controllers;

use App\Imports\MeaningsImport;
use App\Imports\WordsImport;
use App\Models\Meaning;
use App\Models\Word;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MeaningController extends Controller
{
    function bulkImport($excelFile)
    {
        Excel::import(new MeaningsImport(), $excelFile);
    }

    function getMeaningsByWordId($word_id = null)
    {
        if ($word_id == null) {
            $meanings = Meaning::all();
        } else {
            $meanings = Word::where('id', $word_id)->with('meanings')->get();
        }
        return response()->json(['status' => 'ok', 'data' => $meanings]);
    }

    function postAddMeaning(Request $request)
    {
        $meaning = Meaning::create($request->all());
        return response()->json(['status' => 'ok', 'message' => 'meaning created successfully']);
    }

    function postDeleteMeaning(Request $request)
    {
        $id = $request->input('id');
        Meaning::destroy($id);
        return response()->json(['status' => 'ok', 'message' => 'meaning deleted successfully']);
    }
}
