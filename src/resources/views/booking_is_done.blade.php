
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="registration_end__content">
  <div class="registration_end__heading">
    <h2>ご予約ありがとうございます</h2>
  </div>
   <div class="login__link">
    <form action="{{ route('stores.index') }}" method="get">
    @csrf
    <button type="submit" class="return-button">戻る</button>
    </form>
  </div>
</div>
@endsection