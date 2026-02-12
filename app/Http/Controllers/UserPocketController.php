<?php

namespace App\Http\Controllers;

use App\Models\UserPocket;
use Illuminate\Http\Request;

class UserPocketController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $pocket = auth()->user()->pockets()->create([
            'name' => $request->name,
            'balance' => 0,
        ]);

        return response()->json([
            'status' => 200,
            'error' => false,
            'message' => 'Berhasil membuat pocket baru.',
            'data' => ["id" => $pocket->id]
        ], 200);
    }

    public function list()
    {
        $pockets = auth()->user()->pockets;

         if ($pockets->isEmpty()) {
            return response()->json([
                'status'  => 404,
                'error'   => true,
                'message' => 'Tidak ada pocket yang ditemukan.',
            ], 404);
        }

        return response()->json([
            'status'  => 200,
            'error'   => false,
            'message' => 'Berhasil.',
            'data'    => $pockets->map(function ($pocket) {
                return [
                    'id'              => $pocket->id,
                    'name'            => $pocket->name,
                    'current_balance' => $pocket->balance,
                ];
            })
        ]);
    }
}
