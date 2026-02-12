<?php

namespace App\Http\Controllers;

use App\Jobs\GeneratePocketReport;
use App\Models\UserPocket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function totalBalances(){
        $totalBalance = auth()->user()->pockets()->sum('balance');

        return response()->json([
            'status'  => 200,
            'error'   => false,
            'message' => 'Berhasil mendapatkan total balance.',
            'data'    => ['total' => $totalBalance]
        ], 200);
    }

    public function createReport(Request $request, $id)
    {   
        $user = auth()->user();

        $request->validate([
            'type' => 'required|in:INCOME,EXPENSE',
            'date' => 'required|date_format:Y-m-d',
        ]); 

        $pocket = $user->pockets()->findOrFail($id);

        $timestamp = now()->timestamp;
        $uuid = Str::uuid();
        $fileName  = "{$uuid}-{$timestamp}";

        GeneratePocketReport::dispatch(
            $pocket,
            $request->type,
            $request->date,
            $fileName);

        return response()->json([
            'status'  => 200,
            'error'   => false,
            'message' => 'Report sedang dibuat. Silahkan check berkala pada link berikut.',
            'data'    => [
                'link' => url("/reports/{$fileName}")
            ]
        ]);
    }
}
