<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    protected $fillable = [
        'capacity',
        'price',
        'day_price_0',
        'day_price_1',
        'day_price_2',
        'day_price_3',
        'day_price_4',
        'day_price_5',
        'day_price_6',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class);
    }

    public function scopeAvailableBetween($query, Carbon $start, Carbon $end)
    {
        return $query->whereDoesntHave('reservations', function (Builder $builder) use ($start, $end) {
            $builder
                ->where('reservation_start', '<=', $end)
                ->where('reservation_end', '>=', $start);
        });
    }

    public function hasDailyPrice(): bool
    {
        for($i = 0; $i <7; $i++) {
            if(!empty($this->attributes['day_price_'.$i]))
            {
                return true;
            }
        }

        return false;
    }

    public function countDailyPrices(array $days) {

        $total = 0;

        foreach($days as $key => $day)
        {
            if($key > 0) {
                $total += $this->attributes[sprintf('day_price_%s', $day - 1)] ?? $this->price;
            }
        }

        return $total;
    }
}
