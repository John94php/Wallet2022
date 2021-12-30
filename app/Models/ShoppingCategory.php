<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCategory extends Model
{
    use HasFactory;
    protected $table = 'shoppingcat';
    protected $fillable = [
        'name',
        'icon'
    ];
    public $timestamps = false;

    public function shopping()
    {
            $this->belongsTo(Shopping::class);
    }
}
