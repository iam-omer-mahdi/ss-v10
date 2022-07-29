<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;

class School extends Model 
{

    protected $table = 'schools';
    public $timestamps = true;
    protected $fillable = array('name');

    public function grades()
    {
       return $this->hasMany(Grade::class);
    }

    public function classrooms()
    {
        return $this->hasManyThrough(Classroom::class,Grade::class);
    }

}