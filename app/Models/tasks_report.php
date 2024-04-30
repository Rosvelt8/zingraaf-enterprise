<?php

namespace App\Models;
use App\Models\Photos_report;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhotosReport;

class Tasks_report extends Model
{
    use HasFactory;
   
    protected $table = 'tasks_report';

    protected $primaryKey = 'idtask_rep';

    protected $fillable = ['tasks_report'];


    public static function getAllForDivision(int $task){
            $reports= self::select('tasks_report.*','U.*', 'E.*')
                    ->join('tasks_assign AS TA', 'tasks_report.task_assign', '=', 'TA.idtask_ass')
                    ->join('users AS U', 'tasks_report.user', '=', 'U.id')
                    ->join('tasks AS T', 'TA.task', '=', 'T.idtask')
                    ->where('T.idtask',$task)->get();

            foreach($reports as $report){
                $report->photos= Photos_report::where('task_report',$report->idtask_rep)->get();
            }
            return $reports;
            

    }
    public static function getAllForEmployee(int $tasks_assign){
            $reports= self::select('tasks_report.*','U.*', 'E.*')
                    ->join('tasks_assign AS TA', 'tasks_report.task_assign', '=', 'TA.idtask_ass')
                    ->join('users AS U', 'tasks_report.user', '=', 'U.id')
                    ->join('tasks AS T', 'TA.task', '=', 'T.idtask')
                    ->where('TA.tasks_assign',$tasks_assign)->get();

            foreach($reports as $report){
                $report->photos= Photos_report::where('task_report',$report->idtask_rep)->get();
            }
            return $reports;
            

    }
}
