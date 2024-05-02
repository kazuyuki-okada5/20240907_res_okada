<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        // 画像を受け取る
        $image = $request->file('image');

        // 画像を保存する
        $path = $image->store('public/images');

        // パスから「public/」を削除する
        $path = str_replace('public/', '', $path);

        // ビューを返すか、リダイレクトするなどの適切な処理を行う
        return '画像が正常にアップロードされました';
    }
    public function showUploadForm()
    {
        $imageUrl = 'ここに画像のURLを代入する';

        // ビューに変数を渡してビューを返す
        return view('upload', ['imageUrl' => $imageUrl]);
    }
}
