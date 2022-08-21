<?php

namespace App\Models;

use App\Models\Exam;
use App\Models\School;
use App\Models\Subject;
use App\Models\GradeFee;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model 
{

    protected $table = 'grades';
    public $timestamps = true;
    protected $fillable = array('name', 'school_id');

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function classroom()
    {
        return $this->hasMany(Classroom::class);
    }

    public function grade_fee()
    {
        return $this->hasMany(GradeFee::class);
    }

    public function exam()
    {
        return $this->hasMany(Exam::class);
    }

}