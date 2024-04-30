<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\HoursSupp\newHourSupp;
use App\Http\Requests\HoursSupp\RequestHourSupp;
use App\Models\Hours_sup;
use App\Models\User;
use Illuminate\Http\Request;

class hoursSuppController extends Controller
{
    // Add hour supp for employee function
    public function addHoursSupp(newHourSupp $request){
        $user= User::find($request->employee);

        if($user){

            $hour_supp= new Hours_sup();
            $hour_supp->begin_time= $request->begin_time;
            $hour_supp->end_time= $request->end_time;
            $hour_supp->id= $user->id;
            $hour_supp->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'success',
                'hours_supp' => $hour_supp
            ]);
        }

    }
    // Add hour supp for employee function
    public function getHourSuppByEmployee(RequestHourSupp $request){
        
        $hour_supp= Hours_sup::where('id',$request->employee)->get();

        if($hour_supp){
            return response()->json([
                'status_code' => 200,
                'status_message' => 'success',
                'hours_supp' => $hour_supp
            ]);
        }

    }
}
