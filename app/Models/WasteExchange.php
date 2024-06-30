<?php

namespace App\Models;

use App\Enums\WasteExchangeStatus;
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
        'image',
        'latitude',
        'longitude',
        'status',
    ];

    protected $casts = [
        'status' => WasteExchangeStatus::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->points)) {
                $wasteType = WasteType::find($model->waste_type_id);
                if ($wasteType) {
                    $model->points = $model->weight * $wasteType->price_per_gram;
                }
            }
        });

        static::saved(function ($model) {
            $user = $model->user;

            // save ketika status berubah menjadi accepted
            if ($model->status == WasteExchangeStatus::Accepted && !$model->wasChanged('status')) {
                $user->points += $model->points;
                $user->save();
            }

            // save ketika status berubah dari accepted
            if ($model->wasChanged('status') && $model->getOriginal('status') == WasteExchangeStatus::Accepted) {
                $user->points -= $model->getOriginal('points');
                $user->save();
            }
        });
    }

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
