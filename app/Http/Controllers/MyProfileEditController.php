<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\OldPasswordRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyProfileEditController extends Controller
{
    public function index() {
        if(auth()->user()->is_admin == '1') {
            return redirect()->route('adminView');
        }
        return view('myProfileEdit');
    }

    public function userUpdate(Request $request) {
        
        $this->validate($request, [
            'name' => 'max:255|nullable',
            'email' => 'unique:users, email|email|nullable',
            'city' => 'max:255|nullable',
            'phone_number' => 'nullable|string|min:8|max:11',
        ]);

        $user_id = auth()->user()->id;
        if($request->name != null) {
            DB::update('UPDATE users SET name = ? WHERE id = ?', [$request->name, $user_id]);
        }
        if($request->email != null) {
            DB::update('UPDATE users SET email = ? WHERE id = ?', [$request->email, $user_id]);
        }
        if($request->city != null) {
            DB::update('UPDATE users SET city = ? WHERE id = ?', [$request->city, $user_id]);
        }
        if($request->phone_number != null) {
            DB::update('UPDATE users SET phone_number = ? WHERE id = ?', [$request->phone_number, $user_id]);
        }

        return redirect('/myProfile');
    }
    public function change_password(Request $request) {
        $this->validate($request, [
            'old_password' => new OldPasswordRule,
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|min:8'
        ]);

        if($request->new_password != $request->new_password_confirmation){
            return back()->with('error', "Unete lozinke se ne podudaraju!");
        }

        DB::update('UPDATE users SET password = ? WHERE id = ?', [Hash::make($request->new_password), auth()->user()->id]);
        auth()->logout();

        return redirect('/login')->with('success', "Uspesno izvrsena promena lozinke!");
    }
}
