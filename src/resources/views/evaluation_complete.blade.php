@extends('layouts.app')

@section('content')
    <!-- CSSファイルの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/evaluation_complete.css') }}">
    
    <!-- コンテンツ -->
    <div class='container'>
        <h2>評価が完了しました</h2>
        <p>評価が正常に受け付けられました。ありがとうございます。</p>
    <!-- コンテンツ終了 -->
@endsection