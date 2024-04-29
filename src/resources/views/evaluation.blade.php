@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/evaluation.css') }}">
    <div class='container'>
        <div class="card">
            <div class="card-header"></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('reservations.evaluate', $reservation->id)}}">
                        @csrf
                        <div class="form-group">
                            <label for="rating">評価</label>
                            <input id="rating" type="number" class="form-control" name="rating" min="1" max="5" required>
                        </div>

                        <div class="form-group">
                            <label for="comment">コメント</label>
                            <textarea id="comment" class="form-control" name="comment" rows="4" required></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">評価する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection