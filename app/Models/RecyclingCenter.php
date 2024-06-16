<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecyclingCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact',
    ];

    public function wasteExchanges()
    {
        return $this->hasMany(WasteExchange::class);
    }
}
