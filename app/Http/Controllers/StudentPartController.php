<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentPart;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class StudentPartController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['role:super_admin|finance_manager|accountant']);
    }

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

    public function store(Request $request)
    {
        $part_count = StudentPart::where('student_id', $request->student_id)->count();
        
        $this->validate($request, [
            'student_id' => 'required',
        ]);

        StudentPart::create([
            'part_number' => $part_count + 1,
            'type' => 2,
            'amount' => 0,
            'student_id' => $request->student_id
        ]);

        return redirect()->back()->with('success','تمت الاضافة بنجاح');
    }

    public function show(StudentPart $studentPart)
    {
        
    }

    public function edit(StudentPart $studentPart)
    {
        //
    }

    public function receipt($id)
    {
        $part = StudentPart::with('student')->find($id);

        return view('dashboard/part/receipt', compact('part'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'part_number' => 'required',
            'part_id' => 'required',
        ]); 

        $total = StudentPart::where([
            ['student_id', '=', $request->student_id],
            ['type', '=', 2],
        ])->sum('amount');
        
        $parts_total = 0;

        foreach ($request->part_number as  $part) {
            $parts_total += $part;
        }

        if ($total != $parts_total) {
            throw ValidationException::withMessages(['part_number' => 'يجب ان يكون المجموع ' . $total]);
        }
            
        foreach ($request->part_id as $index => $part) {
            StudentPart::find($part)->update([
                'amount' => $request->part_number[$index],
            ]);    
        }

        return redirect()->back()->with('success','تم التعديل بنجاح');
    }

    public function paymentPage($id)
    {
        $student = Student::with(['grade.grade_fee','student_part'])->findOrFail($id);

        $total_paid_amount = StudentPart::where('student_id', $student->id)->where('paid', 1)->sum('amount');
        $total_remaining_amount = StudentPart::where('student_id', $student->id)->where('paid', 0)->sum('amount');

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

    public function destroy($id)
    {
        $part = StudentPart::findOrFail($id);
        
        if ($part->amount > 0) {
            return redirect()->back()->with('error','يجب ان تكون قيمة القسط 0 ليتم حذفه ');
        } else {
            $part->delete();
            return redirect()->back()->with('success','تم حذف القسط بنجاح');
        }
    }
}
