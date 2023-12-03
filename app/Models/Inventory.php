<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        "price",
        "stock",
        "on_sale",
        "discount",
        "discounted_price",
        "user_id",
        "product_id"
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productLists(): BelongsToMany
    {
        return $this->belongsToMany(ProductList::class, 'product_product_list', 'inventory_id', 'product_lists_id');
    }

    public function shoppings(): BelongsToMany
    {
        return $this->belongsToMany(Shopping::class, 'inventory_shopping', 'inventory_id', 'shopping_id');
    }
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'inventory_order', 'inventory_id', 'order_id');
    }
    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class, 'inventory_sale', 'inventory_id', 'sale_id');
    }



}
