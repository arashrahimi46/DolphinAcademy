<?php

namespace App\Http\Controllers;

use App\Imports\SentencesImport;
use App\Imports\WordsImport;
use App\Models\Sentence;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SentenceController extends Controller
{
    function bulkImport($excelFile, $id)
    {
        Excel::import(new SentencesImport($id), $excelFile);
    }

    function getSentencesByMeaningId($id)
    {
        $sentences = Sentence::where('meaning_id', $id)->get();
        return response()->json(['status' => 'ok', 'data' => $sentences]);
    }

    function postAddSentence(Request $request)
    {
        $sentence = Sentence::create($request->all());
        return response()->json(['status' => 'ok', 'message' => 'sentence created successfully']);
    }
}
