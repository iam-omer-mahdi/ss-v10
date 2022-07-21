<?php

namespace App\Models;

use App\Models\School;
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

}