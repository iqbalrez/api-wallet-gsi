<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserPocket extends Model
{
    use HasUuids;
    protected $table = 'user_pockets';
    protected $fillable = ['user_id', 'name', 'balance'];
    protected $casts = [
        'balance' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class, 'pocket_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'pocket_id');
    }
}
