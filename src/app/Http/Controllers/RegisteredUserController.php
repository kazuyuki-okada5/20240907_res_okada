<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\RegistrationRequest;

class RegisteredUserController extends Controller
{
    /**
     * 登録フォームを表示する
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * 新規ユーザーを登録する
     *
     * @param  RegistrationRequest  $request
     * @return \Illuminate\View\View
     */
    public function store(RegistrationRequest $request)
    {
        // 新規登録処理を実行
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 登録完了ページを表示
        return view('auth.registration_end');
    }
}

