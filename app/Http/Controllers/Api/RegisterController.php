<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'first_name' => ucfirst($request->first_nam),
            'middle_name' => ucfirst($request->middle_name),
            'last_name' => ucfirst($request->last_name),
            'username' => $request->username,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'password' => Hash::make($request->password),
        ]);
        $role = Role::findOrFail(3);
        $user->assignRole($role);
        return $user;
    }
}
