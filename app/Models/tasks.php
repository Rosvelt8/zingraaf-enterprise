<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $primaryKey = 'idtask';

    protected $fillable = ['tasks'];

    public static function getAll(){
        $currentUser= Auth()->user();

        if($currentUser->division===NULL && $currentUser->enterprise===NULL){
            $tasks=self::select('tasks.*','D.*')
            ->leftjoin('divisions AS D', 'tasks.division', '=', 'D.iddiv')
            ->get();
        }
        // request to get all tasks in same enterprise of user connected
        if($currentUser->division!==NULL){
            $tasks=self::select('users.*','D.*', 'E.*')
                    ->join('divisions AS D', 'tasks.division', '=', 'D.iddiv')
                    ->where('D.iddiv',$currentUser->division)->get();
            
        }
        if($currentUser->enterprise!==NULL){

            $tasks=self::select('users.*','D.*', 'E.*')
            ->join('divisions AS D', 'tasks.division', '=', 'D.iddiv')
            ->where('D.enterprise',"=",$currentUser->enterprise)->get();
        }

        return $tasks;
    }
}
