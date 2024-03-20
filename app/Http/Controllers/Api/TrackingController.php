<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hours_tracked;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    //set employee work time
    public function employeeTracking(Request $request) {
        $date= date('Y-m-d');
        $user= Auth()->user();
        $hour_tracked= Hours_tracked::where(['user'=>$user->iduser, 'date'=>$date])->first();
        if($hour_tracked){

            $hour_tracked->hour+= 1;

        }else{

            $hour_tracked= new Hours_tracked();
            $hour_tracked->date= $date;
            $hour_tracked->user= $user->iduser;
            $hour_tracked->hour= 1;
            $hour_tracked->save();
        }

        return response()->json([
            'status_code' => 200,
            'status_message' => 'success',
            
        ]);
    }
}
