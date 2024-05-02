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
<form action="{{ route('stores.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="店舗名">
    <input type="text" name="area_id" placeholder="エリアID">
    <input type="text" name="genre_id" placeholder="ジャンルID">
    <textarea name="store_overview" placeholder="店舗概要"></textarea>
    <input type="text" name="image_url" placeholder="画像URL">
    <button type="submit">保存</button>
</form>
@endsection