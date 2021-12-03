<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner; //Eloquent
use Illuminate\Support\Facades\DB; //QueryBuilder
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;

class OwnersController extends Controller
{
   
    public function index()
    {
        //
        //$e_all=Owner::all();
        //$q_get=DB::table('owners')->select('name','created_at')->get();
       //$q_first=DB::table('owners')->select('name')->first();
        
        //$c_test=collect(['
            //'name'=>'テスト'
        //]);
        
        //dd($e_all,$q_get,$q_first,$c_test);

        $owners=Owner::select('id','name','email','created_at')->get();

        return view('owners.index',compact('owners'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:owners',
            'password' => 'required|confirmed|string|min:8',
        ]);

        Owner::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        return redirect()
        ->route('owners.index')
        ->with(['message'=>'オーナ登録を実施しました',
                'status'=>'info',
                ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $owner=Owner::findOrFail($id);
        //dd($owner);
        return view('owners.edit',compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);

        $owner=Owner::findOrFail($id);

        $owner->name=$request->name;
        $owner->email=$request->email;
        $owner->password=Hash::make($request->password);

        $owner->save();

        return redirect()
        ->route('owners.index')
        ->with(['message'=>'オーナ情報の更新しました',
                'status'=>'info',
                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Owner::findOrFail($id)->delete();//ソフトデリート

        return redirect()
        ->route('owners.index')
        ->with(['message'=>'オーナ情報の削除しました',
                'status'=>'alert',
                 ]);
    }

    public function expiredOwnerIndex(){
        $expiredOwners=Owner::onlyTrashed()->get();

        return view('expired-owners',compact('expiredOwners'));
    }

    public function expiredOwnerDestroy($id){
        Owner::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('expired-owners.index');
    }
}
