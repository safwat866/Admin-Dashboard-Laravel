<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['username', 'email', 'password', 'cash'];

    public function cart() {
        return $this->hasMany(Cart::class);
    }

}
