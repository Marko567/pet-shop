<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyAdsController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\MyProfileEditController;
use App\Http\Controllers\AdvertisementEditController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['AuthCheck']], function(){
Route::get('/', function () {
    $users = DB::table('users')->get();
    $categories = DB::table('categories')->get();
    return view('welcome',[
        'advertisements' => DB::table('advertisements')->simplePaginate(4),
        'users' => $users,
        'categories' => $categories,
    ]);
});

Route::get('/welcome', function() {
    $categories = DB::table('categories')->get();
    $users = DB::table('users')->get();
    return view('welcome',[
        'advertisements' => DB::table('advertisements')->simplePaginate(4),
        'users' => $users,
        'categories' => $categories,
    ]);
});

Route::get('/welcome/{category}', [WelcomeController::class, 'index']);

Route::get('/newest', [WelcomeController::class, 'showSortedAds']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');



Route::get('/myAds', [MyAdsController::class, 'index'])->name('myAds');
Route::post('/myAds', [AdvertisementEditController::class, 'deleteMyAd']);
Route::get('/myAds/{category}', [MyAdsController::class, 'filterAds']);

Route::get('/makeAd', [AdvertisementController::class, 'index']);
Route::post('/makeAd', [AdvertisementController::class, 'store']);

Route::get('/findGroupName', [AdvertisementController::class, 'findGroupName']);

Route::get('/adminView', [AdminViewController::class, 'index'])->name('adminView');

Route::get('/adminEditUser/{id}', [AdminViewController::class, 'showUserEdit']);
Route::get('/delete/{id}', [AdminViewController::class, 'deleteUser']);
Route::get('/adminShowAds/{id}', [AdminViewController::class, 'showUsersAds']);
Route::post('/adminEditUser', [AdminViewController::class, 'adminEditUser']);
Route::get('/adminAdEdit/{ad_id}', [AdminViewController::class, 'adminShowAdEdit']);
Route::post('/adminAdEdit', [AdminViewController::class, 'adminAdEdit']);
Route::post('/adminShowAds/{user_id}', [AdminViewController::Class, 'adminDeleteAd']);

Route::get('/adminChangeGroup', [AdminViewController::class, 'showGroupEdit']);
Route::post('/adminView2', [AdminViewController::class, 'storeGroup']);

Route::get('/myProfile', [MyProfileController::class, 'index']);

Route::get('/myProfileEdit', [MyProfileEditController::class, 'index']);
Route::post('/myProfileEdit/other_data', [MyProfileEditController::class, 'userUpdate']);
Route::post('/myProfileEdit/password', [MyProfileEditController::class, 'change_password']);

Route::get('/advertisementEdit/{id}', [AdvertisementEditController::class, 'index']);
Route::post('/advertisementEdit', [AdvertisementEditController::class, 'updateAd']);

Route::get('/forgot-password', function () {
    return view('forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');



Route::get('/reset-password/{token}', function ($token) {
    return view('reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8',
        'password_confirmation' => 'required|min:8',
    ]);
    if($request->password != $request->password_confirmation){
        return back()->with('error', "Unete lozinke se ne podudaraju!");
    }
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
});

Route::post('/logout', [LogoutController::class, 'logout']);
Route::post('/login', [LoginController::class, 'store']);