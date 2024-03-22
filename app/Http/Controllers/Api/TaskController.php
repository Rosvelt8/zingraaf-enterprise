<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //create Task function
    public function createTask(Request $request){
        
        $division= Division::find($request->division);

        if($division){

            $task= new Tasks();
            $task->entitle= $request->entitle;
            $task->description= $request->description;
            $task->division= $task->iddiv;
            $task->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'success',
                'task' => $task
            ]);
        }

    }

    // update task function
    public function updateTask(Request $request){
        
        $task= Tasks::find($request->division);
        if($task) {
            $task->update($request->all());
            return response()->json([
                'status_code' => 200,
                'status_message' => 'success',
                'task' => $task
            ]);
        }
        return response()->json([
            'status_code' => 403,
            'status_message' => 'Error! Tasks does not exist'
            
        ]);
    }

    // get one task function
    public function getTask(Request $request){
        
        $task= Tasks::find($request->task);
        if($task){
            
            return response()->json([
                'status_code' => 200,
                'status_message' => 'Success',
                'task' => $task
                
            ]);
        }
        return response()->json([
            'status_code' => 403,
            'status_message' => 'Error! task does not exist'
            
        ]);
    }

    // get All tasks

    public function getAllTasks(){
        
        $tasks= Tasks::GetAll();
            
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Success',
            'tasks' => $tasks
            
        ]);
    }
    // update Task function
    public function deleteTasks(Request $request){
        
        $task= Tasks::find($request->task)->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Task deleted successfully'
            
        ]);
    }
}
