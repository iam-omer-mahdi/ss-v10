<?php

namespace App\Models;

use App\Models\Discount;
use App\Models\Classroom;
use App\Models\StudentFee;
use App\Models\Nationality;
use App\Models\StudentPart;
use App\Models\GuardianRelation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model 
{

    protected $table = 'students';
    public $timestamps = true;
    
    use \Znck\Eloquent\Traits\BelongsToThrough;
    use SoftDeletes, HasFactory;

    protected $dates = ['deleted_at'];
    protected $fillable = array('classroom_id', 'name', 'address', 'nationality_id', 'guardian', 'guardian_relation_id', 'guardian_workplace', 'guardian_f_phone', 'guardian_s_phone', 'mother_name', 'mother_f_phone', 'mother_s_phone','no_payment','discount_id');

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }


    public function discount()
    {
        return $this->hasOne(Discount::class,'id','discount_id')->withDefault();
    }

    public function nationality()
    {
        return $this->hasOne(Nationality::class,'id','nationality_id')->withDefault();
    }

    public function guardian_relation()
    {
        return $this->hasOne(GuardianRelation::class,'id','guardian_relation_id')->withDefault();
    }

    public function grade()
    {
        return $this->belongsToThrough(Grade::class, Classroom::class);
    }

    public function student_part()
    {
        return $this->hasMany(StudentPart::class);
    }

}