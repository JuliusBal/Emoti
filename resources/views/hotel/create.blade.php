@extends('layouts.app')

@section('content')
    <div class="container card p-5">
        <div class="mb-5 text-center">
            <h1>New Hotel</h1>
            <div class="display-flex justify-content-center"> Rooms:# <b id="result"></b></div>
        </div>
        @include('hotel.partials.create-form')
    </div>
@endsection
