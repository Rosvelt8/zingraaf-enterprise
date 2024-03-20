<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks_report extends Model
{
    use HasFactory;
   
    protected $table = 'tasks_report';

    protected $primaryKey = 'idtask_rep';

    protected $fillable = ['tasks_report']
}
