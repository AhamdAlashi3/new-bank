<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Database\Seeders\CustomerSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class customercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $this->authorize('viewAny',customer::class);
        $customers=customer::paginate(10);
        if($request->expectsJson()){
            return response()->json(['status'=>true,'message'=>'Success','data'=>$customers]);
        }else{
        return response()->view('cms.customer.index',['customers'=>$customers]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $this->authorize('create',customer::class);
        return response()->view('cms.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $this->authorize('create',customer::class);
        $validator=Validator($request->all(),[
            'cus_name' =>'required|string|min:3|max:30',
            'city'=>'required|string|min:3|max:30',
            'work'=>'required|string|min:3|max:30',
            'email' => 'required|string|min:3|max:30',
            'phone' => 'required|string|min:3|max:30',
            'images'=>'required',
            // 'gender' => 'required|in:M,F'

        ]);
        if(!$validator->fails()){
            $customers =new customer();
            $customers->cus_name=$request->get('cus_name');
            $customers->city=$request->get('city');
            $customers->work=$request->get('work');
            $customers->email=$request->get('email');
            $customers->phone=$request->get('phone');
            $customers->images=$request->get('images');
            // $customers->gender=$request->get('gender');
            if ($request->hasFile('image')) {
                $adminImage = $request->file('image');
                $imageName = time() . '_' . $request->get('cus_name') . '.' . $adminImage->getClientOriginalExtension();
                $adminImage->move('images/customer/', $imageName);
                $customers->image = $imageName;
            }
            $customers->password=Hash::make('Pass123$');
            $isSaved=$customers->save();
            return response()->json(['message' => $isSaved ? 'Customer Created Successfly ' : 'Falied to create customer'],$isSaved ? 201 : 400);
        }else{
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
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
        // $this->authorize('view',customer::find($id));

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
        $customers=customer::findOrFail($id);
        $this->authorize('update',$customers);
        $customers=customer::findOrFail($id);
        return response()->view('cms.customer.edit', ['customer' => $customers]);
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
        $customers=customer::findOrFail($id);
        $this->authorize('update',$customers);

        $request->validate([

            'cus_name' =>'required|string|min:3|max:30',
            'city'=>'required|string|min:3|max:30',
            'work'=>'required|string|min:3|max:30',
            'email' => 'required|string|min:3|max:30',
            'phone' => 'required|string|min:3|max:30',
            // 'gender' => 'required|string|in:M,F'

        ]);

        $customers = new customer();
        $customers->name     = $request->get('name');
        $customers->city     = $request->get('city');
        $customers->email    = $request->get('email');
        $customers->phone    = $request->get('phone');
        $customers->password=Hash::make('ahmad2020');
        // $customers->gender   = $request->get('gender');
        $isUpdated = $customers->save();
        if($isUpdated){
           // return redirect()->bake();
           return redirect()->route('customer.index');
           session()->flash('message','customers updated successfully');
         }else{
            session()->flash('message','falid updated customers');
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
        $customers=customer::findOrFail($id);
        $this->authorize('delete',$customers);

        $isDeleted = customer::destroy($id);
        if($isDeleted){
            // return redirect()->back();
            return response()->json(['title'=>'Deleted!','message'=>'The customer is deleted!','icon'=>'success']);
        }else{
            return response()->json(['title'=>'Failed!','message'=>'The customer is failed!','icon'=>'error'],400);
        }
    }
}
