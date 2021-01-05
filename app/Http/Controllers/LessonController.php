<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Level;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    function getLessonsByLevelId($id)
    {
        $lessons = Lesson::where('level_id', $id)->get();
        return response()->json(['status' => 'ok', 'data' => $lessons]);
    }

    function postAddLesson(Request $request)
    {
        $lesson = Lesson::create($request->all());
        return response()->json(['status' => 'ok', 'message' => 'lesson created successfully']);
    }

    function postDeleteLesson(Request $request)
    {
        $id = $request->input('id');
        Lesson::destroy($id);
        return response()->json(['status' => 'ok', 'message' => 'lesson deleted successfully']);
    }
}
