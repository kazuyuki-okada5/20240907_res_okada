@extends('layouts.app')


<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

@section('content')
<div class="login__content">
  <div class="login-form__heading">
    <h2>Login</h2>
  </div>
  <form class="form" action="/login" method="post">
     @csrf
    <div class="form__group">
      <div class="form__group-title">
        <div class="form__input--text">
          <span class="material-symbols-outlined">mail</span>
          <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス" />
        </div>
      </div>
      <div class="form__error">
        @error('email')
          {{ $message }}
        @enderror
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <div class="form__input--text">
          <span class="material-symbols-outlined">lock</span>
          <input type="password" name="password" placeholder="パスワード" />
        </div>
      </div>
      <div class="form__error">
        @error('password')
          {{ $message }}
        @enderror
      </div>
    </div>
    <div class="form__button">
      <button class="form__button-submit" type="submit">ログイン</button>
    </div>
  </form>
</div>


@endsection