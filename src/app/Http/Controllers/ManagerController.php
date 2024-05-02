<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representative;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function index()
    {
        $representatives = Representative::all(); 
        return view('manager.index', ['representatives' => $representatives]);
    }

    // 新しいデータの作成
    public function create(Request $request)
    {
        // フォームから送信されたデータを取得
        $name = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt($request->input('password')); // パスワードのハッシュ化

        // 新しい代表者を作成して保存
        $representative = new Representative();
        $representative->name = $name;
        $representative->email = $email;
        $representative->password = $password;
        $representative->save();

        // 成功したらリダイレクトまたはレスポンスを返す
    }

    // データの変更
    public function update(Request $request, $id)
    {
        // 変更するデータを取得
        $representative = Representative::find($id);

        // フォームから送信されたデータを更新
        $representative->name = $request->input('name');
        $representative->email = $request->input('email');

        // パスワードが入力されていれば、新しいパスワードをハッシュ化して保存
        if ($request->filled('password')) {
            $password = bcrypt($request->input('password'));
            $representative->password = $password;
        }

        // 変更を保存
        $representative->save();

        // 成功したらリダイレクトまたはレスポンスを返す
    }

    // データの削除
    public function delete($id)
    {
        // 削除するデータを取得して削除
        $representative = Representative::find($id);
        $representative->delete();

        // 成功したらリダイレクトまたはレスポンスを返す
    }

     public function showLoginForm()
    {
        return view('auth.manager.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('representative.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
