@extends('layouts.app')

@section('content')
    <form action="{{ route('stores.update', $store->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $store->name }}">
        <input type="text" name="area_id" value="{{ $store->area_id }}">
        <input type="text" name="genre_id" value="{{ $store->genre_id }}">
        <textarea name="store_overview">{{ $store->store_overview }}</textarea>
        <input type="text" name="image_url" value="{{ $store->image_url }}">
        <button type="submit">更新</button>
    </form>
@endsection