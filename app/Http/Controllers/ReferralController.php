<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AsignProfile;
use App\Models\OrderPayment;
use App\Models\AsingPin;

class ReferralController extends Controller
{
    public function getUniqueReferralCode()
    {
        do {
            $code = Str::random(7);    
        } while (Referral::where('referral_code', $code)->exists());
        return $code;
    }

    public function generateReferralCode(Request $request)
    {
        $c = $this->getUniqueReferralCode();
        $data = [
            'user_id' => Auth::user()->id,
            'referral_code' => $c
        ];
        $new = Referral::create($data);

        $rs = $this->index(true);
        return back()->with([
            'user' => $rs["user"],
            'asignProfile' => $rs["asignProfile"],
            'asignPin' => $rs["asignPin"],
            'membership' => $rs["membership"],
            'father' => $rs["father"],
            'rcount' => $rs["rcount"],
            'referral_url' => $rs["referral_url"],
        ]);
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
            Referral::where('referral_code', $code)->update(['child' => $id]);
        }
        if ($old->child != null && $old->grandchild == null) {
            //abuelo
            Referral::where('grandchild', '=', null)->where('child', $old->user_id)->update(['grandchild' => $id]);

            Referral::where('user_id', $old->user_id)->where('grandchild', '=', null)->update(['grandchild' => $id]);
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

    public function index($invoker = false)
    {
        $id = Auth::user()->id;
        $rs = Referral::where('user_id', $id)->get();
        $rurl = Referral::where('referral_code', '!=', null)->where('user_id', $id)->first();
        $url = false;
        if ($rurl != null) {
            $url = url("/register/{$rurl->referral_code}");
        }
        $rcount = count($rs);
        $father = [];
        $i = 0;
        foreach ($rs as $key => $value) {
            $child = User::where('id', $value->child)->first();
            if ($child != null) {
                $father[$key]['child']['name'] = $child->name ?? '';
                $father[$key]['child']['lastName'] = $child->lastName ?? '';
                if ($value->grandchild != null) {
                    $grandchild = User::where('id', $value->grandchild)->first();
                    $father[$key]['child']['grandchild']['name'] = $grandchild->name ?? '';
                    $father[$key]['child']['grandchild']['lastName'] = $grandchild->lastName ?? '';
                } else {
                    $father[$key]['child']['grandchild']['name'] = null;
                    $father[$key]['child']['grandchild']['lastName'] = null;
                }
            }else{
                $father[$key]['child']['name'] = null;
                $father[$key]['child']['lastName'] = null;
                $father[$key]['child']['grandchild']['name'] = null;
                $father[$key]['child']['grandchild']['lastName'] = null;
            }            
            $i++;
        }
        $asignProfile = AsignProfile::where('user_id', $id)->first();
        $asignPin = AsingPin::where('user_id', $id)->first();
        $membership = OrderPayment::where('user_id', $id)
                                        ->where('type', 'membership')
                                        ->first();
        $rurl = Referral::where('referral_code', '!=', null)
                        ->where('user_id', $id)
                        ->first();
        $url = false;
        if ($rurl != null) {
            $url = url("/register/{$rurl->referral_code}");
        }                        
        if (!$invoker) {
            return view('profile.referral', [
                'user' => Auth::user(),
                'asignProfile' => $asignProfile,
                'asignPin' => $asignPin,
                'membership' => $membership,
                'father' => $father,
                'rcount' => $rcount,
                'referral_url' => $url,
            ]);
        }else{
            return [
                'user' => Auth::user(),
                'asignProfile' => $asignProfile,
                'asignPin' => $asignPin,
                'membership' => $membership,
                'father' => $father,
                'rcount' => $rcount,
                'referral_url' => $url,
            ];
        }

    }
}
