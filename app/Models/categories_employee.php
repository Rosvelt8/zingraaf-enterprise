<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories_employee extends Model
{
    use HasFactory;

    protected $table = 'categories_employee';

    protected $primaryKey = 'idcat';

    protected $fillable = ['categories_employee'];
}
