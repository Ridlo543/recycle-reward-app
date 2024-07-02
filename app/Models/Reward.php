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
        'partner_id',
    ];

    protected $dates = [
        'expires_at',
    ];

    public function historyRewardUsers()
    {
        return $this->hasMany(HistoryRewardUser::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}