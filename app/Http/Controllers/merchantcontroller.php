<?php

namespace App\Http\Controllers;

use App\Mail\NewAdminWelcomEmail;
use App\Models\Merchant;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class merchantcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $merchants=Merchant::withCount('permissions')->with('car')->paginate(10);
        $merchant=Merchant::find(1);
        // $merchant->hasPermission();
        return response()->view('cms.merchant.index',['merchants'=>$merchants]);
    }

    /**
     * Show the form for creating a new resource.
     *sss
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.merchant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $valodator=Validator($request->all(),[
            'name' =>'required|string|min:3|max:30',
            'city'=>'required|string|min:3|max:30',
            'email' => 'required|string|min:3|max:30',
            'phone' => 'required|string|min:3|max:30',
            'gender' => 'required|in:M,F|string'
        ]);
        if(!$valodator->fails()){
        $merchant = new merchant();
        $merchant->name     = $request->get('name');
        $merchant->city    = $request->get('city');
        $merchant->email     = $request->get('email');
        $merchant->phone    = $request->get('phone');
        $merchant->gender = $request->get('gender');
        $merchant->password = Hash::make('ahmad2020');
        $isSaved = $merchant->save();

        if($isSaved){
            // Mail::to($merchant)->send(new NewAdminWelcomEmail($merchant));
            // Mail::to($merchant)->queue(new NewAdminWelcomEmail($merchant));
            event(new Registered($merchant));

        }
        return response()->json(['message' => $isSaved ? 'Merchant created successfully' : 'Failed to create merchant!'], $isSaved ? 201 : 400);

        }else{
        return response()->json(['message'=>$valodator->getMessageBag()->first()], 400);
        }
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
        //
        $merchants=merchant::findOrfail($id);
        return response()->view('cms.merchant.edit', ['merchant' => $merchants]);
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
        //
        $valodator=Validator($request->all(),[
            'name' =>'required|string|min:3|max:30',
            'city'=>'required|string|min:3|max:30',
            'email' => 'required|string|min:3|max:30',
            'phone' => 'required|string|min:3|max:30',
            'gender' => 'required|in:M,F|string'
        ]);
        if(!$valodator->fails()){
        $merchants =merchant::findOrFail($id);
        $merchants->name    = $request->get('name');
        $merchants->city   = $request->get('city');
        $merchants->email    = $request->get('email');
        $merchants->phone   = $request->get('phone');
        $merchants->gender = $request->get('gender');
        $merchants->password = Hash::make('ahmad2020');
        $isUpdated = $merchants->save();
        return response()->json(['message' => $isUpdated ? 'Merchant updated successfully' : 'Failed to updated merchant!'], $isUpdated ? 201 : 400);
        }else{
        return response()->json(['message'=>$valodator->getMessageBag()->first()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         // $merchants=Merchant::findOrFail($id);
        // $isDeleted=$merchants->delete();

        $isDeleted = merchant::destroy($id);
        if($isDeleted){
            // return redirect()->back();
            return response()->json(['title'=>'Deleted!','message'=>'The marchant is deleted!','icon'=>'success'],200);
        }else{
            return response()->json(['title'=>'Failed!','message'=>'The marchant is failed!','icon'=>'error'],400);
        }
    }
}
