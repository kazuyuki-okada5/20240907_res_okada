@extends('layouts.app')

@section('content')
    <h1>Reservation List</h1>

    <ul>
        @foreach($reservationDetails as $reservation)
            <li>{{ $reservation->start_at }} - {{ $reservation->number_of_people }} people</li>
        @endforeach
    </ul>
@endsection