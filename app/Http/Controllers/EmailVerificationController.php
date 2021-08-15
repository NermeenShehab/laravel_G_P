<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\User;
use Illuminate\Foundation\Auth\VerifiesEmails;

class EmailVerificationController extends Controller
{
    use VerifiesEmails;
    protected $redirectTo = '/';
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    // public function sendVerificationEmail(Request $request)
    // {
    //     if ($request->user()->hasVerifiedEmail()) {
    //         return [
    //             'message' => 'Already Verified'
    //         ];
    //     }

    //     $request->user()->sendEmailVerificationNotification();

    //     return ['status' => 'verification-link-sent'];
    // }

    // public function verify(EmailVerificationRequest $request)
    // {$user = User::find($request->id);
    //     if ($request->user()->hasVerifiedEmail()) {
    //         return [
    //             'message' => 'Email already verified'
    //         ];
    //     }

    //     if ($request->user()->markEmailAsVerified()) {
    //         event(new Verified($request->user()));
    //     }

    //     return [
    //         'message'=>'Email has been verified'
    //     ];
        // return redirect()->away('http://localhost:4200/home')->with('user',$user);
        //                         // ->with('pass_code',$pass_code)
        //                         // ->with('amount',$amount)
        //                         // ->with('hash_value',$hash_value);
    // }
        public function verify(Request $request)
        {
            $user = User::find($request->id);

            if ($request->route('id') != $user->getKey()) {
                throw new AuthorizationException;
            }

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }

            return redirect($this->redirectPath())->with('verified', true);
        }



}
