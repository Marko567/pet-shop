<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdvertisementEditController extends Controller
{
    public function index($id) {
        return view('advertisementEdit',[
            'id' => $id,
        ]);
    }
    public function updateAd(Request $request) {
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
            
            DB::update('UPDATE advertisements SET image_path = ? WHERE id = ?', [$newImageName, $adId]);
        }

        return redirect('myAds');
    }

    public function deleteMyAd(Request $request) {
        $advertisement = DB::table('advertisements')->where('id', $request->ad_id)->first();
        $image_path = $advertisement->image_path;

        if(File::exists("C://Users/marko/petKP/public/images/" . $image_path)) {
            File::delete("C://Users/marko/petKP/public/images/" . $image_path);
        }
        DB::delete('DELETE FROM advertisements WHERE id = ?', [$request->ad_id]);
        
        return redirect()->route('myAds');
    }
}
