<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Hours_tracked;
use App\Http\Controllers\Controller;
use App\Http\Requests\HoursTracked\registHourTracked;

class TrackingController extends Controller
{
    //set employee work time
    public function employeeTracking(registHourTracked $request) {
        $date= date('Y-m-d');
        $user= Auth()->user();
        $hour_tracked= Hours_tracked::where(['user'=>$user->iduser, 'date'=>$date])->first();
        if($hour_tracked){

            $hour_tracked->minute+= $request->cookie;

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
