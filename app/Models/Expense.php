<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasUuids;
    protected $table = 'expenses';
    protected $fillable = ['user_id', 'pocket_id', 'amount', 'notes'];
    protected $casts = [
        'amount' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pocket(): BelongsTo
    {
        return $this->belongsTo(UserPocket::class, 'pocket_id');
    }
}
