<?php

namespace App\Http\Controllers;

use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function password()
    {
        return view('user.password.edit');
    }

    function passwordUpdate(Request $request)
    {
        $user = auth()->user();
        
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ])->after(function ($validator) use ($user, $request) {
            if (! isset($request['current_password']) || ! Hash::check($request['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user->forceFill([
            'password' => Hash::make($request['password']),
        ])->save();

        return redirect('home')->with('success', 'Contraseña actualizada correctamente');
    }
}
