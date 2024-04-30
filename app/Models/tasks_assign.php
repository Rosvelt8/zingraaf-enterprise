<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks_assign extends Model
{
    use HasFactory;

    protected $table = 'tasks_assign';

    protected $primaryKey = 'idtask_ass';

    protected $fillable = ['tasks_assign'];


    public static function getAllTasksAssigned(Array $where=NULL){
        return self::select('tasks_assign.*','T.*', 'U.name as username')
                ->join('users AS U','U.id','=','tasks_assign.user')
                ->join('tasks AS T','T.idtask','=','tasks_assign.task')
                ->where($where)->get();
    }
}
