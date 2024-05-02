<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant reservation service</title>
    <link rel="stylesheet" href="{{ asset('css/store_detail.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="detail-container">
        <div class="detail-group">
            <div class="store-container">
                <div class="store-group">
                    <div class="store-info">
                        <div class="detail-group">
                            <form action="{{ route('stores.index') }}" method="get">
                                @csrf
                                <button type="button" onclick="location.href='/stores'" class="back-button">
                                    <i class="material-icons-outlined">arrow_back_ios</i>
                                </button>
                            </form>
                            <h3>{{ $store->name }}</h3>
                        </div>
                        <img src="{{ $store->image_url }}" alt="{{ $store->name }}">
                        <p>#{{ $store->area->area }}</p>
                        <p>#{{ $store->genre->genre }}</p>
                        <p>{{ $store->store_overview }}</p>
                    </div>
                </div>
            </div>
            <div class="booking-container">
                <div class="booking-group">
                    <div class="booking-info">
                        <h3>予約</h3>
                        @if (Auth::check())
                        <form action="/reservation" method="post" id="bookingForm">
                            @csrf
                            <input type="hidden" name="store_id" value="{{ $store->id }}">
                            <div>
                                <label for="date" class="date-label"></label>
                                <input type="date" name="date" id="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}">
                                @error('date')
                                <span class="validation-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="time" class="date-time"></label>
                                <select name="time" id="time">
                                    <option value="" {{ old('time') == "" ? 'selected' : '' }}>予約時間を選択</option>
                                    @php
                                    $startTime = strtotime('20:00');
                                    $endTime = strtotime('22:00');
                                    $interval = 15 * 60; // 15分を秒に変換
                                    @endphp
                                    @for ($time = $startTime; $time <= $endTime; $time += $interval)
                                    <option value="{{ date('H:i', $time) }}" {{ old('time') == date('H:i', $time) ? 'selected' : '' }}>{{ date('H:i', $time) }}</option>
                                    @endfor
                                </select>
                                @error('time')
                                <span class="validation-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="num_people" class="date-num-people"></label>
                                <select name="num_people" id="num_people">
                                    <option value="" {{ old('num_people') == ""?'selected' : ''}}>予約人数を選択</option>
                                    @for ($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}" {{ old('num_people') == $i ? 'selected' : '' }}>{{ $i }}人</option>
                                    @endfor
                                </select>
                                @error('num_people')
                                <span class="validation-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="booking-confirm">
                                <div>
                                    <p>店舗名: <span id="displayStoreName">{{ $store->name }}</span></p>
                                    <p>予約日: <span id="displayDate"></span></p>
                                    <p>予約時間: <span id="displayTime"></span></p>
                                    <p>予約人数: <span id="displayNumPeople"></span></p>
                                </div>
                            </div>
                            <button type="submit" class="submit-button">予約する</button>
                        </form>
                        @else
                        <p>予約を行うにはログインが必要です</p>
                        <div>
                            <button onclick="location.href='/login'">ログイン</button>
                            <button onclick="location.href='/register'">新規登録</button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script src="{{ asset('js/reservation.js') }}"></script>
    @endsection

</body>

</html>
