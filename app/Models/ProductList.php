<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];


    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_product_list', 'product_lists_id', 'product_id')->withPivot('quantity');
    }


}
