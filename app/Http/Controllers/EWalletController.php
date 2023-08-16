<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ewallet = EWallet::where('user_id', Auth::user()->id)->first();
        return view('ewallets.index')->with('ewallet', $ewallet);
    }

    public function depositos_retiros()
    {
        return view('ewallets.depositos_retiros');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'wallet_id' => ['required', 'string', 'max:255'],
        ]);

        $ewallet = EWallet::where('user_id', $request->user_id)->first();

        if (is_null($ewallet)) {
            $ewallet = EWallet::create([
            'wallet_id' => $request->wallet_id,
            "user_id" => $request->user_id,
            ]);
        } else {
            $ewallet->wallet_id = $request->wallet_id;
            $ewallet->save();
        }
        
        return redirect()->route('ewallets.index')->with('ewallet', $ewallet)
                                  ->with('success', 'La dirección de su wallet fue almacenada');
    }
}
