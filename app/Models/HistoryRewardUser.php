<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryRewardUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reward_id',
        'redeemed_at',
    ];

    protected $dates = [
        'redeemed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }
}
