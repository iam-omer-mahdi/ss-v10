<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model 
{

    protected $table = 'exams';
    public $timestamps = true;
    protected $fillable = array('name', 'grade_id');

}