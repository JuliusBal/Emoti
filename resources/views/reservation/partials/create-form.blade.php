<form method="POST" action="{{ route('reservations.store') }}">
    @csrf
    <div class="col-md-12 text-center display-flex mb-5">
        <div class="px-3 mb-6 md:mb-0">
            <label for="hotel-id">
                Hotel<span class="text-red">*</span>
            </label>
            <select id="hotel_id" name="hotel_id">
                @foreach($hotels as $hotel)
                    <option
                        value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                @endforeach
            </select>
            @error('hotel_id')
            <p class="text-red">{{ $message }}</p>
            @enderror
        </div>

        <div class="px-3 mb-6 md:mb-0">
            <label for="reservation_start">
                Check-in date: <span class="text-red">*</span>
            </label>
            <input
                id="reservation_start"
                name="reservation_start"
                type="date"
                value="{{ old('reservation_start') ?? '' }}"
                required>
            @error('reservation_start')
            <p class="text-red text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full px-3 mb-6 md:mb-0">
            <label for="reservation_end">
                Check out date: <span class="text-red">*</span>
            </label>
            <input
                id="reservation_end"
                name="reservation_end"
                type="date"
                value="{{ old('reservation_end') ?? '' }}"
                required>
            @error('reservation_end')
            <p class="text-red">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full px-3 mb-6 md:mb-0">
            <label for="total_customers">
                Total customers<span class="text-red">*</span>
            </label>
            <input
                id="total_customers"
                name="total_customers"
                type="number"
                step="1"
                min="1"
                placeholder="4"
                value="{{ old('total_customers') ?? '' }}"
                required>
            @error('total_customers')
            <p class="text-red">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex flex-col text-center">
        <a href="{{ route('hotels.index') }}" class="btn btn-danger">
            Cancel
        </a>
        <button type="submit" class="btn btn-success">
            Save
        </button>
    </div>
</form>
