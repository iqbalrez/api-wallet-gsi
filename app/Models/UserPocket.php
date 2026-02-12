<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class UserPocket extends Model
{
    use HasUuids;
    protected $table = 'user_pockets';
    protected $fillable = ['user_id', 'name', 'balance'];
}
