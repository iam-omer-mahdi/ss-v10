<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Grade;
use App\Models\School;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{

    // Permissions -------------------
    public function __construct()
    {
        $this->middleware(['role:super_admin|finance_manager|accountant'])->except(['getClasses', 'getGrades', 'getExams']);
    }

    public function index()
    {
        $schools = School::all();
        return view('dashboard/report/index', compact('schools'));
    }

    public function report(Request $request)
    {
        if ($request->report_type == 1) {
            return (new ReportController)->school_report();
        }
        if ($request->report_type == 2) {
            return (new ReportController)->student_report();
        }
        if ($request->report_type == 3) {
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
        // Global Variables
        $student_ids = [];
        $fees = $school = $grade = $classroom = null;

        // School Only
        if ($request->has('school') && !$request->has('classroom') && !$request->has('grade')) {
            // Get Students 
            $students = Student::select('name','id','classroom_id','discount_id')->with(['grade.school', 'discount', 'classroom', 'student_part'])
                ->whereHas('grade', function ($q) use ($request) {
                    $q->where('school_id', '=', $request->school);
                })->orderBy('name')->get();
            // Get Student ID's
            foreach ($students as $student) {
                $student_ids[] = $student->id;
            }
            // Calculate Fess
            $fees = $this->calc_total($student_ids);
            // Return school - grade - classroom
            $school = School::find($request->school);
            $grade = '';
            $classroom = '';
        }

        // School And Grade
        if ($request->has('grade') && !$request->has('classroom')) {

            $students = Student::with(['grade.school', 'discount', 'classroom', 'student_part'])
                ->whereHas('classroom', function ($q) use ($request) {
                    $q->where('grade_id', '=', $request->grade);
                })->orderBy('name')->get();

            foreach ($students as $student) {
                $student_ids[] = $student->id;
            }

            $fees = $this->calc_total($student_ids);
            $grade = Grade::find($request->grade);
            $school = School::find($grade->school_id);
        }

        // Classroom
        if ($request->has('classroom')) {

            $students = Student::with(['grade.school', 'discount', 'classroom', 'student_part'])->where('classroom_id', '=', $request->classroom)->orderBy('name')->get();

            $classroom = Classroom::find($request->classroom);
            $grade = Grade::find($classroom->grade_id);
            $school = School::find($grade->school_id);


            foreach ($students as $student) {
                $student_ids[] = $student->id;
            }

            $fees = $this->calc_total($student_ids);
        }

        return view('dashboard/report/student_payment_report', compact(['students', 'fees', 'school', 'grade', 'classroom']));
    }


    private function calc_total($ids)
    {
        $total_fees = DB::table('student_parts')->whereIn('student_id', $ids)->sum('amount');
        $paid_fees = DB::table('student_parts')->whereIn('student_id', $ids)->where('paid', 1)->sum('amount');
        $not_paid_fees = DB::table('student_parts')->whereIn('student_id', $ids)->where('paid', 0)->sum('amount');
        $fees = [$total_fees, $paid_fees, $not_paid_fees];
        return $fees;
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
