<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validasi request body user
        $request->validate([
            "username" => "required|string",
            "password" => "required|string"
        ]);

        // mencari user menggunakan username
        $user = User::where("username", $request->username)->first();

        // jika user tidak ditemukan atau password tidak sesuai
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "message" => "invalid login"
            ], 401);
        };

        // jika user dan password sudah dipenuhi maka buat token
        $token = $user->createToken($user->id)->plainTextToken;

        // setelahnya token akan dikembalikan
        return response()->json([
            "token" => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        // mendapatkan user yang punya token
        $request->user()->tokens()->delete();

        return response()->json([
            "message" => "logout success"
        ], 200);
    }
}
