<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        // 画像を受け取る
        $image = $request->file('image');

        // 画像を保存する
        $path = $image->store('public/images');

        return '画像が正常に保存されました';
    }
}
