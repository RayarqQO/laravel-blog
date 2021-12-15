<?php

namespace App\Http\Controllers;

use App\Mail\SubscribeEmail;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubsController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'email' => 'required|email|unique:subscriptions'
        ]);

        $subs = Subscription::add($request->get('email'));
        $subs->generateToken();
        Mail::to($subs)->send(new SubscribeEmail($subs));

        return back()->with('Status', 'Check your email');
    }

    public function verify($token)
    {
        $subs = Subscription::where('token', '=', $token)->firstOrFail();
        $subs->token = null;
        $subs->save();

        return redirect('/')->with('status', 'Your email was verified');
    }
}
