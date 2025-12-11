<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::query()->where('email', $validator['email'])->first();

        // Agar foydalanuvchi topilmagan yoki password noto'g'ri
        if(!$user || !Hash::check($validator['password'], $user->password)){
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }


    public function profile()
    {
        $user = auth()->user();
        return response()->json($user);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);

    }
}
