<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ユーザ登録画面の表示
    public function create()
    {
        return view('account.create');
    }

    // ユーザ登録処理
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        // ユーザ登録完了イベントの発行(メール認証処理などに必要)
        event(new Registered($user));

        return to_route('login')->with('success', 'ユーザ登録が完了しました');
    }

    public function edit()
    {
        return view('account.edit');
    }

    public function update(UpdateUserRequest $request)
    {
        $user = $request->user();
        $user->update($request->validated());
        return to_route('account.edit')->with('success', 'プロフィール更新が完了しました');
    }
}
