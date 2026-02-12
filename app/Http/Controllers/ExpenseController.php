<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function create(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'pocket_id' => ['required','exists:user_pockets,id,user_id,' . $user->id,],
            'amount' => 'required|numeric|min:0',
            'notes' => 'string',
        ]);

        return DB::transaction(function () use ($request, $user) {
        
            $pocket = $user->pockets()->findOrFail($request->pocket_id);

            if ($pocket->balance < $request->amount) {
                return response()->json([
                    'status'  => 400,
                    'error'   => true,
                    'message' => 'Saldo di pocket ini tidak mencukupi.',
                ], 400);
            }
            
            $expense = $user->expenses()->create([
                'user_id'   => $user->id,
                'pocket_id' => $pocket->id,
                'amount'    => $request->amount,
                'notes'     => $request->notes,
            ]);

            $pocket->decrement('balance', $request->amount);

            return response()->json([
                'status'  => 200,
                'error'   => false,
                'message' => 'Berhasil menambahkan expense.',
                'data'    => [
                    "id"              => $expense->id,
                    "pocket_id"       => $expense->pocket_id,
                    "current_balance" => $pocket->balance,
                ]
            ], 200);
        });
    }
}
