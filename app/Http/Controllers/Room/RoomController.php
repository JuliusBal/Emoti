<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;

class RoomController extends Controller
{
    public function update(UpdateRoomRequest $request, Room $room): RedirectResponse
    {
        $room->update($request->validated());

        return redirect()->back()->with('status', 'Room Updated');
    }

    public function destroy(Room $room): RedirectResponse
    {
        $room->delete();

        return redirect()->back()->with('status', 'Room Deleted');
    }
}
