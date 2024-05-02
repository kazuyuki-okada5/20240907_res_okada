@extends('layouts.app')

@section('content')
<div class="login__content">
    <div class="login-form__heading">
        <h2>代表者ログイン</h2>
    </div>
    <form class="form" action="{{ route('representative.login') }}" method="POST">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <div class="form__input--text">
                    <span class="material-symbols-outlined">mail</span>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレス" required autofocus />
                </div>
            </div>
            @error('email')
                <div class="form__error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <div class="form__input--text">
                    <span class="material-symbols-outlined">lock</span>
                    <input type="password" name="password" placeholder="パスワード" required />
                </div>
            </div>
            @error('password')
                <div class="form__error">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection