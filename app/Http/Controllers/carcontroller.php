<?php

namespace App\Http\Controllers;

use App\Models\car;
use App\Models\Merchant;
use Illuminate\Http\Request;

class carcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $cars=car::paginate(10);
        $cars=car::with('merchants')->paginate(10);
        return response()->view('cms.Car.index',['cars'=>$cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $merchants=Merchant::where('gender',true )->get();
        return response()->view('cms.Car.create',['merchants'=>$merchants]);
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
        $request->validate([
            'car_name' =>'required|string|min:3|max:30',
            'price'=>'required|string|min:3|max:30',
            'type' => 'required|string|min:3|max:30',
            'model' => 'required|string|min:3|max:30',
            'sour_car' => 'required|string|min:3|max:30'
        ]);
        $cars = new Car();
        $cars->car_name     = $request->get('car_name');
        $cars->price    = $request->get('price');
        $cars->type     = $request->get('type');
        $cars->model    = $request->get('model');
        $cars->sour_car = $request->get('sour_car');
        $isSaved = $cars->save();

        if($isSaved){
            session()->flash('message','The name is created Successfully');
            return redirect()->route('car.create');
        }else{
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
        $cars=car::findOrfail($id);
        return response()->view('cms.car.edit', ['car' => $cars]);
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
        $request->validate([

            'car_name' => 'required|string|min:2|max:30',
            'price'=>'required|string|min:3|max:30',
            'type' => 'required|string|min:3|max:30',
            'model' => 'required|string|min:3|max:30',
            'sour_car' => 'required|string|min:3|max:30'
        ]);

            $cars = Car::findOrFail($id);
            $cars->car_name  = $request->get('car_name');
            $cars->price     = $request->get('price');
            $cars->type      = $request->get('type');
            $cars->model     = $request->get('model');
            $cars->sour_car  = $request->get('sour_car');
            $isUpdated = $cars->save();
            if($isUpdated){
                // return redirect()->bake();
                session()->flash('message','car updated successfully');
                return redirect()->route('car.edit',$cars->id);
            }else{
                session()->flash('message','falid updated car');
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

        $isDeleted = Car::destroy($id);
        if($isDeleted){
            // return redirect()->back();
            return response()->json(['title'=>'Deleted!','message'=>'The car is deleted!','icon'=>'success']);
        }else{
            return response()->json(['title'=>'Failed!','message'=>'The car is failed!','icon'=>'error'],400);
        }
    }
}
