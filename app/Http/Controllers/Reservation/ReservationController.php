<?php

namespace App\Http\Controllers\Reservation;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\User;
use App\Services\ReservationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReservationController extends Controller
{
    private $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function index(): View
    {
        $reservations = Reservation::with(['user', 'hotel'])->get();

        return view('reservation.index', compact('reservations'));
    }

    public function create(): View
    {
        $hotels = Hotel::all();

        return view('reservation.create', compact('hotels'));
    }

    public function store(StoreReservationRequest $request): RedirectResponse
    {
        $customer = User::find(Auth::user()->id);

        $this->reservationService->createReservationForCustomer($customer, $request->validated());

        return redirect()->route('reservations.index')->with('status', 'Reservation Created');
    }

    public function destroy(Reservation $reservation): RedirectResponse
    {
        $reservation->delete();

        return redirect()->route('reservations.index')->with('status', 'Reservation Canceled');
    }
}
