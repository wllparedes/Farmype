<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'discount',
        'operation_number_sale',
        'total'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function inventories(): BelongsToMany
    {
        return $this->belongsToMany(Inventory::class, 'inventory_sale', 'sale_id', 'inventory_id')->withPivot('quantity', 'subtotal');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

}
