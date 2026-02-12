<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

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
}
