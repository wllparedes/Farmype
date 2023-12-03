<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCoupion extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'discount',
        'start_date',
        'expiration_date',
        'is_active',
        'max_uses',
        'uses',
    ];

    public function shopping()
    {
        return $this->belongsTo(Shopping::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
