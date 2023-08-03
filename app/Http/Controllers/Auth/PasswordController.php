<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\AsingPinController as ap;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    // public function update(Request $request): RedirectResponse
    public function update(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
        $id = Auth::user()->id;
        $request->merge(['user_id' => $id]);

        $pin = new ap();
        $pins = $pin->validatePin($request);
        if (!$pins) {
            return view('securitypin.validate-pin', compact('request'));
        } 

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
