<?php

namespace App\Models;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model 
{

    protected $table = 'classrooms';
    public $timestamps = true;
    protected $fillable = array('name', 'grade_id');

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function student()
    {
        return $this->hasMany(Student::class, 'classroom_id');
    }

}