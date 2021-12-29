<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyProfileController extends Controller
{   
    public function index() {
        if(auth()->user()->is_admin == '1') {
            return redirect()->route('adminView');
        }
        
        $user = DB::table('users')->where('id', auth()->user()->id)->first();

        return view('myProfile',[
            'user' => $user,
        ]);
    }
}
