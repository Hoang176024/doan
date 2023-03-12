<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    public function index()
    {
        return view('dashboard.auth.forget_password');
    }

    public function process(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ], [
            'email.required' => '"Email cannot be empty!',
            'email.exists' => 'This email does not exist in the database. !',
            'email.email' => 'Email must be in email format !',
        ]);

        $user = User::where('email', $request->email)->first();
        $resetCode = Str::random(40);
        $passwordReset = PasswordReset::create([
            'user_id' => $user->id,
            'reset_code' => $resetCode,
        ]);

        Mail::to($user->email)->send(new ForgetPasswordMail($user->full_name, $passwordReset->reset_code));
        return redirect()->route('login')->with('success', 'Please check your email to reset your password.!');
    }

    public function resetPassword($resetCode)
    {
        $passwordResetData = PasswordReset::where('reset_code', $resetCode)->first();
        if (!$passwordResetData || Carbon::now()->subMinute(20) > $passwordResetData->created_at) {
            return redirect()->back()->route('forgetPassword')
                ->with('error', 'The reset link has expired !');
        }else{
           return view('dashboard.auth.reset_password', compact('resetCode'));
        }
    }

    public function resetPasswordProcess(Request $request, $resetCode){
        $passwordResetData = PasswordReset::where('reset_code', $resetCode)->first();

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ],[
            'email.required' => 'Email cannot be empty !',
            'email.email' => 'Email must be in email format !',
            'password.required' => 'Password cannot be empty !',
            'password.min' => 'Password must be at least 6 characters',
            'confirm_password.required' => 'Retype Password cannot be empty',
            'confirm_password.same' => 'The retype-password must be the same as the password',
        ]);

        if (!$passwordResetData || Carbon::now()->subMinute(20) > $passwordResetData->created_at) {
            return redirect()->back()->route('forgetPassword')
                ->with('error', 'Password reset link has expired!');
        }else{
            $user = User::find($passwordResetData->user_id);
            if($user->email!=$request->email){
                return redirect()->back()
                    ->with('error', 'The entered email does not match the email associated with the password change request!');
            }else{
                $passwordResetData->delete();
                $user->update([
                    'password' => Hash::make($request->password)
                ]);

                return redirect()->route('login')
                    ->with('success', 'Successfully changed new password!');
            }
        }
    }
}
