<?php

namespace App\Http\Controllers;

use App\Imports\SentencesImport;
use App\Imports\WordsImport;
use App\Exports\SentenceExport;
use App\Models\Meaning;
use App\Models\MeaningSentence;
use App\Models\Sentence;
use App\Models\Word;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SentenceController extends Controller
{
    function bulkImport($excelFile)
    {
        Excel::import(new SentencesImport(), $excelFile);
    }

    function getSentencesByMeaningId($meaning_id = null)
    {
        if ($meaning_id == null) {
            $sentences = Sentence::all();
        } else {
            $sentences = Meaning::where('id', $meaning_id)->with('sentences')->get();
        }
        return response()->json(['status' => 'ok', 'data' => $sentences]);
    }

    function postAddSentence(Request $request)
    {
        $sentence = Sentence::create($request->all());
        $meaningSentence = new MeaningSentence();
        $meaningSentence->meaning_id = $request->get('meaning_id');
        $meaningSentence->sentence_id = $sentence->id;
        $meaningSentence->save();
        return response()->json(['status' => 'ok', 'message' => 'sentence created successfully']);
    }

    function postDeleteSentence(Request $request)
    {
        $id = $request->input('id');
        Word::destroy($id);
        return response()->json(['status' => 'ok', 'message' => 'sentence deleted successfully']);
    }

    public function export()
    {
        return Excel::download(new SentenceExport, 'sentences.xlsx');
    }

    public function postEditSentence(Request $request)
    {
        $sentence = Sentence::query()->find($request['id']);
        $sentence->sentence = $request['sentence'];
        $sentence->translate = $request['translate'];
        $sentence->is_stared = $request['is_stared'];
        $sentence->stared_sentence = $request['stared_sentence'];
        $sentence->star_translate = $request['star_translate'];
        $sentence->save();
        return response()->json(['status' => 'ok', 'message' => 'sentence updated successfully']);
    }
}
