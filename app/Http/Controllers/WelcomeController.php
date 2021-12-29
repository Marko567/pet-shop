<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index($category_name) {

        $category = DB::table('categories')->where('name', $category_name)->first();
        $users = DB::table('users')->get();
        
        return view('/welcome',[
            'cat_id' => $category->id,
            'advertisements' => DB::table('advertisements')->where('category_id', $category->id)->simplePaginate(4),
            'users' => $users,
        ]);
    }

    public function showSortedAds() {
        $users = DB::table('users')->get();
        return view('/welcome',[
            'advertisements' => DB::table('advertisements')->orderBy('created_at', 'desc')->simplePaginate(4),
            'users' => $users
        ]);
    }
}
