<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function getLogin(Request $request)
    {
        if (Auth::user()) {
            return redirect()->route("home");
        }
        return view("auth.login");
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|username|max:255|exists:users',
            'password' => 'required|string|min:6',
        ]);

        $validator->after(function ($validator) use ($request) {
            $user = User::where('username', $request->username)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                $validator->errors()->add('password', 'Password is incorrect');
            } else {
                Auth::attempt([
                    'username' => $request->username,
                    'password' => $request->password
                ], $request->has('remember'));
            }
        });

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        return redirect()->route("home");
    }
    public function getLogout(Request $request)
    {
        Auth::logout();
        return redirect()->route("login");
    }

    public function checkEmail(Request $request)
    {
        $usernameExists = User::where('email', $request->username)->exists();

        if ($usernameExists) {
            return response()->json(['available' => false, 'message' => 'Username sudah terdaftar']);
        } else {
            return response()->json(['available' => true]);
        }
    }
}
