<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class MyAdsController extends Controller
{   
    public function index() {
        $id = auth()->user()->id;
        $advertisements = DB::table('advertisements')->where('user_id', $id)->simplePaginate(2);
        
        return view('myAds', [
            'ads' => $advertisements,
        ]);
    }
    public function filterAds($category_name) {

        $category = DB::table('categories')->where('name', $category_name)->first();
        
        return view('myAds',[
            'ads' => DB::table('advertisements')->where('user_id', auth()->user()->id)->where('category_id', $category->id)->simplePaginate(2),
        ]);
    }
}
