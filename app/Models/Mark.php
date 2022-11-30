<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model 
{

    protected $table = 'marks';
    public $timestamps = true;
    protected $fillable = array('result_id', 'subject_id', 'mark');

    public function result()
    {
        return $this->belongsTo(Result::class);
    }

}