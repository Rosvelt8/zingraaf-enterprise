<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\updateProfile;
use App\Models\User;
use Illuminate\Http\Request;

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
        $user->update($request->all());
        return response()->json([
            'status_code' => 200,
            'status_message' => 'success',
            'user' => $user
        ]);
    }

    // get all users profile
    public function showAllUsers() {
    
        $users= User::getUsers();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'success',
            'userS' => $users
        ]);
    }
    // get all users profile
    public function showUser(Request  $request) {
       
        $user= User::getOneUser($request->user);
        return response()->json([
            'status_code' => 200,
            'status_message' => 'success',
            'user' => $user
        ]);
    }
    
    




}
