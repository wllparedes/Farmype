<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ChildCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_category_id'
    ];



    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(ParentCategory::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'child_categories_products', 'child_category_id', 'product_id');
    }

}
