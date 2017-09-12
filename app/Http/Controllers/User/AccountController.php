<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Auth;

class AccountController extends Controller
{
    public function account() {
        return view('user.account');
    }
    public function account_characters() {
        $chars = Auth::user()->characters()->where('bDeleted', 0)->orderBy('nLevel', 'desc')->paginate(5);
        return view('user.characters')->with(['characters' => $chars]);
    }
    public function changePassword(Request $r) {
        $v = Validator::make($r->only(['opass', 'pass', 'pass_confirmation']), [
            'opass' => 'required',
            'pass' => 'required|confirmed',
            'pass_confirmation' => 'required'
        ], [
            'opass' => 'Current Password',
            'pass' => 'New Password',
            'pass_confirmation' => 'New Password Confirmation'
        ]);
        if ($v->fails()) {
            return redirect()
                ->back()
                ->withErrors($v)
                ->withInput();
        }
        $user = Auth::user();
        if(Hash::check($r->input('opass'), $user->password)) {
            $user->password = Hash::make($r->input('pass'));
            $user->save();
            return redirect()->back()->with('message', 'Password has been changed.');
        } else {
            $v->errors()->add('opass', 'Current Password does not match with the saved one.');
            
            return redirect()
                ->back()
                ->withErrors($v)
                ->withInput();
        }
    }
    public function redeemCard(Request $r) {
        
    }
}
