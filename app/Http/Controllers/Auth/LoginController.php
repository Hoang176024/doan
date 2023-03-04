<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\Auth\LoginRequest;

use App\Models\User;

use GuzzleHttp\Client;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;


session_start();


class LoginController extends Controller
{
    
    /**
     * Hàm index
     */
    public function index()
    {
        return view('dashboard.auth.login');
    }

    public function process(LoginRequest $request)
    {
       $request->validated();

            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    if ($user->email_verified_at) {
                        if (auth()->attempt($request->only('email', 'password'))) {
                            $user = Auth::user();
                            return redirect()->intended(route('admin.dashboard'))->with('success',
                                'Chào mừng quay trở lại ' . $user->full_name);     
                        }                
                    } else {
                        return redirect()->back()->withInput()->with('error', 'Email have not been confirm');
                    }
                } else {
                    return redirect()->back()->withInput()->with('error', 'Wrong password');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Invalid email');
            }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect(route('login'));
    }
}
