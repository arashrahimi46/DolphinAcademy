<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lesson;
use App\Models\Level;
use App\Exports\LessonExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LessonController extends Controller
{
    function getLessonsByLevelId($id)
    {
        $lessons = Category::where('parent_id', $id)->get();
        return response()->json(['status' => 'ok', 'data' => $lessons]);
    }

    function postAddLesson(Request $request)
    {
        $category = new Category();
        $category->name = $request['name'];
        $category->icon = $request['icon'];
        $category->parent_id = $request['level_id'];
        $category->is_category = true;
        $category->save();
        return response()->json(['status' => 'ok', 'message' => 'lesson created successfully']);
    }

    function postDeleteLesson(Request $request)
    {
        $id = $request->input('id');
        Category::destroy($id);
        return response()->json(['status' => 'ok', 'message' => 'lesson deleted successfully']);
    }

    public function export()
    {
        return Excel::download(new LessonExport, 'categories.xlsx');
    }
}
