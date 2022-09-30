<table>
    <thead>
    <tr>
        <th class="border px-4 py-2">Hotel</th>
        <th class="border px-4 py-2">Total price</th>
        <th class="border px-4 py-2">Name</th>
        <th class="border px-4 py-2">Email</th>
        <th class="border px-4 py-2">Total customers</th>
        <th class="border px-4 py-2">Reserved from</th>
        <th class="border px-4 py-2">Reserved until</th>
        <th class="border px-4 py-2">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($reservations as $reservation)

        <tr>
            <td class="border px-4 py-2">{{ $reservation->hotel->name }}</td>
            <td class="border px-4 py-2">{{ $reservation->totalPrice .' €' }}</td>
            <td class="border px-4 py-2">{{ $reservation->user->name }}</td>
            <td class="border px-4 py-2">{{ $reservation->user->email }}</td>
            <td class="border px-4 py-2">{{ $reservation->total_customers }}</td>
            <td class="border px-4 py-2">{{ $reservation->reservation_start->format('Y-m-d') }}</td>
            <td class="border px-4 py-2">{{ $reservation->reservation_end->format('Y-m-d') }}</td>
            <td class="border px-4 py-2">
                <div class="flex">
                    @if(Auth::user()->id == $reservation->user_id)
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                            <button onclick="return confirm('Are you sure you want to cancel this reservation?')"
                                    class="focus:outline-none btn btn-danger">
                                Cancel
                            </button>
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
