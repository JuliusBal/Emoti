@extends('layouts.app')

@section('content')
    <div class="container card p-5">
        <div class="mb-5">
            <h1 class="text-center">Hotels</h1>
        </div>

        <div class="overflow-scroll col-md-12 display-flex justify-content-center">
            @include('hotel.partials.index-table')
        </div>
    </div>
@endsection
