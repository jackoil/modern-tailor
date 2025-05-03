<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerifyMail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\OTPSms;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function loginSms(Request $request)
    {

        if ($request->method() == 'GET') {
             return view('auth.loginSms');
       }

        $request->validate([
            'cellphone' => 'required|iran_mobile'
        ]);

        try {

            $user = User::where('cellphone', $request->cellphone)->first();

            $OTPCode = mt_rand(100000, 999999);
            $loginToken = Hash::make('DCDCojncd@cdjn%!!ghnjrgtn&&');

            if ($user) {

                $user->update([
                    'otp' => $OTPCode,
                    'login_token' => $loginToken
                ]);

            } else {
                $user = User::Create([
                    'cellphone' => $request->cellphone,
                    'otp' => $OTPCode,
                    'login_token' => $loginToken
                ]);
            }

            $user->notify(new OTPSms($OTPCode));

            return response(['login_token' => $loginToken ,'code' => $OTPCode], 200);
        } catch (Exception $ex) {

            return response(['errors' => $ex->getMessage()], 422);
        }

    }

    public function checkOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
            'login_token' => 'required'
        ]);

        try {
            $user = User::where('login_token', $request->login_token)->firstOrFail();

            if ($user->otp == $request->otp) {
                auth()->login($user, $remember = true);
                return response(['ورود با موفقیت انجام شد'], 200);
            } else {
                return response(['errors' => ['otp' => ['کد تاییدیه نادرست است']]], 422);
            }
        } catch (Exception $ex) {
            return response(['errors' => $ex->getMessage()], 422);
        }
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'login_token' => 'required'
        ]);

        try {

            $user = User::where('login_token', $request->login_token)->firstOrFail();
            $OTPCode = mt_rand(100000, 999999);
            $loginToken = Hash::make('DCDCojncd@cdjn%!!ghnjrgtn&&');

            $user->update([
                'otp' => $OTPCode,
                'login_token' => $loginToken
            ]);

            $user->notify(new OTPSms($OTPCode));

            return response(['login_token' => $loginToken], 200);
        } catch (Exception $ex) {
            return response(['errors' => $ex->getMessage()], 422);
        }
    }

    public function redirectToProvider($provider)
    {
         return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {
            try{


        $socialite_user =  Socialite::driver($provider)->user();

    } catch(Exception $ex){
             return redirect()->route('login');
    }
       $user = User::where('email' , $socialite_user->getEmail())->first();
       if(!$user) {
        $user = User::create([
             'name'=> $socialite_user->getName(),
             'provider_name'=> $provider,
             'avatar'=> $socialite_user->getAvatar(),
             'email'=> $socialite_user->getEmail(),
             'password'=> Hash::make($socialite_user->getId()),
            //  'email_verified_at'=> Carbon::now()
         ]);

         Request::user()->sendEmailVerificationNotification();

       }
         ($user->sendEmailVerificationNotification());
    //    Mail::to($user)->send(new VerifyMail());



       auth()->login($user,$remember = true);
       alert()->success( "تشکر" , '!خوش امدی' )->persistent('حله');
       return  redirect()->route('home.index')   ;
   }
}
