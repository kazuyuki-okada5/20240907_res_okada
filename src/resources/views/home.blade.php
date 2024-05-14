@extends('layouts.app')

@section('content')
<div class="container">
    <!-- レスポンシブなグリッドレイアウト -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- カードヘッダー -->
                <div class="card-header">{{ __('登録完了しました！') }}</div>

                <!-- カードボディ -->
                <div class="card-body">
                    @if (session('status'))
                        <!-- アラートメッセージ -->
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('ハンバーガーメニューよりページ移動して下さい') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

