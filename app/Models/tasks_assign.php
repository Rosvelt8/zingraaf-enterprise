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
}
