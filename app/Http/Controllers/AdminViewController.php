<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Rules\GroupNameRule;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminViewController extends Controller
{
    public function index() {
        $users = DB::table('users')->get();
        $user = DB::table('users')->where('id', auth()->user()->id)->first();
        
        if($user->is_admin == '0') {
            return back();
        } else {
            return view('adminView', [
                'users' => $users
            ]);
        }
    }

    public function showGroupEdit() {
        $groups = DB::table('groups')->get();
        $categories = DB::table('categories')->get();
         
        return view('adminChangeGroup', [
            'groups' => $groups,
            'categories' => $categories,
        ]);
    }
    public function storeGroup(Request $request) {
        $this->validate($request, [
            'category_id' => 'required',
            'group_name' => 'unique:groups,name',
        ]);

        Group::create([
            'category_id' => $request->category_id,
            'name' => $request->group_name,
        ]);

        return redirect('/adminChangeGroup')->with('success', "Nova grupa je uspesno dodata!");
    }


    public function deleteUser($id) {
        $advertisements = DB::table('advertisements')->where('user_id', $id)->get();
        foreach($advertisements as $ad) {
            if(File::exists("C://Users/marko/petKP/public/images/" . $ad->image_path)) {
                File::delete("C://Users/marko/petKP/public/images/" . $ad->image_path);
            }
        }
        Advertisement::where('user_id', $id)->delete();
        $user = User::find($id);
        $user->delete();

        return redirect()->route('adminView');
    }
    
    public function showUserEdit($id) {
        $user = DB::table('users')->where('id', $id)->first();
        return view('adminEditUser', [
            'user' => $user,
            'user_id' => $id
        ]);
    }
    public function showUsersAds($id) {
        $advertisements = DB::table('advertisements')->where('user_id', $id)->get();

        return view('adminShowAds', [
            'advertisements' => $advertisements,
        ]);
    }
    public function adminEditUser(Request $request) {
        $user_id = $request->user_id;
        
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
        return back()->with('success', 'Uspesno izvrsena izmena podataka o korisniku!');
    }
    public function adminShowAdEdit($ad_id) {
        return view('adminAdEdit', [
            'ad_id' => $ad_id
        ]);
    }
    public function adminAdEdit(Request $request) {
        $request->validate([
            'name' => 'max:150',
            'price' => 'nullable|numeric',
            'description' => 'max:1000',
            'image' => 'mimes:jpg,png,jpeg|max:6144',
        ]);

        $adId = $request->adId;
        if($request->name != null) {
            DB::update('UPDATE advertisements SET name = ? WHERE id = ?', [$request->name, $adId]);
        }
        if($request->adType != null) {
            DB::update('UPDATE advertisements SET adType = ? WHERE id = ?', [$request->adType, $adId]);
        }
        if($request->price != null) {
            DB::update('UPDATE advertisements SET price = ? WHERE id = ?', [$request->price, $adId]);
        }
        if($request->currency != null) {
            DB::update('UPDATE advertisements SET currency = ? WHERE id = ?', [$request->currency, $adId]);
        }
        if($request->description != null) {
            DB::update('UPDATE advertisements SET description = ? WHERE id = ?', [$request->description, $adId]);
        }
        if($request->image != null) {
            $newImageName = time() . '-' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $newImageName);
            $ad = DB::table('advertisements')->where('id', $adId)->first();
            $oldImagePath = $ad->image_path;

            if(File::exists("C://Users/marko/petKP/public/images/" . $oldImagePath)) {
                File::delete("C://Users/marko/petKP/public/images/" . $oldImagePath);
            }

            DB::update('UPDATE advertisements SET image_path = ? WHERE id = ?', [$newImageName, $adId]);
        }

        return redirect('adminView');
    }
    public function adminDeleteAd(Request $request){
        $advertisement = DB::table('advertisements')->where('id', $request->ad_id)->first();
        $image_path = $advertisement->image_path;

        if(File::exists("C://Users/marko/petKP/public/images/" . $image_path)) {
            File::delete($image_path);
        }
        DB::delete('DELETE FROM advertisements WHERE id = ?', [$request->ad_id]);
        
        return back()->with('success', "Oglas korisnika je uspesno obrisan!");
    }
}
