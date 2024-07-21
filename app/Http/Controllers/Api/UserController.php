<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                "message" => "Credenciais incorretas"
            ], 401);
        }

        $token = $user->createToken(Hash::make($user->email))->plainTextToken;

        return response()->json([
            "token" => $token,
            "userDetails" => [
                "user" => $user
            ]
        ], 200);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8'
        ]);
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password'])
            ]);
            DB::commit();

            $token = $user->createToken(Hash::make($user->email))->plainTextToken;

            return response()->json([
                "userDetails" => $user,
                "token" => $token
            ], 200);
        } catch (\Exception) {
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "message" => "successfully logout"
        ], 200);
    }

    public function getUserInfo()
    {
        return response()->json([
            "user" => Auth::user()
        ], 200);
    }
}
