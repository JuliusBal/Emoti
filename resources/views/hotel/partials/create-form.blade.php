<form class="text-center" method="POST" action="{{ route('hotels.store') }}">
    @csrf
    <div class="col-md-12 mb-2">
        <input
            id="hotelName"
            name="name"
            type="text"
            placeholder="Hotel name"
            required
        >
        @error('name')
        <p class="text-red">{{ $message }}</p>
        @enderror
    </div>

    <div class="col-md-12">
        <p>Add rooms</p>
        <input class="min-width10" type="number" id="capacityInput" placeholder="{{ 'Guest Capacity' }}">
        <input class="min-width10" type="number" id="priceInput" placeholder="{{ 'Price €' }}">
        <button onclick="newElement()" type="button" class="btn btn-success">Add</button>
    </div>

    <div id="capacities" class="mt-2"></div>
    <br/>

    <div class="text-center">
        <a href="{{ route('hotels.index') }}" class="btn btn-danger">
            Cancel
        </a>
        <button type="submit" class="text-center btn btn-success">
            Save
        </button>
    </div>
</form>
