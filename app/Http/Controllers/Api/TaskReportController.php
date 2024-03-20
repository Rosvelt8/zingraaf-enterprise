<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use App\Models\Tasks_report;
use Illuminate\Http\Request;

class TaskReportController extends Controller
{
    //create task report function
    public function createTaskReport(Request $request){
        $task= Tasks::find($request->task);

        if($task){

            $task_report= new Tasks_report();
            $task_report->name= $request->name;
            $task_report->task= $task->idtask;
            $task_report->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'success',
                'task_report' => $task_report
            ]);
        }

    }

    // update task report function
    public function updateTaskReport(Request $request){
        
        $task_report= Tasks_report::find($request->task_report);
        if($task_report) {
            $task_report->update($request->all());
            return response()->json([
                'status_code' => 200,
                'status_message' => 'success',
                'task_report' => $task_report
            ]);
        }
        return response()->json([
            'status_code' => 403,
            'status_message' => 'Error! Task does not exist'
            
        ]);
    }

    // get one task report function
    public function getTaskReport(Request $request){
        
        $task_report= Tasks_report::find($request->task_report);
        if($task_report){
            
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Success',
                'task_report' => $task_report
                
            ]);
        }
        return response()->json([
            'status_code' => 403,
            'status_message' => 'Error! division does not exist'
            
        ]);
    }

    // get All task report

    public function getAllTasksReports(Request $request){
        
        $task_reports= Tasks_report::GetAll($request->task);
            
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Success',
            'divisions' => $task_reports
            
        ]);
    }
    // update task report function
    public function deleteTaskReport(Request $request){
        
        $task_report= Tasks_report::find($request->task_report)->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Task report deleted successfully'
            
        ]);
    }
}
