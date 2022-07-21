<?php

namespace App\Models;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model 
{

    protected $table = 'students';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('classroom_id', 'name', 'address', 'nationality', 'guardian', 'guardian_relation', 'guardian_workplace', 'guardian_f_phone', 'guardian_s_phone', 'mother_name', 'mother_f_phone', 'mother_s_phone');

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

}