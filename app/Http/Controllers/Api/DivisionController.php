<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Enterprise;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    //create enterprise function
    public function createDivision(Request $request){
        $enterprise= Enterprise::find($request->enterprise);

        if($enterprise){

            $division= new Division();
            $division->name= $request->name;
            $division->enterprise= $enterprise->ident;
            $division->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'success',
                'user' => $division
            ]);
        }

    }

    // update enterprise function
    public function updateDivision(Request $request){
        
        $division= Division::find($request->division);
        if($division) {
            $division->update($request->all());
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
    public function getDivision(Request $request){
        
        $division= Enterprise::find($request->enterprise);
        if($division){
            
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Success',
                'enterprise' => $division
                
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
    public function deleteDivision(Request $request){
        
        $division= Division::find($request->division)->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Division deleted successfully'
            
        ]);
    }
}
