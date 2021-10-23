<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LockController extends Controller
{
    public function locked(){

        return view('auth.locked');
    }


    public function unlock(Request $request) {
        
        if(Hash::check($request->password,Auth::user()->password)){

            session()->forget('locked');
            session()->put('last_request',time());
            return redirect()->route('home');
        }

        return redirect()->route('locked')->withErrors(['password' => 'Password Does not Match']);

    }
}
