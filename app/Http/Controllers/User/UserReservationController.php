<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserReservationController extends Controller
{
    public function index(): View
    {
        $reservations = Auth::user()->reservations()->with(['hotel'])->get();

        return view('reservation.index', compact('reservations'));
    }
}
