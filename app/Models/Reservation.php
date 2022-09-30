<?php

namespace App\Models;

use App\Traits\DateRangeTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reservation extends Model
{
    use DateRangeTrait;

    protected $fillable = [
        'reservation_start',
        'reservation_end',
        'total_customers',
    ];

    protected $casts = [
        'reservation_start' => 'datetime',
        'reservation_end'   => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class);
    }

    public function getTotalPriceAttribute()
    {
        $start = Carbon::parse($this->attributes['reservation_start']);
        $end = Carbon::parse($this->attributes['reservation_end']);

        $total = 0;
        $hasDailyPrice = false;
        foreach($this->rooms()->get() as $room)
        {
            if($room->hasDailyPrice()) {
                $hasDailyPrice = true;
                $total += $room->countDailyPrices($this->generateDateRange($start, $end));
            }
        }

       return $hasDailyPrice ? $total : $start->diffInDays(Carbon::parse($end)) * $this->rooms()->pluck('price')->sum();
    }
}
