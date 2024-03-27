<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;
    
    protected $table = 'divisions';

    protected $primaryKey = 'iddiv';

    protected $fillable = ['divisions'];


    public static function getOne($id){
         return self::select('divisions.*', 'E.name As enterprise_name')
         ->join('enterprises AS E', 'divisions.enterpise', '=', 'E.ident')
         ->where('iddiv', $id)->get();
    }
    public static function getAll(){
        return self::select('divisions.*', 'E.name As enterprise_name')
        ->join('enterprises AS E', 'divisions.enterpise', '=', 'E.ident')
         ->get();
    }

}

