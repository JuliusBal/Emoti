<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateRangeTrait
{
    private function generateDateRange(Carbon $start_date, Carbon $end_date): array
    {
        $dates = [];

        for ($date = $start_date->copy(); $date->lte($end_date); $date->addDay()) {
            $dates[] = date('N', strtotime($date));
        }

        return $dates;
    }
}
