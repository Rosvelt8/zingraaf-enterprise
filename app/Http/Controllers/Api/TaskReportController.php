<?php

namespace App\Http\Controllers\Api;

use App\Models\Tasks;
use Illuminate\Support\Arr;
use App\Models\Tasks_assign;
use App\Models\Tasks_report;
use Illuminate\Http\Request;
use App\Models\Photos_report;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskReport\newTaskReport;
use App\Http\Requests\TaskReport\RequestTaskReport;

class TaskReportController extends Controller
{
    //create task report function
    public function createTaskReport(newTaskReport $request){
        $task= Tasks_assign::find($request->task_ass);

        if($task){

            $task_report= new Tasks_report();
            $task_report->name= $request->name;
            $task_report->task_ass= $task->idtask;
            $task_report->save();

           
            $task->status="R";
            $task->update(array($task));
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'success',
                'task_report' => $task_report
            ]);
        }

    }
    //create task report function
    public function createPhotoReport(newTaskReport $request){
        $report= Photos_report::find($request->report);

        if($report){

            $photo= $request->photo;
            // store image in storage and save name in database photos_report
            $fileName = uniqid() . '.' . $photo->getClientOriginalExtension(); // Generate unique filename
            $photo->storeAs('public/tasks', $fileName);
            $photo_report= new Photos_report();
            $photo_report->photo= $fileName;
            $photo_report->task_rep= $report->idtask_rep;
            $photo_report->save();
            
            
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'success',
                'photo' => $fileName
            ]);
        }

    }

    // update task report function
    public function updateTaskReport(RequestTaskReport $request){
        
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
            'status_message' => 'Error! Task Report does not exist'
            
        ]);
    }

    // get one task report function
    public function getTaskReport(RequestTaskReport $request){
        
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

    public function getAllTasksReports(RequestTaskReport $request){
        
        $user= Auth()->user();
        if($user->role=='EM'){
            $task_reports= Tasks_report::getAllForEmployee($request->task_ass);
            
        }else{
            $task_reports= Tasks_report::getAllForDivision($request->task_ass);

        }

        return response()->json([
            'status_code' => 200,
            'status_message' => 'Success',
            'divisions' => $task_reports
            
        ]);
    }
    // update task report function
    public function deleteTaskReport(RequestTaskReport $request){
        
        $task_report= Tasks_report::find($request->task_report)->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Task report deleted successfully'
            
        ]);
    }
}
