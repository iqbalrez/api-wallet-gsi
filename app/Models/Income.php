<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasUuids;
    protected $table = 'incomes';
    protected $fillable = ['user_id', 'pocket_id', 'amount', 'notes'];
}
