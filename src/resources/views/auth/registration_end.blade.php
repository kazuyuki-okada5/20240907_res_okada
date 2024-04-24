
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/registration_end.css') }}">

<div class="registration_end__content">
  <div class="registration_end__heading">
    <h2>会員登録ありがとうございます</h2>
  </div>
  <div class="login__link">
    <a class="login__button-submit" href="/login">ログインする</a>
  </div>
</div>
@endsection