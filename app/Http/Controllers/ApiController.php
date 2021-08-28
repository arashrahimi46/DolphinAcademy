<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function getAllData()
    {
        $allData = Category::with(['words'
            , 'words.meanings', 'words.meanings.sentences'])->get();

        return response()->json(['status' => 'ok', 'data' => $allData]);
    }
}
