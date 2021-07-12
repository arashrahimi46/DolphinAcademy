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
        if (isset($request['email'])) {
            $checkRepeatedEmail = User::where('email', $request['email'])->count();
            if ($checkRepeatedEmail > 0) {
                return response()->json([
                    "status" => 'failed',
                    "message" => "this email already registered",
                ]);
            }
        } else {
            return response()->json([
                "status" => 'failed',
                "message" => "email is required",
            ]);
        }


        $user = new User();
        $user->name = $request['user_name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->save();
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            "user" => $user,
            "status" => 'ok',
            "access_token" => $tokenResult,
            "token_type" => 'Bearer',
        ]);
    }

    function postUserLogin(LoginRequest $request)
    {
        $auth_result = Auth::attempt(['email' => $request->input('email'),
            'password' => $request->input('password'), 'type' => 'user']);
        if ($auth_result) {
            $user = Auth::user();
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json(['status' => 'ok', 'message' => 'user logged in successfully', $user => $user,
                'access_token' => $tokenResult]);
        }
        return response()->json(['status' => 'failed', 'message' => 'email or password is wrong']);
    }
}
