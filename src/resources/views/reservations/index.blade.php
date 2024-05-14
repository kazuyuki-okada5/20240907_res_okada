@extends('layouts.app')

@section('content')
    <!-- 予約一覧のタイトル -->
    <h1>Reservation List</h1>

    <!-- 予約一覧のリスト -->
    <ul>
        @foreach($reservationDetails as $reservation)
            <li>{{ $reservation->start_at }} - {{ $reservation->number_of_people }} people</li>
        @endforeach
    </ul>
@endsection