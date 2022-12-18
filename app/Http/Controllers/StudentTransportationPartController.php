<?php

namespace App\Http\Controllers;

use App\Models\StudentTransportationPart;
use App\Models\StudentTransportation;
use Illuminate\Http\Request;

class StudentTransportationPartController extends Controller
{
    
    public function index($id)
    {
        $student_transportation = StudentTransportation::findOrFail($id);
        $parts = StudentTransportationPart::where('student_transportation_id', $student_transportation->id)->get();
        return view('dashboard/transportation_part/index', compact('parts'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'amount' => 'required|numeric',
            'payment_type' => 'required',
            'check_owner' => 'nullable|string:255',
            'check_number' => 'nullable|numeric',
            'attachment' => 'nullable|string:255',
            'paid' => 'nullable',
            'student_transportation_id' => 'required',
        ]);

        StudentTransportationPart::create([
            'amount' => $request->amount,
            'payment_type' => $request->payment_type,
            'check_owner' => $request->check_owner,
            'check_number' => $request->check_number,
            'attachment' => $request->attachment,
            'paid' => $request->paid,
            'student_transportation_id' => $request->student_transportation_id,
        ]);

        return redirect()->route('transportation.index')->with('success', 'تمت الاضافة بنجاح');
    }

    public function show(StudentTransportationPart $studentTransportationPart)
    {
        //
    }

    public function edit(StudentTransportationPart $studentTransportationPart)
    {
        //
    }

    public function update(Request $request, StudentTransportationPart $studentTransportationPart)
    {
        //
    }

    public function destroy(StudentTransportationPart $studentTransportationPart)
    {
        //
    }
}
