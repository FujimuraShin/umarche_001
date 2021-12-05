<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;

class ShopController extends Controller
{
    public function index(){

        //$owner_id=Auth::id();
        //$shops=Shop::where('owner_id',$owner_id)->get();
        ///phpinfo();

        $shops=Shop::all();

        return view('shops.index',compact('shops'));
    }

    public function edit($id){
        //dd(Shop::findOrFail($id));
        $shop=Shop::findOrFail($id);

        return view('shops.edit',compact('shop'));
    }

    public function update(UploadImageRequest $request,$id){
        
        $imageFile=$request->image;

        if(!is_null($imageFile) && $imageFile->isValid()){

            //$fileName=ImageService::upload($imageFile,'shops');
            //Storage::putFile('public/shops',$imageFile);

            $fileNameToStore=ImageService::upload($imageFile,'shops');

            //$filename=uniqid(rand().'_');
            //$extension=$imageFile->extension();
            //$fileNameToStore=$filename.'.'.$extension;

            //$resizedImage=InterventionImage::make($imageFile)->resize(1920,1080)->encode();


            //Storage::put('public/shops/'.$fileNameToStore,$resizedImage);
        }

        $shop=Shop::findOrFail($id);
        $shop->name=$request->name;
        $shop->information=$request->information;
        $shop->is_selling=$request->is_selling;

        if(!is_null($imageFile) && $imageFile->isValid()){
            $shop->filename=$fileNameToStore;
            //dd($shop->filename);
        }

        $shop->save();
        
        return redirect()->route('shops.index',$shop);
    }


}
