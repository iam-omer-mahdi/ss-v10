<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\StudentTransportation;
use App\Models\StudentTransportationPart;

class StudentTransportationPartController extends Controller
{
    
    public function index(Request $request)
    {
        $student_transportation = StudentTransportation::with('student')->where('student_id', $request->id)->first();

        if (!isset($student_transportation->id)) {
            return redirect()->route('transportation.index')->with('error','الطالب غير موجود في الترحيل');
        }

        $parts = StudentTransportationPart::where('student_transportation_id', $student_transportation->id)->get();
        $total_paid_amount = StudentTransportationPart::where('student_transportation_id', $student_transportation->id)->where('paid',1)->sum('amount');
        $total_remaining_amount = StudentTransportationPart::where('student_transportation_id', $student_transportation->id)->where('paid',0)->sum('amount');

        return view('dashboard/transportation_fee/index', compact('parts','student_transportation','total_remaining_amount','total_paid_amount'));
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

    public function store_part(Request $request)
    {
        $this->validate($request,[
            'student_transportation_id' => 'required',
        ]);

        StudentTransportationPart::create([
            'amount' => 0,
            'paid' => 0,
            'student_transportation_id' => $request->student_transportation_id,
        ]);

        return redirect()->back()->with('success', 'تمت الاضافة بنجاح');
    }

    public function show(StudentTransportationPart $studentTransportationPart)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $parts = StudentTransportationPart::with('student_transportation')->where('student_transportation_id', $id)->get();
        $student_transportation = StudentTransportation::where('id', $id)->first();
        
        return view('dashboard.transportation_fee.parts', compact('parts','student_transportation'));
    }

    public function update(Request $request, $id)
    {
        $studentTransportationPart = StudentTransportationPart::with('student_transportation')->findOrFail($id);

        $this->validate($request, [
            'payment_type' => 'required',
            'check_owner' => Rule::requiredIf($request->payment_type == 3),
            'check_number' => Rule::requiredIf($request->payment_type == 3),
            'attachment' => Rule::requiredIf($request->payment_type == 2),
        ]);

        $filename = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('images/transportation_payment'), $filename);
        }

        $studentTransportationPart->update([
            'paid' => 1,
            'payment_type' => $request->payment_type,
            'check_owner' => $request->check_owner,
            'check_number' => $request->check_number,
            'attachment'   => $filename,
        ]);

        return redirect()->route('transportation_part.index', ['id' => $studentTransportationPart->student_transportation->student_id])->with('success', 'تمت الحفظ بنجاح');

    }

    public function destroy(StudentTransportationPart $studentTransportationPart)
    {
        //
    }
}
