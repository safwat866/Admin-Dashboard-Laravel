<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements AuthenticatableContract
{
    use HasFactory;
    protected $fillable = ['username', 'email', 'password', 'cash', "is_admin", "image"];

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

}
