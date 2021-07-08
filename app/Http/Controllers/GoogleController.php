<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $finduser = User::where('google_id', $user->id)->first();
        $tokenResult = "";
        if ($finduser) {
            Auth::login($finduser);
            $tokenResult = $finduser->createToken('authToken')->plainTextToken;
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'type' => 'user',
                'password' => bcrypt('JustSimplePasswordForGoogleUsers')
            ]);

            $newuser = new User();
            $newuser->name = $user->name;
            $newuser->email = $user->email;
            $newuser->password = bcrypt('JustSimplePasswordForGoogleUsers');
            $newuser->google_id = $user->id;
            $newuser->save();
            $tokenResult = $newuser->createToken('authToken')->plainTextToken;
            Auth::login($newUser);
        }
        return response()->json(['status' => 'ok', 'message' => 'user logged in successfully', 'user' => $user, 'token' => $tokenResult]);
    }
}
