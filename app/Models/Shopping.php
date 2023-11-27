<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shopping extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'discount_coupion_id', 'total', 'subtotal'
    ];

    public function inventories(): BelongsToMany
    {
        return $this->belongsToMany(Inventory::class, 'inventory_shopping', 'shopping_id', 'inventory_id')->withPivot('quantity');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function discountCoupion(): HasOne
    {
        return $this->hasOne(DiscountCoupion::class, 'id', 'discount_coupion_id' );
    }


}
