<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\loginUser;
use App\Http\Requests\Authentication\registerUser;
use App\Http\Requests\Authentication\updatePassword;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //User registration function
    public function register(registerUser $request){

        try{
            // dd($request->all());
            $utilisateur = User::latest()->first();
            $user= new User();
            $last = User::latest()->first();
            $user->identifiant= $this->generateUserId($request->enterprise, $last->id+1);
            if($request->role=="AD"){
                $user->identifiant= $this->generateUserId(0, $last->id+1);
            }
            
            if($request->role=="GM" || $request->role=="DM" || $request->role=="EM"){
                $user->enterprise= $request->enterprise;
            }
            if($request->role=="DM" || $request->role=="EM"){
                $user->division= $request->division;
            }
            
            $user->name= $request->name;
            $user->surname= $request->surname;
            $user->email= $request->email;
            $user->password= Hash::make($request->password, [
                'round'=>12
                ]) ;
                
                $user->role= $request->role;
                $user->employee_date= Date('Y-m-d');
                $user->phone= $request->phone;
            
    
            $user->save();

            return response()->json([
                'status_code'=> 200,
                'status_message' => 'User created successfully',
                'user'=> $user,
                'token'=> $user->createToken('USER AUTHENTICATION KEY')->plainTextToken
            ]);

        }catch(Exception $e){
            return response()->json($e);
        }
        
    }

    

    public function generateUserId($entrepriseId, $utilisateurId) {
      $utilisateurIdStr = (string) $utilisateurId;
    
      $format = "ZENT%04d%04d";
    
      $identifiant = sprintf($format, $entrepriseId, str_pad($utilisateurIdStr, 4, "0", STR_PAD_LEFT));
    
      return $identifiant;
    }

    // Login user function
    public function login(loginUser $request){
        if(Auth()->attempt($request->only(['identifiant','password']))){
            $user= Auth()->user();
            $token= $user->createToken('USER AUTHENTICATION KEY')->plainTextToken;
            
            return response()->json([
                'status_code'=> 200,
                'status_message' => 'User logged in',
                'user'=> $user,
                'token'=> $token
            ]);
        }else{
            return response()->json([
                'status_code'=> 403,
                'status_message' => 'these credentials does not match'
            ]);
        }
    }

    // Log out user function
    public function logout(){
        Auth()->user()->currentAccessToken()->delete();
        return response()->json([
            'status_code'=> 200,
            'status_message' => 'User logged out successfully'
        ]);
    }

    // user update password function
    public function updatePassword(updatePassword $request)
    {
        $user = Auth()->user();
        $user= User::find($user->id);
        $user->password = Hash::make($request->password, [
            'round'=>12
        ]);
        $user->update(array($user));
        return response()->json([
            'status_code'=> 200,
            'status_message' => 'Password updated successfully'
        ]);
    }

}
