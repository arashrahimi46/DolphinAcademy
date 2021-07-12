<?php

namespace App\Http\Controllers;

use App\Imports\WordsImport;
use App\Models\Lesson;
use App\Models\Word;
use App\Exports\WordExport;
use App\Models\WordLesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WordController extends Controller
{
    function bulkImport($excelFile)
    {
        Excel::import(new WordsImport(), $excelFile);
    }

    function getWordsByLessonId($lesson_id = null)
    {
        $words = "";
        if ($lesson_id == null) {
            $words = Word::all();
        } else {
            $words = Lesson::where('id', $lesson_id)->with('words')->get();
        }

        return response()->json(['status' => 'ok', 'data' => $words]);
    }

    function postAddWord(Request $request)
    {
        $word = Word::create($request->all());
        $wordLesson = new WordLesson();
        $wordLesson->word_id = $word->id;
        $wordLesson->lesson_id = $request->get('lesson_id');
        $wordLesson->save();
        return response()->json(['status' => 'ok', 'message' => 'word created successfully']);
    }

    function postDeleteWord(Request $request)
    {
        $id = $request->input('id');
        Word::destroy($id);
        return response()->json(['status' => 'ok', 'message' => 'word deleted successfully']);
    }

    public function export()
    {
        return Excel::download(new WordExport, 'words.xlsx');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        if ($query == "" || $query == null) {
            return response()->json(['status' => 'failed', 'message' => 'query can not be empty']);
        }
        $result = Word::where('word', 'like', "%$query%")->get();
        return response()->json(['status' => 'ok', 'data' => $result]);
    }
}
