<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\newTask;
use App\Http\Requests\Task\RequestTask;
use App\Http\Requests\TaskAssign\newTaskAssign;
use App\Http\Requests\TaskAssign\RequestTaskAssign;
use App\Models\Division;
use App\Models\Tasks;
use App\Models\Tasks_assign;
use App\Models\User;
use Illuminate\Http\Request;
use TasksAssign;

class TaskController extends Controller
{
    //create Task function
    public function createTask(newTask $request){
        
        $division= Division::find($request->division);

        if($division){

            $task= new Tasks();
            $task->entitle= $request->entitle;
            $task->description= $request->description;
            $task->division= $division->iddiv;
            $task->save();
    
            return response()->json([
                'status_code' => 200,
                'status_message' => 'created successfully',
                'task' => $task
            ]);
        }

    }

    // update task function
    public function updateTask(RequestTask $request){
        
        $task= Tasks::find($request->task);
        if($task) {
            $task->entitle= $request->entitle;
            $task->description= $request->description;
            $task->update(array($task));
            return response()->json([
                'status_code' => 200,
                'status_message' => 'update successfull',
                'task' => $task
            ]);
        }
        return response()->json([
            'status_code' => 403,
            'status_message' => 'Error! Tasks does not exist'
            
        ]);
    }

    // get one task function
    public function getTask(RequestTask $request){
        
        $task= Tasks::getOne($request->task);
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

    public function getAllTasksAssigned(RequestTask $request){
        
        $tasks= Tasks_assign::getAllTasksAssigned(['tasks_assign.task'=>$request->task]);
            
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Success',
            'tasks_assigned' => $tasks
            
        ]);
    }
    public function getAllTasksAssignedByTask(RequestTask $request){
        
        $tasks= Tasks_assign::getAllTasksAssigned(['tasks_assign.user'=> $request->employee]);
            
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Success',
            'tasks_assigned' => $tasks
             
        ]);
    }

    public function assignTask(newTaskAssign $request){
        $task= Tasks::find($request->task);
        $employees=$request->employees;
        foreach ($employees as $employee){
            $user= User::find($employee);
            if($user){
                $assignTask= new Tasks_assign();
                $assignTask->user=$user->id;
                $assignTask->task=$task->idtask;
                $assignTask->save();
            }
        }
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Assignment done successfully',
            
        ]);
    }
    // update Task function
     public function updateAssignStatus(RequestTaskAssign $request){
        $taskAssign= Tasks_assign::find(intval($request->taskAssign));
        $taskAssign->status =$request->status;
        $taskAssign->update(array($taskAssign));
        return response()->json([
            "message" => "success",
            "status_code"=>201 ,
            "data"=>[
                   "id"=>$taskAssign->id,
                   "status"=>$taskAssign->status
               ],
           ]);
     }


    public function deleteTask(RequestTask $request){
        
        $task= Tasks::find($request->task)->delete();
        return response()->json([
            'status_code' => 200,
            'status_message' => 'Task deleted successfully'
            
        ]);
    }
}
