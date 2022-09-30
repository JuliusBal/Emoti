<form method="POST"
      action="{{ route('hotels.update', ['hotel' => $hotel->id]) }}">
    @method('PUT')
    @csrf
    <div class="flex text-center">
        <p>Hotel name</p>
        <div class="col-md-12 text-center">
            <input
                id="hotelName"
                name="name"
                type="text"
                placeholder="Hotel name"
                value="{{ old('name') ?? $hotel->name }}"
                required
            >
            @error('name')
            <p class="text-red">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <div class="col-md-12 text-center mt-5">
        <p>Add a room</p>
        <input class="min-width10" type="number" id="capacityInput" placeholder="{{ 'Guest Capacity' }}">
        <input class="min-width10" type="number" id="priceInput" placeholder="{{ 'Price €' }}">
        <button onclick="newElement()" type="button" class="btn btn-success">Add</button>
    </div>

    <div id="capacities" class="mt-2 text-center"></div>
    <br/>

    <div class="text-center">

        <button type="submit" class="text-center btn btn-success">
            Save
        </button>
        <a href="{{ route('hotels.index') }}" class="btn btn-danger">
            Cancel
        </a>
    </div>
</form>
