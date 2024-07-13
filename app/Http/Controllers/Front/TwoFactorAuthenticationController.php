<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthenticationController extends Controller
{
    public function __invoke()
    {
        $user=Auth::user();
        return view('front.auth.two-factor-auth',compact('user'));
    }
}
