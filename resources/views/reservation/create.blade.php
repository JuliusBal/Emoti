@extends('layouts.app')

@section('content')
    <div class="container card p-5">
        <div class="flex items-center justify-between pb-4 text-center">
            <h1 class="text-gray-800">Create Reservation</h1>
        </div>
        @include('reservation.partials.create-form')
    </div>
@endsection
