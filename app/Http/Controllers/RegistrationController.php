<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Discount;
use App\Models\Registration;
use App\Models\Year;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrations = Registration::all();
        return view('dashboard.reg.index', compact('registrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $years = Year::all();
        $students = Student::all();
        $schools = School::all();
        $grades = Grade::query()->when($request->has('school'), fn($q) => $q->where('school_id',$request->school))->get();
        $discounts = Discount::query()->when($request->has('year'), fn($q) => $q->where('year_id',$request->year))->get();
        $classrooms = Classroom::query()->when($request->has('grade'), fn($q) => $q->where('grade_id',$request->grade))->get();
        return view('dashboard.reg.create', compact(['schools','students','grades','discounts','classrooms','years']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registration $registration)
    {
        //
    }
}
