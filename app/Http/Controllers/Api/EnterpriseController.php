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
    }
}
