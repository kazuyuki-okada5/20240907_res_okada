@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="search-container">
                        <div class="search-group">
                            <div class="search-area">
                                <select class="search-area-select" onchange="selectRegistrationArea()">
                                    <option value="area1">エリア1</option>
                                    <option value="area2">エリア2</option>
                                    <option value="area3">エリア3</option>
                                </select>
                            </div>
                            <div class="search-genre">
                                <select class="search-genre-select" onchange="selectRegistrationGenre()">
                                    <option value="genre1">ジャンル1</option>
                                    <option value="genre2">ジャンル2</option>
                                    <option value="genre3">ジャンル3</option>
                                <!-- 必要に応じて他のジャンルを追加 -->
                                </select>
                            </div>
                            <div class="search-words">
                                <input type="text" id="keyword" placeholder="キーワードを入力" onkeydown="handleKeyDown(event)">
                                    <button onclick="search()">検索</button>
                            </div>
                        </div>
<div class="attendance__alert">
  // 店舗リスト表示画面
</div>

<div class="attendance__content">
  <div class="attendance__panel">
    
  </div>
</div>
@endsection