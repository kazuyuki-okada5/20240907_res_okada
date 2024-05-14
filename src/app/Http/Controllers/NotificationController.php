<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;

class NotificationController extends Controller
{
    public function sendNotificationToAllUsers(Request $request)
    {
        // フォームから送信された内容を取得
        $content = $request->input('content');

        // すべてのユーザーを取得
        $users = User::all();

        // 各ユーザーにお知らせのメールを送信
        foreach ($users as $user) {
            Mail::to($user->email)->send(new NotificationMail($content));
        }

        // メール送信後、リダイレクトまたはメッセージを返す
        return redirect()->back()->with('success', 'お知らせを送信しました。');
    }
}
