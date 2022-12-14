<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentPart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $schools = School::count();
        $grades = Grade::count();
        $classrooms = Classroom::count();
        $students = Student::count();
         
        $total_fees = StudentPart::whereIn('student_id', (Student::select('id')->pluck('id')))->sum('amount');
        $paid_fees = StudentPart::whereIn('student_id', (Student::select('id')->pluck('id')))->where('paid', 1)->sum('amount');
        $unpaid_fees = StudentPart::whereIn('student_id', (Student::select('id')->pluck('id')))->where('paid', 0)->sum('amount');

        return view('home', compact(['schools','grades','classrooms','students','total_fees','paid_fees','unpaid_fees']));
    }
}
