<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class MerchantPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($merchantId)
    {
        //
        $permissions = Permission::where('guard_name', 'admin')->get();
        $merchant = Merchant::find($merchantId);

        if ($merchant->permissions->count() > 0) {
            foreach ($permissions as $permission) {
                $permission->setAttribute('is_active', false);
                if ($merchant->hasPermissionTo($permission)) {
                    $permission->setAttribute('is_active', true);
                }
            }
        }
        return response()->view('cms.merchant.index-permission', ['merchantId' => $merchantId, 'permissions' => $permissions]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $merchantId)
    {
        //
        $validator = Validator($request->all(), [
            'permission_id' => 'required|exists:permissions,id|numeric',
            'active' => 'boolean',
        ]);

        if (!$validator->fails()) {
            $permission = Permission::findById($request->get('permission_id'));
            $merchant = Merchant::findOrFail($merchantId);
            if ($merchant->hasPermissionTo($permission))
                $isSaved = $merchant->revokePermissionTo($permission);
            else
                $isSaved = $merchant->givePermissionTo($permission);
            return response()->json(['message' => $isSaved ? 'Permission assigned successfully' : "Failed to assign permission"], $isSaved ? 200 : 400);
        } else {
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
    }
}