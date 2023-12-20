<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_promotion',
        'price',
        'stock',
        'status',
        'date_start',
        'date_end',
    ];

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_promotion', 'promotion_id', 'product_id')->withPivot('product_id', 'promotion_id');
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
