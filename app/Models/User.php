<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Role;
use App\Models\RoleUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'status'
    ];

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
    
    public function userdetail(){
        return $this->hasOne(UserDetail::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function store(){
        return $this->hasOne(Store::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function order(){
        return $this->hasOne(Order::class);
    }

    public function roleuser(){
        return $this->hasMany(RoleUser::class);
    }

    public function role(){
        return $this->belongsToMany(Role::class, 'role_users', 'role_id', 'user_id');
    } 

    public function assignRole($role){
        return $this->role()->attach($role);
    }
}
