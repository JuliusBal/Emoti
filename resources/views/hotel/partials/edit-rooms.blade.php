<div class="col-md-12 justify-content-center mt-3">
    <form action="{{ route('rooms.update', ['room' => $room->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="capacity">Capacity</label>
        <input
            name="capacity"
            type="number"
            min="1"
            placeholder="4"
            value="{{ $room->capacity }}"
            required
        >

        <label for="price">Price</label>
        <input
            name="price"
            type="number"
            min="1"
            placeholder="4"
            value="{{ $room->price }}"
            class="mb-3"
            required
        >
        <div class="col-md-12">
            <a href="javascript:void(0)" onclick="addDailyPrices({{ $room->id }});" class="unset-styles"
               id="dailyPriceButton{{$room->id}}">Add daily prices</a>
        </div>
        <br/>

        <div class="mb-3 daily-prices-{{ $room->id }} hidden">
            @for ($i = 0; $i < 7; $i++)
                <div class="col-m-12 mt-1">
                    <label class="pr-3 w-100" for="price_{{$i}}">{{ jddayofweek($i, 1) }}</label>
                    <input
                        name="day_price_{{$i}}"
                        type="number"
                        min="1"
                        value="{{ $room['day_price_'.$i] ?? '' }}"
                        placeholder="Price €"
                    >
                </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-success position-absolute" style="margin-left:-35px">
            <i class="fa-solid fa-floppy-disk"></i>
        </button>
    </form>

    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
        <button onclick="return confirm('Are you sure you want to delete this?')"
                class="btn btn-danger ml-10 position-absolute">
            <i class="fa-solid fa-trash"></i>
        </button>
        @csrf
        @method('DELETE')
    </form>

</div>
