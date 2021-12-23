<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bills';
    protected $fillable =
        [
            'name',
            'category',
            'amount',
            'month',
            'payment_date',
            'status'
        ];

    public function status()
    {
        $this->belongsTo(Status::class);
    }

}
