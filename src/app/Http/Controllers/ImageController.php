<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
public function uploadImage(Request $request)
{
    // 画像を保存する処理
    $imagePath = $request->file('image')->store('images', 'public');

    // 画像のパスをビューに渡す
    return view('representative.edit', ['imagePath' => $imagePath]);
}
public function deleteImage($id)
{
    // 画像を削除する処理

    // データベースから画像のパスを取得するロジックを実装

    // 画像をストレージから削除する処理
    Storage::disk('public')->delete($imagePath);

    // データベースから画像のパスを削除するロジックを実装

    // 削除が成功した場合のリダイレクトまたはメッセージを返す
    return redirect()->back()->with('success', '画像が削除されました');
}
}
