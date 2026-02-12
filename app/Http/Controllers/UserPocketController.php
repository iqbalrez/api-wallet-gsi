<?php

namespace App\Http\Controllers;

use App\Models\UserPocket;
use Illuminate\Http\Request;

class UserPocketController extends Controller
{
    public function create(Request $request)
    {
        $pocket = UserPocket::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'balance' => 0,
        ]);

        return response()->json([
            'status' => 200,
            'error' => false,
            'message' => 'Berhasil membuat pocket baru.',
            'data' => ["id" => $pocket->id]
        ]);
    }
}
