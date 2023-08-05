<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\AsingPin;
use App\Models\AsignProfile;
use App\Mail\pinMail;
use Mail;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AsingPinController extends Controller
{
    public function index() {
        return (string) Str::uuid();
    }

    public function activatePin($data) {
        $pin = $this->index();
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $name = Auth::user()->name;
        $lastName = Auth::user()->lastName;
        $asignPin = AsingPin::where('user_id', $id)->first();  
        if($data->pin == null) {
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

    public function sendMsj($data) {
        $mailData = [
            'title' => 'Security pin.',
            'body' => 'this is the security pin.',
            'email' => $data['email'],
            'name' => $data['name'],
            'lastName' => $data['lastName'],
            'pin' => $data['pin'],
        ];
        Mail::to($data['email'])->send(new pinMail($mailData));
    }

    public function validatePin($data)
    {
        $asignPin = AsingPin::where('user_id',$data->user_id)->where('status',true)->first();
        if ($asignPin != null) { 
            return false;
        }
        return true;
    }

    public function validatePinUser(Request $request)
    {
        $asignPin = AsingPin::where('pin',$request->pinProfile)->first();
        if ($asignPin != null) { 
            if($request->asignProfile == "asignProfile") {
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

            if($request->profileInfo == "profileInfo") {
                $data = [
                    "name" => $request->name,
                    "lastName" => $request->lastName,
                    "phone" => $request->phone,
                    "sponsorCode" => $request->sponsorCode,
                    "email" => $request->email
                ];
                User::where('id',$request->user_id)->update($data);
            }
            
            if($request->updatePassord == "updatePassord") {
                $request->user()->update([
                    'password' => Hash::make($request->password),
                ]);
            }
           
            if($request->updatePin == "updatePin") {
                $this->activatePin($request);
            }

            if($request->pinView == "pinView") {
                return view('dashboard');
            }  

            if($request->editValidate == "editValidate") {
                $id = $request->user_id;
                $asignProfile = AsignProfile::where('user_id', $id)->first();
                $asignPin = AsingPin::where('user_id', $id)->first();
                return view('profile.validationProfile', [
                    'user' => $request->user(),
                    'asignProfile' => $asignProfile,
                    'asignPin' => $asignPin,
                ]);
            }  
            
            if($request->editProfile == "editProfile") {
                $id = $request->user_id;
                $asignProfile = AsignProfile::where('user_id', $id)->first();
                $asignPin = AsingPin::where('user_id', $id)->first();
                return view('profile.edit', [
                    'user' => $request->user(),
                    'asignProfile' => $asignProfile,
                    'asignPin' => $asignPin,
                ]);
            }       
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        }
        // dd("error");
        return back()->with('status', 'error-pin');
    }

    public function pinView() {
        return view('securitypin.validate-pin-login');
    }
}
