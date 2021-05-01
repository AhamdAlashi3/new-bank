<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions=Permission::paginate(10);
        return response()->view('cms.spatie.permissions.index',['permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.spatie.permissions.create');
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
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:admin,user',
            'name' => 'required|string|min:3'
        ]);

        if (!$validator->fails()) {
            $role = new Permission();
            $role->name = $request->get('name');
            $role->guard_name= $request->get('guard');
            $isSaved = $role->save();
            return response()->json(['message' => $isSaved ? 'Permission created succssefully' : "Failed to create permission"], $isSaved ? 200 : 400);
        } else {
            return response()->json(['message' => 'Please check required data'], 400);
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
        $permission=Permission::findById($id,'admin');
        return response()->view('cms.spatie.permissions.edit',['permission'=>$permission]);
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
        $validator = Validator($request->all(), [
            'guard' => 'required|string|in:admin',
            'name' => 'required|string|min:3'
        ]);

        if (!$validator->fails()) {
            $permissions = Permission::findOrFail($id);
            $permissions->name = $request->get('name');
            $permissions->guard_name = $request->get('guard');
            $isSaved = $permissions->save();
            return response()->json(['message' => $isSaved ? 'Permission updated succssefully' : "Failed to update permission"], $isSaved ? 200 : 400);
        } else {
            return response()->json(['message' => 'Please check required data'], 400);
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
        $isDeleted=Permission::destroy($id);
        if($isDeleted){
            return response()->json(['title'=>'Deleted!','message'=>'The Permission is deleted!','icon'=>'success'],200);
        }else{
            return response()->json(['title'=>'Failed!','message'=>'The Role is failed!','icon'=>'error'],400);
        }
    }
}