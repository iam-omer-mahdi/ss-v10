<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model 
{

    protected $table = 'subjects';
    public $timestamps = true;
    protected $fillable = array('name', 'full_mark', 'success_mark', 'exam_id');


    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}