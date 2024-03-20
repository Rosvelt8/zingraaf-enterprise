<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enterprise;
use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    //create enterprise function
    public function createEnterprise(Request $request){
        $enterprise= new Enterprise();
        $enterprise->name= $request->name;
        $enterprise->contact= $request->contact;
        $enterprise->address= $request->address;
        $enterprise->open_hours= $request->open_hours;
        $enterprise->close_hours= $request->close_hours;
        $enterprise->save();

        return response()->json([
            'status_code' => 200,
            'status_message' => 'success',
            'user' => $enterprise
        ]);
    }

    // update enterprise function
    public function updateEnterprise(Request $request){
        
        $enterprise= Enterprise::find($request->enterprise);
        if($enterprise) {
            $enterprise->update($request->all());
            return response()->json([
                'status_code' => 200,
                'status_message' => 'success',
                'enterprise' => $enterprise
            ]);
        }
        return response()->json([
            'status_code' => 403,
            'status_message' => 'Error! Enterprise does not exist'
            
        ]);
    }

    // update enterprise function
    public function getEnterprise(Request $request){
        
        $enterprise= Enterprise::find($request->enterprise);
        if($enterprise){
            
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Success',
                'enterprise' => $enterprise
                
            ]);
        }
        return response()->json([
            'status_code' => 403,
            'status_message' => 'Error! Enterprise does not exist'
            
        ]);
    }

    public function getAllEnterprises(){
        
        $enterprises= Enterprise::all();
            
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Success',
            'enterprise' => $enterprises
            
        ]);
    }
    // update enterprise function
    public function deleteEnterprise(Request $request){
        
        $enterprise= Enterprise::find($request->enterprise)->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Enterprise deleted successfully'
            
        ]);
    }
}
