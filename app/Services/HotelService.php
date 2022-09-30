<?php

namespace App\Services;

use App\Models\Hotel;

class HotelService
{
    public function save(array $data): Hotel
    {

        $hotel = Hotel::create($data);

        if (!empty($data['rooms'])) {
            $hotel->rooms()->createMany($data['rooms']);
        }

        return $hotel;
    }

    public function update(Hotel $hotel, array $data): Hotel
    {
        $hotel->update($data);

        if (!empty($data['rooms'])) {
            $hotel->rooms()->createMany($data['rooms']);
        }

        return $hotel;
    }
}
