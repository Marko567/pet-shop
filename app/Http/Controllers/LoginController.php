<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function index() {
        return view('login');
    }
    
    public function store(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Netacan email ili lozinka!');
        }
        
        return redirect()->route('myAds');
    }
}
