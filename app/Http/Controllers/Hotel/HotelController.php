<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHotelRequest;
use App\Models\Hotel;
use App\Services\HotelService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HotelController extends Controller
{
    private $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function index(): View
    {
        $hotels = Hotel::with(['rooms', 'reservations'])->get();

        return view('hotel.index', compact('hotels'));
    }

    public function create(): View
    {
        return view('hotel.create');
    }

    public function store(StoreHotelRequest $request): RedirectResponse
    {
        $this->hotelService->save($request->validated());

        return redirect()->route('hotels.index')->with('status', 'Hotel Created');
    }


    public function edit(Hotel $hotel): View
    {
        $hotel->load('rooms');

        return view('hotel.edit', compact('hotel'));
    }

    public function update(StoreHotelRequest $request, Hotel $hotel): RedirectResponse
    {
        $this->hotelService->update($hotel, $request->validated());

        return redirect()->route('hotels.index')->with('status', 'Hotel Updated');
    }

    public function destroy(Hotel $hotel): RedirectResponse
    {
        $hotel->delete();

        return redirect()->route('hotels.index')->with('status', 'Hotel Deleted');
    }
}
