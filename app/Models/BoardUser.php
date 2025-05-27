<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardUser extends Model
{
    protected $fillable = [
        'board_id',
        'user_id',
        // Add any other fields you need
    ];
}
