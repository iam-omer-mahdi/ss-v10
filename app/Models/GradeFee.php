<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\StudentFee;
use Illuminate\Database\Eloquent\Model;

class GradeFee extends Model 
{

    protected $table = 'grade_fees';
    public $timestamps = true;
    protected $fillable = array('grade_id', 'fee_id', 'amount');

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

}