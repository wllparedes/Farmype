<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'document_type',
        'document_number',
        'names_surnames',
        'role',
        'password',
        'departament',
        'province',
        'district',
        'address',
        'email',
        'phone'
    ];

    public function products(): HasMany
    {

        return $this->hasMany(Product::class);

    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    // Make method for product_lists
    public function productList(): HasOne
    {
        return $this->hasOne(ProductList::class);
    }
    // Make method for shopping
    public function shopping(): HasOne
    {
        return $this->hasOne(Shopping::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function discountCoupions(): HasMany
    {
        return $this->hasMany(DiscountCoupion::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function clientHasSales(): HasMany
    {
        return $this->hasMany(Sale::class, 'client_id');
    }


    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }

    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
