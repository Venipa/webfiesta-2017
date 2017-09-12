<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\User;
use Hash;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }
    public function login_post(Request $r) {
        $v = Validator::make($r->only(['email', 'password', 'g-recaptcha-response']), [
            'g-recaptcha-response' => config('app.env') == "local" ? 'sometimes|required|recaptcha' : 'required|recaptcha',
            'email' => 'required|email|exists:tAccounts,email',
            'password' => 'required'
        ]);
        if ($v->fails()) {
            return redirect()
                ->back()
                ->withErrors($v)
                ->withInput();
        }
        if(Auth::attempt(['email' => $r->input('email'), 'password' => $r->input('password')])) {
            return redirect()->route('view:home');
        } else {
            $v->errors()->add('password', 'Wrong Password');
            return redirect()->back()->withErrors($v);
        }
    }
    public function register() {
        return view('auth.register');
    }
    public function register_post(Request $r) {
        $v = Validator::make($r->all(), [
            'g-recaptcha-response' => config('app.env') == "local" ? 'sometimes|required||recaptcha' : 'required|recaptcha',
            'username' => 'required|unique:tAccounts,username',
            'email' => 'required|email|unique:tAccounts,email',
            'password' => 'required|confirmed|min:6|max:16'
        ]);
        if ($v->fails()) {
            return redirect()
                ->back()
                ->withErrors($v)
                ->withInput();
        }
        $user = User::create([
            'email' => $r->input('email'),
            'username' => $r->input('username'),
            'password' => Hash::make($r->input('password')),
            'sIP' => $r->ip()]);
        if(count($user) > 0)
            return view('login');
        else
            return view('register');
    }
    public function resetpassword() {
        return view('auth.password_reset');
    }
    public function resetpassword_post(Request $r) {
    }

    public function logout() {
        if(Auth::logout()) {
            return redirect()->route('view:home');
        }
            return redirect()->back();
        
    }
}
