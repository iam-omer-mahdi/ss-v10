<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class SubjectSuccessRate extends Controller
{
    public function index(Request $request, Exam $exam)
    {
        $results = \App\Models\Result::where('exam_id', $exam->id)->get();
        $subjects = \App\Models\Subject::where('exam_id', $exam->id)->get();

        $rates = [];
        $total_marks = [];

        function calculate_success_rate($results, $subject) {
            $marks = [];

            foreach ($results as $result) {
                array_push($marks, collect($result->mark)->where('subject_id', $subject->id));
            }

            $subject_total_marks = collect($marks)->flatten()->sum('mark');

            $success_rate = round($subject_total_marks / (collect($marks)->flatten()->count() * $subject->full_mark) * 100, 1);
            
            return [$subject_total_marks, $success_rate];
        }

        foreach ($subjects as  $subject) {
            array_push($rates, ['name' => $subject->name, 'rate' => calculate_success_rate($results,$subject)[1], 'total_degrees' => calculate_success_rate($results,$subject)[0]]);
        }
        
        return view('dashboard/result/subject_success_rate', compact('rates','exam','subjects'));
    }
}
