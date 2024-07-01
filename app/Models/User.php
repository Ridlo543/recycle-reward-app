<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'address', // New field
        'contact', // New field
        'password',
        'points'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function wasteExchanges()
    {
        return $this->hasMany(WasteExchange::class);
    }

    public function historyRewardUsers()
    {
        return $this->hasMany(HistoryRewardUser::class);
    }

    public function getTotalPointsAttribute()
    {
        return $this->points;
    }
}
