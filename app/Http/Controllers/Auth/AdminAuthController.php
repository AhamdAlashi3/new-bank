<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    //
    public function showLogin()
    {
        return response()->view('cms.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:merchants,email',
            'password' => 'required|string|min:3',
            'remember_me' => 'boolean',
        ]);

        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if (!$validator->fails()) {
            if (Auth::guard('admin')->attempt($credentials, $request->get('remember_me'))) {
                return response()->json(['message' => 'Logged in succesfully'], 200);
            } else {
                return response()->json(['message' => 'Login failed, please login credentials'], 400);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }
    public function editPassword(Request $request)
    {
        return response()->view('cms.auth.edit-password');
    }
    public function updatePassword(Request $request)
    {
        $validator=Validator($request->all(),[
            'old_password'=>'required|string|password:admin',
            'new_password'=>'required|string|confirmed',
            'new_password_confirmation'=>'required|string'
        ]);

        if(!$validator->fails()){
            $user=$request->user('admin');
            $user->password=Hash::make($request->get("new_password"));
            $isSaved = $user->save();
            return response()->json(['message'=>'Password changed successfully'], 200);
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()], 400);
        }

    }

    public function editProfile(Request $request)
    {
        return response()->view('cms.auth.edit-profile',['merchant' => $request->user('admin')]);
    }
    public function updateprofile(Request $request)
    {
            $merchant=$request->user('admin');
            $validator=Validator($request->all(),[
                'name' => 'required|string|min:2|max:30',
                'city'=>'required|string|min:3|max:30',
                'email' => 'required|string|min:3|max:30',
                'phone' => 'required|string|min:3|max:30',
                'gender' => 'required|string|in:M,F'
            ]);

            if(!$validator->fails()){
                $merchant=$request->user('admin');
                $merchant->name  = $request->get('name');
                $merchant->city  = $request->get('city');
                $merchant->email = $request->get('email');
                $merchant->phone = $request->get('phone');
                $merchant->gender  = $request->get('gender');
                $isSaved = $merchant->save();

                return response()->json(['message'=>'Profile changed successfully'], 200);
            }else{
                return response()->json(['message'=>$validator->getMessageBag()->first()], 400);
            }

    }

    public function logout(Request $request)
    {
        auth('admin')->logout();

        return redirect()->route('auth.login.view');
    }

}
