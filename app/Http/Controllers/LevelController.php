<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    function getLevelsByCategoryId($id)
    {
        $levels = Level::where('category_id', $id)->get();
        return response()->json(['status' => 'ok', 'data' => $levels]);
    }

    function postAddLevel(Request $request)
    {
        $level = Level::create($request->all());
        return response()->json(['status' => 'ok', 'message' => 'level created successfully']);
    }
}
