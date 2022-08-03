<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $schools = School::all();
        return view('dashboard/report/index', compact('schools'));
    }

    public function report(Request $request)
    {        
        if($request->report_type == 1) {
            return (new ReportController)->school_report();
        } else if($request->report_type == 2) {
            return (new ReportController)->student_report();
        } else if($request->report_type == 3) {
            return (new ReportController)->student_payment_report($request);
        }
    }

    public function school_report()
    {
        $schools = School::withCount(['students'])->get();

        return view('dashboard/report/school_report')->with(['schools' => $schools]);
    }

    public function student_report()
    {
        $classrooms = Classroom::with(['grade.school'])->withCount(['student'])->get();

        return view('dashboard/report/student_report')->with(['classrooms' => $classrooms]);
    }

    public function student_payment_report($request)
    {

        $students = Student::with(['grade.school','discount','classroom','student_part'])->select('id','name','classroom_id','discount_id')->where(['classroom_id' => $request->classroom])->orderBy('name')->get();

        return view('dashboard/report/student_payment_report')->with(['students' => $students]);
    }

    public function getGrades(Request $request)
    {
        $grades = Grade::where('school_id', $request->id)->get();

        return response()->json($grades);
    }

    public function getClasses(Request $request)
    {
        $classrooms = Classroom::where('grade_id', $request->id)->get();

        return response()->json($classrooms);
    }

}
