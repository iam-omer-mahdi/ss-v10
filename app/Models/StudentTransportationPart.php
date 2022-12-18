<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTransportationPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'payment_type',
        'check_owner',
        'check_number',
        'attachment',
        'paid',
        'student_transportation_id',
    ];

    public function student_transportation()
    {
        return $this->belongsTo(StudentTransportation::class);
    }
}
