@extends('layouts.app')

@section('content')
    <div class="container card p-5">
        <div class="mb-5 text-center">
            <h1>Edit Hotel</h1>
        </div>

        @include('hotel.partials.edit-form')

        <div class="col-md-12 text-center mt-5">
            <div class="display-flex justify-content-center">
                <p>Total rooms - <b id="result">{{' '. $hotel->rooms->count() }}</b></p>
            </div>
            @foreach ($hotel->rooms as $key => $room)
                <div class="{{ $key > 0 ? 'mt-100' : '' }}">
                    <b>Room: # {{ $key+1 }}</b>
                    @include('hotel.partials.edit-rooms', ['room' => $room])
                </div>
                <hr class="mt-100">
            @endforeach
        </div>

    </div>
@endsection
