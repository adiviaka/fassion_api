<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function productimage(){
        return $this->hasMany(ProductImage::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function order(){
        return $this->hasOne(Order::class);
    }
}
