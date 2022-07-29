<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model 
{

    protected $table = 'results';
    public $timestamps = true;
    protected $fillable = array('student_id', 'exam_id');

}