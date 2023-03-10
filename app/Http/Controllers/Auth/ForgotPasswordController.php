<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    
    public function show_forgot_password(){
        return view('auth.passwords.forgot-password');
    }
    public function get_password_link(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $status = Password::sendResetLink(
            $request->only('email')
        );


        return back()->with('message',__('passwords.sent'));
    }
}
