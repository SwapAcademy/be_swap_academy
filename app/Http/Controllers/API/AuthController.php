<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "Student",
        ]);

        return response()->json(['message' => 'User created successfully'], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()], 400);
        }

        try {
            $token = JWTAuth::attempt($credentials);

            if (!$token) {
                return response()->json(['message' => 'Login credentials are invalid'], 409);
            }

            $userResponse = getUser($request->email);
            $userResponse->token = $token;
            $userResponse->token_expires_in = Auth::factory()->getTTL() * 60;
            $userResponse->token_type = 'bearer';

            return response()->json($userResponse);
        } catch (JWtException $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    // Fungsi untuk logout
    public function logout()
    {
        auth('api')->logout(true);

        return response()->json(['message' => 'Log out success'], 200);
    }
}
