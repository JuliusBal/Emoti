@extends('layouts.app')

@section('content')
    <div class="container card p-5">
        <div class="flex items-center justify-between pb-4 text-center">
            <h1>All reservations</h1>
        </div>
    <div class="overflow-scroll display-flex justify-content-center">
        @include('reservation.partials.index-table')
    </div>
@endsection
    </div>
