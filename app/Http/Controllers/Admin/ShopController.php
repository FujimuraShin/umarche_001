<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index(){

        //$owner_id=Auth::id();
        //$shops=Shop::where('owner_id',$owner_id)->get();
        $shops=Shop::all();

        return view('shops.index',compact('shops'));
    }

    public function edit($id){
        dd(Shop::findOrFail($id));
    }

    public function update(Request $request,$id){

    }


}
