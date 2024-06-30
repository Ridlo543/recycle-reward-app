<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'code',
        'points_required',
        'expires_at',
    ];

    protected $dates = [
        'expires_at',
    ];

    public function histories()
    {
        return $this->hasMany(HistoryRewardUser::class);
    }
}