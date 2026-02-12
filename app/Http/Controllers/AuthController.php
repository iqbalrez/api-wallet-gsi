<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if($token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Berhasil login.',
                'data' => ['token' => $token],
                ]);
        } else {
            return response()->json([
                'status' => 400,
                'error' => true,
                'message' => 'Email atau password salah.',
                ], 400);
        }
    }

    public function profile()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Berhasil login.',
                'data' => [
                    'full_name' => $user->full_name,
                    'email' => $user->email,
                ]
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 500,
                'error' => true,
                'message' => 'Token tidak valid.',
            ], 500);
        }
    }
}
