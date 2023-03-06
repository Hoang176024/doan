<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\EmailVerificationMail;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('dashboard.auth.register');
    }

    public function process(RegisterRequest $request)
    {
        $gRecaptcha = $request->grecaptcha;

        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' =>
                    [
                        'secret' => env('google_captcha_secrect'),
                        'response' => $gRecaptcha
                    ]
            ]
        );
        $body = json_decode((string)$response->getBody());

        if ($body->success == true) {
            $user = User::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verification_code' => Str::random(40),
            ]);

            Mail::to($request->email)->send(new EmailVerificationMail($user));
            return redirect()->intended(route('login'))->with('successfull', 'Check your mail to confirm email !');
        }else{
            return redirect()->back()->with('error', 'Google recaptcha không hợp lệ !');
        }
    }

    public function verifyEmail($verification_code){
        $user = User::where('email_verification_code', $verification_code)->first();
        if(!$user){
            return redirect()->route('register')->with('error', 'Url xác thực không chính xác');
        }else{
            if($user->email_verified_at){
                return redirect()->route('register')->with('error', 'Email này chưa được xác thực');
            }else{
                $user->update([
                   'email_verified_at' => Carbon::now(),
                ]);
                //Assign Role and Permission for new $user;
                $user->assignRole('Seller');
                $user->givePermissionTo('Không Quyền');
                return redirect()->route('register')->with('success', 'Xác thực email thành công !');
            }
        }
    }
}
