<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentPart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'part_number',
        'type',
        'amount',
        'payment_time',
        'paid',
        'payment_type',
        'payment_image',
        'check_number',
        'check_owner',
        'student_id',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
