<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteExchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recycling_center_id',
        'waste_type_id',
        'weight',
        'points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recyclingCenter()
    {
        return $this->belongsTo(RecyclingCenter::class);
    }

    public function wasteType()
    {
        return $this->belongsTo(WasteType::class);
    }
}
