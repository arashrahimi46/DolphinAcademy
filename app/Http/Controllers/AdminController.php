<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkImportRequest;
use App\Models\BaseCategory;
use App\Models\Word;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function postAdminBulkImport(BulkImportRequest $request)
    {
        $type = $request->input('type');
        switch ($type) {
            case 'word':
                (new WordController)->bulkImport($request->file('excel'), $request->input('id'));
                break;
            case 'meaning':
                (new MeaningController())->bulkImport($request->file('excel'), $request->input('id'));
                break;
            case 'sentence':
                (new SentenceController())->bulkImport($request->file('excel'), $request->input('id'));
                break;
            case 'word_data':
                (new WordDataController())->bulkImport($request->file('excel'), $request->input('id'));
        }
        return response()->json(['status' => 'ok', 'message' => 'data imported successfully']);
    }


    function getAllCategories()
    {
        $categories = BaseCategory::all();
        return response()
            ->json(['status' => 'ok', 'categories' => $categories]);
    }

    function getCategoryWords($category_id, $serie = null)
    {
        $limit = 30;
        if ($serie == null) {
            $words = Word::where('category_id', $category_id)->get();
        } else {
            $words = Word::where('category_id', $category_id)->limit($limit)->offset($serie * $limit)->get();
        }
        return response()
            ->json(['status' => 'ok', 'words' => $words]);
    }

    function getCategoryMeanings()
    {

    }

}
