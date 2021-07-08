<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function createUser(Request $request)
    {
        $password_confirm = $request['password_confirm'];
        $password = $request['password'];
        if ($password_confirm != $password) {
            return response()->json([
                "status" => 'failed',
                "message" => "password and confirmation is not same",
            ]);
        }
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->save();
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            "status" => 'ok',
            "access_token" => $tokenResult,
            "token_type" => 'Bearer',
        ]);
    }

    function postUserLogin(LoginRequest $request)
    {
        $auth_result = Auth::attempt(['name' => $request->input('user_name'),
            'password' => $request->input('password'), 'type' => 'user']);
        if ($auth_result) {
            $user = Auth::user();
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json(['status' => 'ok', 'message' => 'user logged in successfully', 'token' => $tokenResult]);
        }
        return response()->json(['status' => 'failed', 'message' => 'user name or password is wrong']);
    }
}
