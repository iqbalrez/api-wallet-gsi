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

    public function list()
    {
        $pockets = UserPocket::where('user_id', auth()->user()->id)->get();

        if ($pockets->isNotEmpty()) {
            return response()->json([
                'status' => 200,
                'error' => false,
                'message' => 'Berhasil.',
                'data' => [
                    $pockets->map(function ($pocket) {
                        return [
                            'id' => $pocket->id,
                            'name' => $pocket->name,
                            'current_balance' => $pocket->balance,
                        ];
                    }),
                ]
            ]);
        } else {
            return response()->json([
            'status' => 404,
            'error' => true,
            'message' => 'Tidak ada pocket yang ditemukan.',
        ], 404);}
    }
}
