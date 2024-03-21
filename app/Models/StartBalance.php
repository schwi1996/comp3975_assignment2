<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartBalance extends Model
{
    use HasFactory;
    protected $table = 'start_balances';
    protected $fillable = [
        'balance',
    ];
}
