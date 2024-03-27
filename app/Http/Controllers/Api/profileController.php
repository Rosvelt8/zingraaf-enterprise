<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RequestProfile;
use App\Http\Requests\Authentication\updateProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    //get user informations
    public function getProfile(){
        $user = auth()->user();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'success',
            'user' => $user
        ]);
    }

    // get update user profile
    public function updateProfile(updateProfile $request){
        $user = auth()->user();
        $user= User::find($user->id);
        $user->name= $request->name;
        $user->surname= $request->name;
        $user->password= Hash::make($request->password, [
            'round'=>12
        ]) ;
        $user->phone= $request->phone;
        $user->update(array($user));
        return response()->json([
            'status_code' => 200,
            'status_message' => 'success',
            'user' => $user
        ]);
    }

    // get all users profile
    public function showAllUsers() {
        // dd("ok");
        $users= User::getUsers();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'success',
            'users' => $users
        ]);
    }
    // get one user profile
    public function showUser(RequestProfile $request) {
       
        $user= User::getOneUser($request->user);
        return response()->json([
            'status_code' => 200,
            'status_message' => 'success',
            'user' => $user
        ]);
    }
    
    




}
