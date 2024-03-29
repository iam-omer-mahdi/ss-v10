<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'supervisor_name',
        'supervisor_phone',
        'car_plate',
        'fee',
    ];

    public function student_transportation ()
    {
        return $this->hasMany(StudentTransportation::class);
    }

}
