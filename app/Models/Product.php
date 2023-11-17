<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{

    protected $table = 'products';

    use HasFactory;

    protected $fillable = [
        'name', 'product_type',
        'on_sale', 'discount',
        'discounted_price',
        'stock', 'price',
        'detail', 'user_id'
    ];

    public function user() : BelongsTo
    {

        return $this->belongsTo(User::class);

    }

    public function productLists() : BelongsToMany
    {
        return $this->belongsToMany(ProductList::class, 'product_product_list', 'product_id', 'product_lists_id');
    }


    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function loadImage()
    {
        return $this->load(['file' => fn($q) =>
            $q->where('category', 'products')
        ]);
    }





}
