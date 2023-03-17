<?php

namespace App\Models;

use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    public function roleuser(){
        return $this->hasMany(RoleUser::class);
    }

    public function user(){
        return $this->belongsToMany(User::class, 'role_users');
    }
}
