<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'discount_coupion_id',
        'operation_number',
        'subtotal',
        'total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function discountCoupion(): HasOne
    {
        return $this->hasOne(DiscountCoupion::class, 'id', 'discount_coupion_id');
    }
    public function inventories(): BelongsToMany
    {
        return $this->belongsToMany(Inventory::class, 'inventory_order', 'order_id', 'inventory_id')->withPivot('quantity','subtotal');
    }

}
