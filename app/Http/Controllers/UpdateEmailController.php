<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEmailRequest;
use App\Models\NewMailAddress;
use Illuminate\Http\Request;

class UpdateEmailController extends Controller
{
    public function edit()
    {
        return view('auth.email.edit');
    }

    public function update(UpdateEmailRequest $request) {
        $user = $request->user();
        $validated = $request->validated();

        NewMailAddress::where('user_id', $user->id)->delete();
        NewMailAddress::create([
            'user_id' => $user->id,
            'email' => $validated['email'],
        ]);
//        NewMailAddress::updateOrCreate(['user_id' => $user->id], ['email' => $validated['email']]);
        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', __('Verification link sent!'));
    }
}
