<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model 
{

    protected $table = 'discounts';
    public $timestamps = true;
    protected $fillable = array('name', 'amount');

}