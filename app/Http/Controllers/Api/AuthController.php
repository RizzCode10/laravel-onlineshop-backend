<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Melakukan validasi terhadapat request yang ada
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|unique:users|max:100',
            'password' => 'required',
            'phone' => 'required',
            'roles' => 'required',
        ]);


        //password encryption
        $validated['password'] = Hash::make($validated['password']);

        // Membuat user dengan data yang sudah di validasi sebelumnya
        $user = User::create($validated);

        // Membuat token untuk user yang baru dibuat
        $token = $user->createToken('auth_token')->plainTextToken;

        // Mengembalikan response dengan data user dan token
        return response()->json([
            'access_token' => $token,
            'user' => $user,
        ], 201);
    }


    public function logout(Request $request)
    {
        // Menghapus token yang sedang aktif
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout success',
        ], 200);
    }



    public function login(Request $request)
    {
         // Melakuakn validasi terhadap request yang masuk
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Mencari user dengan email yang sudah di inputkan
        $user = User::where('email', $validated['email'])->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 401);
        }

        // Jika password yang di inputkan tidak sesuai maka...
        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid password'
            ], 401);
        }

        // Membuat token untuk user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user,
        ], 200);
    }
}
