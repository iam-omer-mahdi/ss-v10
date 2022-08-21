<?php

namespace App\Http\Traits;

use App\Models\Grade;

trait GradeTrait {
    public function index($id) { 
        $grades = Grade::where('school_id', $id)->get();

        return response()->json($grades);
    }
}