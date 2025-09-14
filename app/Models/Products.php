<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{  
    use HasFactory;
    
    protected $fillable = [
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

    protected static function newFactory()
    {
        return ProductFactory::new();
    }
}
