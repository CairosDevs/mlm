<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReferralController extends Controller
{
    public function getUniqueReferralCode()
    {
        do {
            $code = Str::random(7);    
        } while (Referral::where('referral_code', $code)->exists());
        return $code;
    }

    public function valitCode($data)
    {
        return Referral::where('referral_code', $data)->exists();
    }

    public function store($id, $code)
    {
        // a los nuevos se crea su codigo de referido
        $c = $this->getUniqueReferralCode();
        $data = [
            'user_id' => $id,
            'referral_code' => $c
        ];
        $new = Referral::create($data);

        $old = Referral::where('referral_code', $code)->first();
        if ($old->child == null) {       
            //abuelo
            Referral::where('grandchild', '=', null)->where('child', $old->user_id)->update(['grandchild' => $id]);

            Referral::where('referral_code', $code)->update(['child' => $id]);
        }
        if ($old->grandchild == null) {
            //abuelo
            Referral::where('grandchild', '=', null)->where('child', $old->user_id)->update(['grandchild' => $id]);

            Referral::where('user_id', $old->user_id)->update(['grandchild' => $id]);
        } 
        if ($old->child != null && $old->grandchild != null) {
            $grandchild = Referral::where('user_id', $old->user_id)->where('grandchild', null)->first();
            if ($grandchild != null) {
                Referral::where('grandchild', null)->where('user_id', $old->user_id)->update(['grandchild' => $id]);
            } else {
                $data = [
                    'user_id' => $old->user_id,
                    'child' => $id,
                ];
                $new = Referral::create($data);
            }
        }  
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function show(Referral $referral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function edit(Referral $referral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Referral $referral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function destroy(Referral $referral)
    {
        //
    }
}
