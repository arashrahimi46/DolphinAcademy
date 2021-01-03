<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function createUser(Request $request)
    {
        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->save();
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            "status" => 'ok',
            "access_token" => $tokenResult,
            "token_type" => 'Bearer',
        ]);
    }
}
