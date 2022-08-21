<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Grade;
use App\Models\School;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ReportController extends Controller
{

    // Permissions -------------------
    public function __construct()
    {
        $this->middleware(['role:super_admin|finance_manager|accountant'])->except(['getClasses','getGrades','getExams']);
    }

    public function index()
    {
        $schools = School::all();
        return view('dashboard/report/index', compact('schools'));
    }

    public function report(Request $request)
    {        
        if($request->report_type == 1) {
            return (new ReportController)->school_report();
        }
        if($request->report_type == 2) {
            return (new ReportController)->student_report();
        }
        if($request->report_type == 3) {
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

    // Student Payment Details
    public function student_payment_report($request)
    {
        // School Only
        $students = Student::with(['grade.school','discount','classroom','student_part'])
            ->whereHas('grade', function($q) use($request) { $q->where('school_id', '=', $request->school ); })->get();
            
        // School And Grade
        if ($request->has('grade') && !$request->has('classroom')) {
            $students = Student::with(['grade.school','discount','classroom','student_part'])
                ->whereHas('classroom', function($q) use($request) { $q->where('grade_id', '=', $request->grade); })
                ->get();
        }

        // Classroom
        if ($request->has('classroom')) {
            $students = Student::with(['grade.school','discount','classroom','student_part'])->where('classroom_id', '=', $request->classroom )->get();
        }

        return view('dashboard/report/student_payment_report')->with(['students' => $students]);
    }

    // Return Grades
    public function getGrades(Request $request)
    {
        $grades = Grade::where('school_id', $request->id)->get();

        return response()->json($grades);
    }

    // Return Classes
    public function getClasses(Request $request)
    {
        $classrooms = Classroom::where('grade_id', $request->id)->get();

        return response()->json($classrooms);
    }
    
    // Return Exams
    public function getExams(Request $request)
    {
        $exams = Exam::where('grade_id', $request->id)->get();

        return response()->json($exams);
    }

}
