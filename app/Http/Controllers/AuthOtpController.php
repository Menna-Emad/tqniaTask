<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Auth;

class AuthOtpController extends Controller
{
 //return view of otp login page
   public function login()
   {
     return view('auth.otp-login');
   }

   //generate otp

   public function generate(Request $request)
   {
    //validate
    $request->validate([
        'phone'=>['required','regex:/^01[0-2,5,9]{1}[0-9]{8}$/','exists:users,phone'],

    ]);

    //generate otp
    $verificationCode=$this->generateOtp($request->phone);
    $message="Your OTP to login is -".$verificationCode->otp;
    //return with otp
    return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',$message);
   }
    public function generateOtp($phone)
    {
      $user=User::where('phone',$phone)->first();
      
      $verificationCode=VerificationCode::where('user_id',$user->id)->latest()->first();
      $now=Carbon::now();

      if($verificationCode && $now->isBefore($verificationCode->expire_at) ){
         return $verificationCode;
      }

      //create new otp
     
      return VerificationCode::create([
        'user_id'=>$user->id,
        'otp'=>rand(123456,999999),
        'expire_at'=>Carbon::now()->addMinutes(10)
      ]);

}

public function verification($user_id)
{
    return view('auth.otp-verification')->with([
       'user_id'=> $user_id
    ]);
}

public function loginWithOtp(Request $request)
{
    $request->validate([
        'user_id'=>'required|exists:users,id',
        'otp'=>'required'
    ]);

    //verification logic

    $verificationCode=VerificationCode::where('user_id',$request->user_id)
    ->where('otp',$request->otp)->first();

    $now=Carbon::now();
    if(!$verificationCode){
        return redirect()->back()->
        with('error','your otp is not correct');
    }
    elseif($verificationCode && $now->isAfter($verificationCode->expire_at) ){
       return redirect()->route('otp.login')->with('error','your otp has been expired');
    }

    $user=User::whereId($request->user_id)->first();

    if($user){
        $verificationCode->update([
            'expire_at' => Carbon::now()
        ]);
        Auth::login($user);
         return redirect('/home');
    }
    return redirect()->route('otp.login')->with('error','your otp is not correct');
}
}





