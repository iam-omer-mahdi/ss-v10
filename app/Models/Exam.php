<?php

namespace App\Models;

use App\Models\Result;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model 
{

    protected $table = 'exams';
    public $timestamps = true;
    protected $fillable = array('name', 'date', 'grade_id');


    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function result()
    {
        return $this->hasMany(Result::class);
    }
}