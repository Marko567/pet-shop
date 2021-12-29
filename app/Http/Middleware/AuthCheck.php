<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        if (!Auth::check() && ($request->path() != 'login' && $request->path() != 'register' &&
        $request->path() != '/' && $request->path() != 'welcome' && $request->path() != 'forgot-password' &&
        $request->path() != 'reset-password/{token}' && $request->path() != 'newest' && !$request->is('welcome/*'))){
            return redirect('login')->with('fail', 'Morate biti logovani!');
        }

        if (Auth::check() && ($request->path() == 'login' || $request->path() == 'register' ||
        $request->path() == '/' || $request->path() == 'welcome' ||
        $request->path() == 'forgot-password' && $request->path() == 'reset-password/{token}' ||
        $request->path() == 'newest' || $request->is('welcome/*'))) {
            return back();
        }
        
        if (Auth::check() && User::where('id', auth()->user()->id)->first()->is_admin == 0 && 
        ($request->path() == 'adminView' || $request->is('adminShowAds/*') || 
        $request->is('adminEditUser/*') || $request->path() == 'adminChangeGroup' || 
        $request->is('adminAdEdit/*') || $request->is('delete/*'))) {
            return redirect('myAds')->with('fail', 'Nemate prava da pristupite ovoj stranici!');
        }
        
        if (Auth::check() && User::where('id', auth()->user()->id)->first()->is_admin == 1 && 
        ($request->path() == '/' || $request->path() == 'welcome' || $request->path() == 'myAds' || 
        $request->path() == 'makeAd' || $request->path() == 'myProfile' || $request->path() == 'myProfileEdit' || 
        $request->path() == 'reset-password' || $request->path() == 'advertisementEdit')) {
            return redirect('adminView')->with('fail', 'Nemate prava pristupa kao admin!');
        }
        
        return $next($request)->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')->header('Pragma', 'no-cache')->header('Expires', 'Sat 01 Jan 1990 00:00:00 GMT');
    }
}
