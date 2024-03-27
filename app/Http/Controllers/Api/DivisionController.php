<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Division\newDivision;
use App\Http\Requests\Division\RequestDivision;
use App\Models\Division;
use App\Models\Enterprise;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    //create enterprise function
    public function createDivision(newDivision $request){
        $enterprise= Enterprise::find($request->enterprise);

        if($enterprise){

            $division= new Division();
            $division->name= $request->name;
            $division->enterpise= $enterprise->ident;
            $division->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'success',
                'user' => $division
            ]);
        }
        return response()->json([
            'status_code' => 403,
            'status_message' => 'Error! Please redo action'
            
        ]);

    }

    // update enterprise function
    public function updateDivision(RequestDivision $request){
        
        $division= Division::find($request->division);
        if($division) {
            $division->name= $request->name;
            $division->enterpise= $request->enterprise;
            $division->update(array($division));
            return response()->json([
                'status_code' => 200,
                'status_message' => 'success',
                'division' => $division
            ]);
        }
        return response()->json([
            'status_code' => 403,
            'status_message' => 'Error! Division does not exist'
            
        ]);
    }

    // get one division function
    public function getDivision(RequestDivision $request){
        
        $division= Division::getOne($request->division);
        if($division){
            
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Success',
                'division' => $division
                
            ]);
        }
        return response()->json([
            'status_code' => 403,
            'status_message' => 'Error! division does not exist'
            
        ]);
    }

    // get All Divisions

    public function getAllDivisions(){
        
        $divisions= Division::GetAll();
            
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Success',
            'divisions' => $divisions
            
        ]);
    }
    // update division function
    public function deleteDivision(RequestDivision $request){
        
        $division= Division::find($request->division)->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Division deleted successfully'
            
        ]);
    }
}
