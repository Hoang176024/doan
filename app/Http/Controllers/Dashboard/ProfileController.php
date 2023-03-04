<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with('roles', 'permissions')->where('email', Auth::user()->email)->first();
        $user->photo_url = $user->avatar ? Storage::url($user->avatar) : asset('image/no_img.png');
        return view('dashboard.profile.edit_profile')->with(compact('user', $user));
    }

    public function updateProfile(Request $request, $userId)
    {
        $request->validate([
            'full_name' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'avatar' => 'mimes:jpg,png'
        ], [
            'full_name.required' => 'Full name cannot be blank',
            'birthday.required' => 'Birthday cannot be blank',
            'address.required' => 'Address cannot be blank',
            'avatar.mimes' => 'Avatar must be .jpg or .png'
        ]);

        $user = User::with('roles', 'permissions')->find($userId);
        $path = $this->_upload($request);
        if ($path) {
            $avatar = $path;
        }
        if ($user) {
            $user->full_name = $request->full_name;
            $user->birthday = date('Y-m-d', strtotime($request->birthday));
            $user->address = $request->address;
            if ($path != null) {
                Storage::delete($user->avatar);
                $user->avatar = $avatar;
            }
            $user->save();
            return redirect()->back()->with('success', ('Success full updated'));
        } else {
            return redirect()->back()->with('error', ('Cannot find this user information'));
        }
    }

    public function changePassword(Request $request, $userId)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'retype_new_password' => 'required|same:new_password',

        ], [
            'old_password.required' => 'Old password filed cannot be blank',
            'new_password.required' => 'New password filed cannot be blank',
            'new_password.min' => 'New password have to be atleast 6 characters',
            'retype_new_password.required' => 'Confirm password field cannot be blank',
            'retype_new_password.same' => 'Confirm password field does not match with the new password',
        ]);

        $user = User::find($userId);
        if ($user) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                return redirect()->back()->with('success', ('Change password success'));
            } else {
                return redirect()->back()->with('error', ('Old password is incorect'));
            }
        }else{
            return redirect()->back()->with('error', ('Cannot find this user'));
        }
    }

    private function _upload($request)
    {
        if ($request->hasFile('avatar')) {
            $photo = $request->file('avatar');
            $path = $photo->storeAs('public/uploads/profile', $photo->getClientOriginalName());
            return $path;
        }
        return false;

    }
}
