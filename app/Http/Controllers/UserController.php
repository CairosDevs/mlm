<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Rules\CustomValidationEmailRule;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);

        return view('users.index')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class, new CustomValidationEmailRule()],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            "lastName" => $request->lastName,
            "phone" => $request->phone,
            'email' => $request->email,
            'confirmed' => true,
            'password' => Hash::make($request->password)
        ]);
        $user->assignRole('Customer');
        $user->markEmailAsVerified();

        // $token = Str::random(60);
        // $user->confirmation_token = hash('sha256', $token);
        // $user->save();

        // Mail::send('emails.user.confirm', ['user' => $user, 'token' => $token], function ($message) use ($user) {
        //     $message->to($user->email, $user->name)->subject('Confirm your account');
        // });

        event(new Registered($user));
        $users = User::paginate(10);

        return redirect()->route('users.index')->with('users', $users)
                                  ->with('sweet-success', 'Usuario creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirm(Request $request, $token)
    {
    // Find the user associated with the token
        $user = User::where('confirmation_token', hash('sha256', $token))->first();

        if (!$user) {
            // Token is invalid
            return redirect('/')->with('sweet-error', 'Invalid confirmation token.');
        }

    // Confirm the user's account
        $user->confirmed = true;
        $user->confirmation_token = null;
        $user->save();

    // Log the user in
        auth()->login($user);

    // Redirect to the password reset page
        return redirect('password/reset')->with('status', 'Please set your password.');
    }

    public function createPassword(Request $request)
    {
        return view('auth.create-password');
    }

    public function passwordCreateStore(Request $request)
    {
        dd("datos", [Auth::user(), $request->all()]);
    }
}
