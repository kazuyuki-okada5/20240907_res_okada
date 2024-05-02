<?php

namespace App\Http\Controllers;

use App\Models\Representative;
use Illuminate\Http\Request;

class RepresentativeController extends Controller
{
    public function dashboard()
    {
        $representatives = Representative::all();
        return view('manager.dashboard', compact('representatives'));
    }

    public function create()
{
    return view('representatives.create');
}

public function store(Request $request)
{
            // バリデーションのルールを定義
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:representatives,email',
            'password' => 'required|string|min:6',
        ];

        // バリデーションを実行
        $validatedData = $request->validate($rules);

        // 代表者をデータベースに登録
        $representative = Representative::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // 登録が完了したらリダイレクト
        return redirect()->route('representatives.index')->with('success', '代表者が登録されました');
}
}
