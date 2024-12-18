<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;
class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $expiration = Carbon::now()->addDays(7);
        $user = Auth::user();
        // $token = $user->createToken('api-token')->plainTextToken;
        $token = $user->createToken('api-token', ['*'], $expiration)->plainTextToken;
        // return response()->json(['token' => $token]);
        return response()->json(['token' => $token, 'user' => $user]);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
