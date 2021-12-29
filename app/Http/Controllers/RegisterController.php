<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('register');
    }

    public function store(Request $request) {
        // validacija
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'unique:users,email|required|email|max:255',
            'password' => 'required|confirmed',
            'city' => 'required|max:255',
            'phone_number' => 'required|string|min:8|max:11',
        ]);
        
        // sacuvaj korisnika u bazu
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'city' => $request->city,
            'phone_number' => $request->phone_number
        ]);

        // uloguj korisnika
        auth()->attempt($request->only('email', 'password'));
        // redirect
        return redirect('/myAds');
    }
}
