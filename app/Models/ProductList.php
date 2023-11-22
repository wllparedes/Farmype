<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];


    public function inventories() : BelongsToMany
    {
        return $this->belongsToMany(Inventory::class, 'product_product_list', 'product_lists_id', 'inventory_id')->withPivot('quantity');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
