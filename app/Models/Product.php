<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{

    protected $table = "products";

    use HasFactory;

    protected $fillable = [
        'name', 'product_type',
        'stock', 'price',
        'detail', 'user_id'
    ];

    public function user() : BelongsTo
    {

        return $this->belongsTo(User::class);

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
