<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail\EmailConfirmation;
use Illuminate\Support\Facades\Mail;

class UserEmailConfirmationController extends Controller
{
    public function request(User $user)
    {
        if($user->confirmed()){
            return redirect()->home();
        }
        return view('request-email-confirmation', compact('user'));
    }

    public function sendEmail(User $user, Request $request)
    {
        $token = $user->getEmailConfirmationToken();
        Mail::to($user->email)->send(new EmailConfirmation($user, $token));
        return view('mails.email-send');
    }

    public function confirm(User $user, $token)
    {
        $userToConfirm = User::where('email', $user->email)->where('confirmation_token', $token)->first();

        if (! $userToConfirm) { 
            dd($user, $token);
            return redirect()->route('request-confirm-email', $user);
        }
        $userToConfirm->confirm();

        return redirect()->home();
    }
}
