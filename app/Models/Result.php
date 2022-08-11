<?php

namespace App\Models;

use App\Models\Exam;
use App\Models\Mark;
use Illuminate\Database\Eloquent\Model;

class Result extends Model 
{

    protected $table = 'results';
    public $timestamps = true;
    protected $fillable = array('student_id', 'exam_id');


    public function mark()
    {
        return $this->hasMany(Mark::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}