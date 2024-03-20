<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hours_sup extends Model
{
    use HasFactory;

    protected $table = 'hours_sup';

    protected $primaryKey = 'idhour_sup';

    protected $fillable = ['hours_sup'];

}
