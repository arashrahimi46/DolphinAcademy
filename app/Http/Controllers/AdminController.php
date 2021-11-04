<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkImportRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Category;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    function postAdminBulkImport(BulkImportRequest $request)
    {
        $type = $request->input('type');
        switch ($type) {
            case 'word':
                (new WordController)->bulkImport($request->file('excel'));
                break;
            case 'meaning':
                (new MeaningController())->bulkImport($request->file('excel'));
                break;
            case 'sentence':
                (new SentenceController())->bulkImport($request->file('excel'));
                break;
            case 'word_data':
                (new WordDataController())->bulkImport($request->file('excel'));
        }
        return response()->json(['status' => 'ok', 'message' => 'data imported successfully']);
    }

    function getCategoryData($id)
    {
        $levels = Category::where('parent_id', $id)->with('words')->get();
        $words = Category::where('id', $id)->with('words')->first();
        $result = ["categories" => $levels, "words" => []];
        if ($words) {
            for ($i = 0; $i < count($levels); $i++) {
                if (count($levels[$i]->words) > 0) {
                    $levels[$i]["is_category"] = false;
                }
            }
            $result["words"] = $words->words;
        }
        return response()->json(['status' => 'ok', 'data' => $result]);
    }

    function getAllCategories()
    {
        $categories = Category::all();
        $cat_count = count($categories);
        for ($i = 0; $i < $cat_count; $i++) {
            if (count($categories[$i]->words) > 0) {
                $categories[$i]->is_category = false;
            }
        }
        return response()
            ->json(['status' => 'ok', 'categories' => $categories]);
    }

    function addCategory(Request $request)
    {
        $name = $request['name'];
        $parent_id = $request['parent_id'];
        $icon = $request['icon'];
        $category = new Category();
        $category->name = $name;
        $category->icon = $icon;
        $category->parent_id = $parent_id;
        $category->save();
        return response()
            ->json(['status' => 'ok', 'message' => 'successfully created category', 'category' => $category]);
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

    function postAdminLogin(Request $request)
    {
        $auth_result = Auth::attempt(['name' => $request->input('user_name'),
            'password' => $request->input('password'), 'type' => 'admin']);
        if ($auth_result) {
            $user = Auth::user();
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json(['status' => 'ok', 'message' => 'user logged in successfully', 'token' => $tokenResult]);
        }
        return response()->json(['status' => 'failed', 'message' => 'user name or password is wrong']);
    }

    function postAdminLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => 'ok', 'message' => 'user logged out successfully']);
    }

    function postEditCategory(Request $request)
    {
        $category = Category::query()->find($request['id']);
        $category->name = $request['name'];
        $category->icon = $request['icon'];
        $category->color = $request['color'];
        $category->parent_id = $request['parent_id'];
        $category->save();
        return response()->json(['status' => 'ok', 'message' => 'category updated successfully']);
    }


}
