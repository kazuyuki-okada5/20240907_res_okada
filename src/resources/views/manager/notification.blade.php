@extends('layouts.app')

@section('content')
    <h2>お知らせ内容作成</h2>
    <form action="{{ route('send.notification') }}" method="POST">
        @csrf
        <textarea name="content" rows="5" cols="50" placeholder="お知らせ内容を入力してください"></textarea>
        <button type="submit">送信</button>
    </form>
@endsection