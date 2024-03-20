<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hours_tracked extends Model
{
    use HasFactory;

    protected $table = 'hours_tracked';

    protected $primaryKey = 'idhour';

    protected $fillable = ['hours_tracked']; 
}
