<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos_report extends Model
{
    use HasFactory;

    protected $table = 'photos_report';

    protected $primaryKey = 'idphoto';

    protected $fillable = ['photos_report'];
}
