@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
@endsection

@section('content')
<div class="detail-container">
    <div class="detail-group">
        <div class="store-container">
            <div class="store-group">
                <div class="store-info">
                    <form action="{{ url('/') }}" method="get">
                        @csrf
                        <button type="submit" class="return-button">戻る</button>
                    </form>
                    <h3>{{ $store->name }}</h3>
                    <img src="{{ $store->image_url }}" alt="{{ $store->name }}">
                    <p>{{ $store->area->area }}</p>
                    <p>{{ $store->genre->genre }}</p>
                    <p>{{ $store->store_overview }}</p>
                </div>
            </div>
        </div>
        <div class="booking-container">
            <div class="booking-group">
                <div class="booking-info">
                    <h3>予約</h3>
                    <form action="/reservation" method="post">
                        @csrf
                        <input type="hiden" name="store_id" value="{{ $store->id }}">
                        <div>
                            <label for="store_name">Shop:</label>
                            <span>{{ $store->name }}</span>
                        </div>
                        <div>
                            <label for="date">Date:</label>
                            <input type="date" name="date" id="date">
                        </div>
                        <div>
                            <label for="time">Time:</label>
                                <select name="time" id="time">
                                    @php
                                        $startTime = strtotime('20:00');
                                        $endTime = strtotime('22:00');
                                        $interval = 15 * 60; // 15分を秒に変換
                                    @endphp
                                    @for ($time = $startTime; $time <= $endTime; $time += $interval)
                                        <option value="{{ date('H:i', $time) }}">{{ date('H:i', $time) }}</option>
                                    @endfor
                                </select>
                        </div>
                        <div>
                            <label for="num_people">Number:</label>
                            <select name="num_people" id="num_people">
                                @for ($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}">{{ $i }}</optiom>
                                @endfor
                            </select>
                        </div>
                        <button type="submit">予約する</button>
                    </form>
                </div>
                <div class="booking-confirm">
                    <div>
                        <p>Shop:{{ $store->name }}</p>
                        <p>Date:</p>
                        <p>Time:</p>
                        <p>Number:</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('time').addEventListener('click', function() {
        this.setAttribute('size', '5');
    });

    document.getElementById('time').addEventListener('blur', function() {
        this.removeAttribute('size');
    });
</script>
@endsection