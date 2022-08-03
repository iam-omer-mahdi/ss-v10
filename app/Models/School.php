<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

class School extends Model 
{
    use HasRelationships;

    protected $table = 'schools';
    public $timestamps = true;
    protected $fillable = array('name');

    public function grades()
    {
       return $this->hasMany(Grade::class);
    }

    public function classrooms()
    {
        return $this->hasManyThrough(Classroom::class,Grade::class,'school_id','grade_id','id','id');
    }


    public function students()
    {
        return $this->hasManyDeep(
            Student::class,
            [Grade::class, Classroom::class], // Intermediate models, beginning at the far parent (Country).
            [
               'school_id', // Foreign key on the "grade" table.
               'grade_id',     // Foreign key on the "classroom" table.
               'classroom_id', // Foreign key on the "students" table.
            ],
            [
               'id', // Local key on the "grade" table.
               'id', // Local key on the "classroom" table.
               'id'  // Local key on the "students" table.
            ]
        );
    }

}