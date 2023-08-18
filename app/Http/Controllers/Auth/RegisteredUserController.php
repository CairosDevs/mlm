<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Rules\CustomValidationEmailRule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'captcha' => ['required','captcha'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class, new CustomValidationEmailRule()],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],            
        ]);

        $user = User::create([
            'name' => $request->name,
            "lastName" => $request->lastName,
            "phone" => $request->phone,
            "sponsorCode" => $request->sponsorCode,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);        
        $user->assignRole('Customer');

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function reloadCaptcha() {
        return response()->json(['captcha' => captcha_img('flat')]);
    }
}
