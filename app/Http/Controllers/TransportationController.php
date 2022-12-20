<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Transportation;
use Illuminate\Validation\Rule;
use App\Models\StudentTransportation;
use App\Models\StudentTransportationPart;

class TransportationController extends Controller
{

    public function index()
    {
        $transportations = Transportation::all();
        return view('dashboard.transportation.index', compact('transportations'));
    }

    public function create()
    {
        return view('dashboard.transportation.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string:255|unique:transportations',
            'supervisor_name' => 'required|string:255',
            'supervisor_phone' => 'required|string:255',
            'car_plate' => 'required|string:255|unique:transportations',
            'fee' => 'required|numeric',
        ]);

        Transportation::create([
            'name' => $request->name,
            'supervisor_name' => $request->supervisor_name,
            'supervisor_phone' => $request->supervisor_phone,
            'car_plate' => $request->car_plate,
            'fee' => $request->fee,
        ]);

        return redirect()->route('transportation.index')->with('success', 'تمت الاضافة بنجاح');
    }

    public function show(Transportation $transportation)
    {
        $studentTransportation = StudentTransportation::with('student')->where('transportation_id', $transportation->id)->get();
        return view('dashboard.transportation.show', compact('transportation', 'studentTransportation'));
    }

    public function edit(Transportation $transportation)
    {
        return view('dashboard.transportation.edit', compact('transportation'));
    }

    public function update(Request $request, Transportation $transportation)
    {
        $this->validate($request, [
            'name' => ['required', 'string:255', Rule::unique('transportations')->ignore($transportation->id)],
            'supervisor_name' => 'required|string:255',
            'supervisor_phone' => 'required|string:255',
            'car_plate' => ['required', 'string:255', Rule::unique('transportations')->ignore($transportation->id)],
            'fee' => 'required|numeric',
        ]);

        $transportation->update([
            'name' => $request->name,
            'supervisor_name' => $request->supervisor_name,
            'supervisor_phone' => $request->supervisor_phone,
            'car_plate' => $request->car_plate,
            'fee' => $request->fee,
        ]);

        return redirect()->route('transportation.index')->with('success', 'تم التعديل بنجاح');
    }

    public function destroy(Transportation $transportation)
    {
        $transportation->delete();
        return redirect()->route('transportation.index')->with('success', 'تم الحذف بنجاح');
    }

    public function add_students(Request $request, $id)
    {
        $transportation_id = $id;
        $transportations = StudentTransportation::pluck('student_id');
        $students = Student::with('classroom.grade.school')->select('id', 'name', 'classroom_id')->whereNotIn('id',$transportations)->get();
        return view('dashboard.transportation.add_students', compact('students', 'transportation_id'));
    }

    public function store_students(Request $request)
    {
        $transportation = Transportation::findOrFail($request->transportation_id);

        foreach ($request->students as $student) {
            $student_transportation = StudentTransportation::create([
                'student_id' => $student,
                'transportation_id' => $transportation->id
            ]);
            
            StudentTransportationPart::create([
                'student_transportation_id' => $student_transportation->id,
                'amount' => $transportation->fee
            ]);
        }

        return redirect()->route('transportation.index')->with('success', 'تم الحفظ بنجاح');
    }

    public function destroy_students($id)
    {
        $student = StudentTransportation::findOrFail($id);

        $student->delete();

        return redirect()->route('transportation.index')->with('success', 'تم الحذف بنجاح');

    }
}
