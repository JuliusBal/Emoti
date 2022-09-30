<?php

namespace App\Services;


use App\Exceptions\HotelUnavailableException;
use App\Exceptions\RoomsUnavailableException;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ReservationService
{
    private $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function createReservationForCustomer(User $customer, array $data): Reservation
    {
        $hotel = Hotel::find($data['hotel_id']);

        $startTime = Carbon::parse($data['reservation_start']);
        $endTime = Carbon::parse($data['reservation_end']);

        $totalCustomers = (int)$data['total_customers'];
        $data['reservation_start'] = $startTime;
        $data['reservation_end'] = $endTime;

        $availableRooms = $this->hotelAvailability($hotel, $startTime, $endTime);
        $roomsForCustomers = $this->getAvailableRoomsForCustomers($totalCustomers, $availableRooms);

        return $this->makeReservation($hotel, $customer, $roomsForCustomers, $data);
    }

    private function makeReservation(Hotel $hotel, User $customer, Collection $rooms, array $data): Reservation
    {
        $reservation = Reservation::make($data);
        $reservation->user()->associate($customer);
        $reservation->hotel()->associate($hotel);
        $reservation->save();

        $reservation->rooms()->attach($rooms->pluck('id'));

        return $reservation;
    }

    private function hotelAvailability(Hotel $hotel, Carbon $startTime, Carbon $endTime): Collection
    {
        return $hotel->rooms()->availableBetween($startTime, $endTime)->orderBy('capacity')->get();
    }

    private function getAvailableRoomsForCustomers(int $totalCustomers, Collection $rooms): Collection
    {
        if(empty($rooms) || $rooms->sum('capacity') < $totalCustomers) {
            throw new RoomsUnavailableException('There are currently no available rooms for your guests');
        }

        return $this->getRoomsWithClosestCapacity($totalCustomers, $rooms);
    }

    private function getRoomsWithClosestCapacity(int $totalCustomers, Collection $rooms): Collection
    {
        $closest = null;
        $closestRoom = null;
        foreach ($rooms as $room) {
            if ($closest === null || abs($totalCustomers - $closest) > abs($room->capacity - $totalCustomers)) {
                $closest = $room->capacity;
                $closestRoom = $room;
            }
        }

        $availableRooms[] = $closestRoom;

        if($totalCustomers > $closestRoom->capacity) {
            $left = $totalCustomers - $closestRoom->capacity;
            $remainingRooms = $rooms->filter(function ($value, $key) use($closestRoom){
                return $value['id'] != $closestRoom->id;
            });
            $availableRooms[] = $this->getAvailableRoomsForCustomers($left, $remainingRooms);
        }

        return collect($availableRooms)->flatten();
    }
}
