<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'product_image',
    ];

    public function cart() {
        return $this->hasMany(Cart::class);
    }

    public function order() {
        return $this->hasMany(Orders::class);
    }
}
