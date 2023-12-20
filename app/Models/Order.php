<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    public static $status = [
        self::STATUS_PENDING,
        self::STATUS_READY,
        self::STATUS_ON_THE_WAY,
        self::STATUS_AT_DESTINATION,
        self::STATUS_DELIVERED,
    ];

    const STATUS_PENDING = 'Aun no sale de la farmacia';
    const STATUS_READY = 'Está listo para ser entregado';
    const STATUS_ON_THE_WAY = 'En camino';
    const STATUS_AT_DESTINATION = 'En la puerta de destino';
    const STATUS_DELIVERED = 'Entregado';

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
        return $this->belongsToMany(Inventory::class, 'inventory_order', 'order_id', 'inventory_id')->withPivot('quantity', 'subtotal');
    }

}
