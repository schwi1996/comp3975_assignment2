<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buckets extends Model
{
    use HasFactory;
    protected $table = 'buckets';
    protected $fillable = [
        'vendor',
        'category',
    ];
}
