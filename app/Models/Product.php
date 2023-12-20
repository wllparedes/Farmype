<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

    protected $table = 'products';

    use HasFactory;

    protected $fillable = ['name', 'detail', 'user_id'];



    public function childCategories(): BelongsToMany
    {
        return $this->belongsToMany(ChildCategory::class, 'child_categories_products', 'product_id', 'child_category_id');
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }



    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);

    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function loadImage()
    {
        return $this->load([
            'file' => fn($q) =>
                $q->where('category', 'products')
        ]);
    }

    public function promotions(): BelongsToMany
    {
        return $this->belongsToMany(Promotion::class, 'inventory_promotion', 'product_id', 'promotion_id');
    }




}
