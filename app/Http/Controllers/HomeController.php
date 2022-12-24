<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\StudentPart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentTransportationPart;

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

    public function index()
    {
        $schools = School::count();
        $grades = Grade::count();
        $classrooms = Classroom::count();
        $students = Student::count();
         
        $total_fees = StudentPart::whereIn('student_id', (Student::select('id')->pluck('id')))->sum('amount');
        $paid_fees = StudentPart::whereIn('student_id', (Student::select('id')->pluck('id')))->where('paid', 1)->sum('amount');
        $unpaid_fees = StudentPart::whereIn('student_id', (Student::select('id')->pluck('id')))->where('paid', 0)->sum('amount');
        
        $transportation_fees = [
            'total' => StudentTransportationPart::sum('amount'),
            'paid' => StudentTransportationPart::where('paid', 1)->sum('amount'),
            'unpaid' => StudentTransportationPart::where('paid', 0)->sum('amount'),
        ];

        return view('home', compact(['schools','grades','classrooms','students','total_fees','paid_fees','unpaid_fees','transportation_fees']));
    }
}
