<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function change_password()
    {
        return view('account.change-password');
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'old_password' => ['required', new MatchOldPassword],
            'password_confirmation' => ['required'],
            'new_password' => ['required', 'same:password_confirmation']
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('change_password')
                        ->with('success','Password updated successfully');
    }

    public function edit_profile()
    {
        $user = User::find(auth()->user()->id);
        return view('account.update-profile')->with('user', $user);
    }

    public function update_profile(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required'
        ]);
        
        User::find(auth()->user()->id)->update($request->input());

        return redirect()->route('edit_profile')
                        ->with('success','Profile updated successfully');
    }
}
