<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\User;
use App\Mail\pinMail;
use App\Models\AsingPin;
use App\Models\Referral;
use Illuminate\Support\Str;
use App\Models\AsignProfile;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class AsingPinController extends Controller
{
    public function index()
    {
        $uuid = (string) Str::uuid();
        $uuid  = substr($uuid, 0, 8);

        return (string) $uuid;
    }

    public function forwardPin(Request $request)
    {
        $pin = $this->index();
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $lastName = Auth::user()->lastName;
        $dataMail = [
            'pin' => $pin,
            'email' => $email,
            'name' => $name,
            'lastName' => $lastName,
        ];
        $this->sendMsj($dataMail);
        $data = [
            'pin' => $pin,
        ];
        $user = AsingPin::where('user_id', $id)->update($data);
        return back()->with('status', 'forwardPin');
    }

    public function activatePin($data)
    {
        $pin = $this->index();
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $lastName = Auth::user()->lastName;
        $asignPin = AsingPin::where('user_id', $id)->first();
        if ($data->pin == null) {
            $dPin = false;
        } else {
            $dPin = true;
            $dataMail = [
                'pin' => $pin,
                'email' => $email,
                'name' => $name,
                'lastName' => $lastName,
            ];
            $this->sendMsj($dataMail);
        }
        $data = [
            'user_id'  => $id,
            'pin' => $pin,
            'status'  => $dPin,
        ];
        if ($asignPin == null) {
            $user = AsingPin::create($data);
        } else {
            $user = AsingPin::where('user_id', $id)->update($data);
        }
    }

    public function sendMsj($data)
    {
        $mailData = [
            'title' => 'Código de seguridad 2FA.',
            'body' => 'Este es su código 2FA.',
            'email' => $data['email'],
            'name' => $data['name'],
            'lastName' => $data['lastName'],
            'pin' => $data['pin'],
        ];
        Mail::to($data['email'])->send(new pinMail($mailData));
    }

    public function validatePin($data)
    {
        $asignPin = AsingPin::where('user_id', $data->user_id)->where('status', true)->first();
        if ($asignPin != null) {
            $this->validatePinSend();
            return false;
        }
        return true;
    }

    public function validatePinSend()
    {
        $pin = $this->index();
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $lastName = Auth::user()->lastName;
        $dataMail = [
            'pin' => $pin,
            'email' => $email,
            'name' => $name,
            'lastName' => $lastName,
        ];
        AsingPin::where('user_id', $id)->update(['pin' => $pin]);
        $this->sendMsj($dataMail);
    }

    public function validatePinUser(Request $request)
    {
        $asignPin = AsingPin::where('pin', $request->pinProfile)->first();
       // dd($request->all());

        if ($asignPin != null) {
            
            $request->session()->put('pin_validated', true);
            $request->session()->put('pin_validated_at', Carbon::now()->timestamp);

            if ($request->url != '') {
                return Redirect::to(env('APP_URL').$request->url);
            }

            if ($request->asignProfile == "asignProfile") {
                $asignProfile = AsignProfile::where('user_id', $request->user_id)->first();
                $data = [
                    'user_id'  => $request->user_id,
                    'dni'  => $request->dni,
                    'country'  => $request->country,
                    'placeBirth'  => $request->placeBirth,
                    'birthdate'  => $request->birthdate,
                    'address'  => $request->address,
                    'PostalCode'  => $request->PostalCode,
                    'digitalContract'  => $request->doc,
                ];
                if ($asignProfile == null) {
                    $user = AsignProfile::create($data);
                } else {
                    $user = AsignProfile::where('user_id', $request->user_id)->update($data);
                }
            }

            if ($request->profileInfo == "profileInfo") {
                $data = [
                    "name" => $request->name,
                    "lastName" => $request->lastName,
                    "phone" => $request->phone,
                    "sponsorCode" => $request->sponsorCode,
                    "email" => $request->email
                ];
                User::where('id', $request->user_id)->update($data);
            }
            
            if ($request->updatePassord == "updatePassord") {
                $request->user()->update([
                    'password' => Hash::make($request->password),
                ]);
            }
           
            if ($request->updatePin == "updatePin") {
                $this->activatePin($request);
            }

            if ($request->pinView == "pinView") {
                return view('dashboard');
            }

            $id = $request->user_id;
            $asignProfile = AsignProfile::where('user_id', $id)->first();
            $asignPin = AsingPin::where('user_id', $id)->first();
            $membership = OrderPayment::where('user_id', $id)
                                        ->where('type', 'membership')
                                        ->first();
            $rurl = Referral::where('referral_code', '!=', null)
                            ->where('user_id', $id)
                            ->first();
            $url = url("/register/{$rurl->referral_code}");
            if ($request->editValidate == "editValidate") {
                return view('profile.validationProfile', [
                    'user' => $request->user(),
                    'asignProfile' => $asignProfile,
                    'asignPin' => $asignPin,
                    'membership' => $membership,
                    'referral_url' => $url,
                ]);
            }
            
            if ($request->editProfile == "editProfile") {
                return view('profile.edit', [
                    'user' => $request->user(),
                    'asignProfile' => $asignProfile,
                    'asignPin' => $asignPin,
                    'membership' => $membership,
                    'referral_url' => $url,
                ]);
            }

            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        }
        return back()->with('status', 'error-pin');
    }

    public function pinView()
    {
        return view('securitypin.validate-pin-login');
    }
}
