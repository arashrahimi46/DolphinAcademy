<?php

namespace App\Http\Controllers;

use App\Imports\MeaningsImport;
use App\Imports\WordsImport;
use App\Models\Meaning;
use App\Exports\MeaningExport;
use App\Models\Word;
use App\Models\WordMeaning;
use Illuminate\Database\Eloquent\Model;
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
        $wordMeaning = new WordMeaning();
        $wordMeaning->word_id = $request->get('word_id');
        $wordMeaning->meaning_id = $meaning->id;
        $wordMeaning->save();
        return response()->json(['status' => 'ok', 'message' => 'meaning created successfully']);
    }

    function postDeleteMeaning(Request $request)
    {
        $id = $request->input('id');
        Meaning::destroy($id);
        return response()->json(['status' => 'ok', 'message' => 'meaning deleted successfully']);
    }

    public function export()
    {
        return Excel::download(new MeaningExport, 'meanings.xlsx');
    }


    public function postEditMeaning(Request $request)
    {
        $meaning = Meaning::query()->find($request['id']);
        $meaning->meaning = $request['meaning'];
        $meaning->synonyms = $request['synonyms'];
        $meaning->opposites = $request['opposites'];
        $meaning->type = $request['type'];
        $meaning->description = $request['description'];
        $meaning->save();
        return response()->json(['status' => 'ok', 'message' => 'meaning updated successfully']);
    }
}
