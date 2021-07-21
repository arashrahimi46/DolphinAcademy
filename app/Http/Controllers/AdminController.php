<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkImportRequest;
use App\Http\Requests\LoginRequest;
use App\Models\BaseCategory;
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


}
