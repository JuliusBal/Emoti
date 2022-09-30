<table>
    <thead>
    <tr>
        <th class="border px-4 py-2">Title</th>
        <th class="border px-4 py-2">Rooms</th>
        <th class="border px-4 py-2">Reservations</th>
        <th class="border px-4 py-2">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($hotels as $hotel)
        <tr>
            <td class="border px-4 py-2">{{ $hotel->name }}</td>
            <td class="border px-4 py-2">{{ $hotel->rooms->count() }}</td>
            <td class="border px-4 py-2">{{ $hotel->reservations->count() }}</td>
            <td class="border px-4 py-2">
                <div class="display-flex">
                    <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-primary btn-xs">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <form action="{{ route('hotels.destroy', $hotel->id) }}" method="post">
                        <button onclick="return confirm('Are you sure you want to delete this?')"
                                class="focus:outline-none btn btn-danger ml-5">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
