<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTransportation extends Model
{
    use HasFactory;

    protected $fillable = ['transportation_id', 'student_id', 'fee'];

    protected $table = 'student_transportation';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
