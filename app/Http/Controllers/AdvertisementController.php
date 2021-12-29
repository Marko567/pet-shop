<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;


class AdvertisementController extends Controller
{   
    public function index() {
        $categories = Category::all();
        return view('/makeAd', ['categories' => $categories]);
    }
    public function findGroupName(Request $request) {
        $data = Group::select('name', 'id')->where('category_id', $request->id)->take(100)->get();
        return response()->json($data);
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:150',
            'category' => 'required',
            'adType' => 'required',
            'price' => 'required|numeric',
            'currency' => 'required',
            'description' => 'max:1000',
            'image' => 'mimes:jpg,png,jpeg|max:6144',
        ]);
        $filename = $resizedImage = $newImageName = null;
        if($request->image != null) {
            //smanji unetu sliku
            $filename = $request->image->getClientOriginalName();
            $resizedImage = Image::make($request->image->getRealPath());
            $resizedImage->resize(200, 200);
            $resizedImage->save(public_path('resizedImages/'. $filename));
            
            //Original cuvaj u poseban direktorijum
            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
        }
        // smesti oglas u bazu - nov red u bazi...
        $id = auth()->user()->id;
        Advertisement::create([
            'user_id' => $id,
            'name' => $request->name,
            'category_id' => $request->category,
            'group_id' => $request->group,
            'adType' => $request->adType,
            'price' => $request->price,
            'currency' => $request->currency,
            'description' => $request->description,
            'image_path' => $newImageName
        ]);

        return redirect('/myAds');
    }
}
