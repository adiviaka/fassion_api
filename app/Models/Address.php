<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'address',
        'village',
        'district',
        'city',
        'province',
        'postal_code'
    ];

    public function userdetail(){
        return $this->belongsTo(UserDetail::class);
    }
}
