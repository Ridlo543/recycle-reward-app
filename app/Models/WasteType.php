<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_per_gram',
    ];

    public function wasteExchanges()
    {
        return $this->hasMany(WasteExchange::class);
    }
}
