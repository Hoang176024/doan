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
            'email.required' => 'Email không được bỏ trống !',
            'email.exists' => 'Email này không tồn tại trong cơ sở dữ liệu !',
            'email.email' => 'Email phải có định dạng là Email !',
        ]);

        $user = User::where('email', $request->email)->first();
        $resetCode = Str::random(40);
        $passwordReset = PasswordReset::create([
            'user_id' => $user->id,
            'reset_code' => $resetCode,
        ]);

        Mail::to($user->email)->send(new ForgetPasswordMail($user->full_name, $passwordReset->reset_code));
        return redirect()->back()->with('success', 'Vui lòng kiểm tra email để reset lại mật khẩu!');
    }

    public function resetPassword($resetCode)
    {
        $passwordResetData = PasswordReset::where('reset_code', $resetCode)->first();
        if (!$passwordResetData || Carbon::now()->subMinute(20) > $passwordResetData->created_at) {
            return redirect()->back()->route('forgetPassword')
                ->with('error', 'Link reset đã hết hiệu lực !');
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
            'email.required' => 'Email không được để trống !',
            'email.email' => 'Email phải có định dạng Email !',
            'password.required' => 'Password không được để trống !',
            'password.min' => 'Password phải có ít nhất 6 ký tự',
            'confirm_password.required' => 'Password xác nhận không được để trống',
            'confirm_password.same' => 'Password xác thực phải giống password',
        ]);

        if (!$passwordResetData || Carbon::now()->subMinute(20) > $passwordResetData->created_at) {
            return redirect()->back()->route('forgetPassword')
                ->with('error', 'Link reset passwork đã hết hiệu lực!');
        }else{
            $user = User::find($passwordResetData->user_id);
            if($user->email!=$request->email){
                return redirect()->back()
                    ->with('error', 'Email nhập không đúng với email cần đổi mật khẩu!');
            }else{
                $passwordResetData->delete();
                $user->update([
                    'password' => Hash::make($request->password)
                ]);

                return redirect()->route('login')
                    ->with('success', 'Thay đổi mật khẩu mới thành công !');
            }
        }
    }
}
