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
            'total',
            'month'
        ];
    protected $casts =
        [
            'items' =>   'array'
        ];
    public function shopping()
    {
        $this->hasMany(ShoppingCategory::class,'id');
    }
}
