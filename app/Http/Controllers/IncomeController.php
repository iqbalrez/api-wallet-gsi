<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\UserPocket;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function create(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'pocket_id' => ['required','exists:user_pockets,id,user_id,' . $user->id,],
            'amount' => 'required|numeric|min:0',
            'notes' => 'string',
        ]);

        return \DB::transaction(function () use ($request, $user) {
        
        $pocket = UserPocket::where('id', $request->pocket_id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $income = Income::create([
            'user_id'   => $user->id,
            'pocket_id' => $pocket->id,
            'amount'    => $request->amount,
            'notes'     => $request->notes,
        ]);

        $pocket->increment('balance', $request->amount);

        return response()->json([
            'status'  => 200,
            'error'   => false,
            'message' => 'Berhasil menambahkan income.',
            'data'    => [
                "id"              => $income->id,
                "pocket_id"       => $income->pocket_id,
                "current_balance" => $pocket->balance,
            ]
        ]);
    });
    }
}
