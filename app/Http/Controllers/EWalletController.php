<?php

namespace App\Http\Controllers;

use App\Models\OrderPayment;
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
        $deposits = OrderPayment::where('user_id', Auth::user()->id)->where('type', 'deposit')->paginate(5);
        $withdraws = OrderPayment::where('user_id', Auth::user()->id)->where('type', 'withdraw')->paginate(5);
        $transations = OrderPayment::where('type', '!=', 'membership')->paginate(5);


        return view('ewallets.depositos_retiros', compact('deposits', 'withdraws', 'transations'));
    }

    public function capital_garantia()
    {
        $allDeposits = OrderPayment::where('type', 'deposit')->sum('amount');
        $withdraws = OrderPayment::where('user_id', Auth::user()->id)->where('type', 'withdraw')->paginate(5);
        $transations = OrderPayment::where('type', '!=', 'membership')->paginate(5);


        return view('ewallets.admin.capital_garantia', compact('allDeposits', 'withdraws', 'transations'));
    }

    public function logro_metas()
    {
        $allDeposits = OrderPayment::where('type', 'deposit')->sum('amount');
        $withdraws = OrderPayment::where('user_id', Auth::user()->id)->where('type', 'withdraw')->paginate(5);
        $transations = OrderPayment::where('type', '!=', 'membership')->paginate(5);


        return view('ewallets.admin.logro_metas', compact('allDeposits', 'withdraws', 'transations'));
    }

    public function solicitudes_retiros()
    {
        $withdraws = OrderPayment::where('type', 'withdraw')->where('status', 'requested')->paginate(5);


        return view('ewallets.admin.solicitudes_retiros', compact('withdraws'));
    }

    public function solicitudes_pendientes()
    {
        $withdraws = OrderPayment::where('type', 'withdraw')->where('status', 'pending')->paginate(5);


        return view('ewallets.admin.solicitudes_pendientes', compact('withdraws'));
    }

    public function solicitudes_pagadas()
    {
        $withdraws = OrderPayment::where('type', 'withdraw')->where('status', 'paid')->paginate(5);


        return view('ewallets.admin.solicitudes_pagadas', compact('withdraws'));
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
                                  ->with('sweet-success', 'La dirección de su wallet fue almacenada');
    }
}
