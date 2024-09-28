<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:student,mentor,admin',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $token = $user->createToken('myAppToken');

        return response()->json(['message' => 'User created successfully'], 201);
        return (new UserResource($user))->additional([
            'token' => $token->plainTextToken,
        ]);
    }
    public function getAllUsers()
    {
        $user = User::all();
        return response()->json(['data' => $user], 200);
    }
}
