<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentPart;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class StudentPartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $student = Student::findOrFail($request->id);

        $parts = StudentPart::where('student_id', $student->id)->where('type', '=', 2)->get();
        $parts_total = StudentPart::where('student_id', $student->id)->where('type', '=', 2)->sum('amount');

        return view('dashboard/part/index', compact([ 'student','parts','parts_total']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentPart  $studentPart
     * @return \Illuminate\Http\Response
     */
    public function show(StudentPart $studentPart)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentPart  $studentPart
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentPart $studentPart)
    {
        //
    }

    public function receipt($id)
    {
        $part = StudentPart::with('student')->find($id);

        return view('dashboard/part/receipt', compact('part'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentPart  $studentPart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $student = Student::find($id);

        $this->validate($request, [
            'part_1' => 'required',
            'part_2' => 'required',
            'part_3' => 'required',
            'part_1_id' => 'required',
            'part_2_id' => 'required',
            'part_3_id' => 'required',
        ]);

        $student = $request->student_id;

        $total = StudentPart::where([
            ['student_id', '=', $student],
            ['type', '=', 2],
        ])->sum('amount');
        

        
        $parts_total = $request->part_1 + $request->part_2 + $request->part_3;
        
        if ($total != $parts_total) {
            throw ValidationException::withMessages(['part_1' => 'يجب ان يكون المجموع ' . $total]);
        }
            

        StudentPart::find($request->part_1_id)->update([
            'amount' => $request->part_1,
        ]);

        StudentPart::find($request->part_2_id)->update([
            'amount' => $request->part_2,
        ]);

        StudentPart::find($request->part_3_id)->update([
            'amount' => $request->part_3,
        ]);

        return redirect()->back()->with('success','تم التعديل بنجاح');
    }

    public function paymentPage($id)
    {
        $student = Student::with(['grade.grade_fee','student_part'])->findOrFail($id);

        $total_paid = StudentPart::where('student_id', $student->id)->where('paid', '=', 1)->get();
        $total_paid_amount = 0;
        
        if ($total_paid->count() > 0) {
            foreach ($total_paid as $paid) {
                $total_paid_amount = $paid->amount + $total_paid_amount;
            }
        }

        $total_remaining = StudentPart::where('student_id', $student->id)->where('paid', '=', 0)->get();
        $total_remaining_amount = 0;
        
        if ($total_remaining->count() > 0) {
            foreach ($total_remaining as $remaining) {
                $total_remaining_amount = $remaining->amount + $total_remaining_amount;
            }
        }

        return view('dashboard/part/pay', compact(['student','total_remaining_amount','total_paid_amount']));
    }

    public function pay(Request $request, $id)
    {
        $part = StudentPart::find($id);
        
        $this->validate($request, [
            'payment_type' => 'required',
            'payment_image' => 'sometimes|required|image',
            'check_number' => 'sometimes|required',
            'check_owner' => 'sometimes|string'
        ]);

        $filename = null;

        if($request->file('payment_image')) {
            $file= $request->file('payment_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('images/payment'), $filename);
        }

        $part->update([
            'paid' => 1,
            'payment_type' => $request->payment_type,
            'check_number' => $request->check_number ?? null,
            'check_owner' => $request->check_owner ?? null,
            'payment_image' => $filename,
            'payment_time' => Date('Y-m-d'),
        ]);

        return redirect()->back()->with('success','تم دفع القيمة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentPart  $studentPart
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentPart $studentPart)
    {
        //
    }
}
