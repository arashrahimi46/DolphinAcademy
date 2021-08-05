<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Level;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    function getLevelsByCategoryId($id)
    {
        $levels = Category::where('parent_id', $id)->get();
        $words = Category::where('id' , $id)->with('words')->first();
        $result = ["categories" => $levels , "words" => []];
        if ($words) {
            $result["words"] = $words->words;
        }
        return response()->json(['status' => 'ok', 'data' => $result]);
    }

    function postAddLevel(Request $request)
    {
        $category = new Category();
        $category->name = $request['name'];
        $category->icon = $request['icon'];
        $category->parent_id = $request['level_id'];
        $category->save();
        return response()->json(['status' => 'ok', 'message' => 'level created successfully']);
    }

    function postDeleteLevel(Request $request)
    {
       $id = $request->input('id');
       Category::destroy($id);
       return response()->json(['status' => 'ok', 'message' => 'level deleted successfully']);
    }
}
