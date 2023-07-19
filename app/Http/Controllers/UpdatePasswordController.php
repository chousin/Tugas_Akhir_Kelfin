<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nette\Schema\ValidationException;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException as IlluminateValidationException;




class UpdatePasswordController extends Controller
{
    public function edit()
    {

        return view('password.password', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Perbaharui Password"
        ]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            throw IlluminateValidationException::withMessages([
                'current_password' => 'Your current password is incorrect.',
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Your password has been updated successfully.');

    }
}