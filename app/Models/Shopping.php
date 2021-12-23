<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;
    protected $table = 'shopping';
    protected $fillable =
        [
            'name',
            'items',
            'total'
        ];
    protected $casts =
        [
            'items' =>   'array'
        ];
}