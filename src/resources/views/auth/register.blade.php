
@extends('layouts.app')


<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />


@section('content')
<div class="register__content">
  <div class="register-form__heading">
    <h2>Registration</h2>
  </div>
  <form class="form" action="/register" method="post">
     @csrf
<div class="form__group">
  <div class="form__group-content">
    <div class="form__input--text">
    <span class="material-symbols-outlined">person</span>
    <input type="text" name="name" value="{{ old('name') }}" placeholder="お名前" />
</div>
    <div class="form__error">
      @error('name')
      {{ $message }}
      @enderror
    </div>
      </div>
    </div>
    <div class="form__group">
  <div class="form__group-content">
    <div class="form__input--text">
      <span class="material-symbols-outlined">mail</span>
      <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス" />
    </div>
    <div class="form__error">
      @error('email')
      {{ $message }}
      @enderror
        </div>
      </div>
    </div>
<div class="form__group">
  <div class="form__group-content">
    <div class="form__input--text">
      <span class="material-symbols-outlined">lock</span>
      <input type="password" name="password" placeholder="パスワード" />
    </div>
    <div class="form__error">
      @error('password')
      {{ $message }}
      @enderror
    </div>
  </div>
</div>
<div class="form__group">
  <div class="form__group-content">
    <div class="form__input--text">
      <span class="material-symbols-outlined">password</span>
      <input type="password" name="password_confirmation" placeholder="確認用パスワード" />
    </div>
  </div>
</div>
    <div class="form__button">
      <button class="form__button-submit" type="submit">登録</button>
    </div>
  </form>
</div>
@endsection　