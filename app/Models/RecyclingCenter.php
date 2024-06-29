<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class RecyclingCenter extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'address',
        'contact',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => "datetime",
        'password' => 'hashed',
    ];

    public function wasteExchanges()
    {
        return $this->hasMany(WasteExchange::class);
    }
    
}
