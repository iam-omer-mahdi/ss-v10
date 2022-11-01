<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Grade;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $exams = Exam::where('grade_id','=', $request->id)->get();
        $grade = Grade::find($request->id);
        return view('dashboard/exam/index', compact(['exams','grade']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $grade = Grade::findOrFail($request->id);
        return view('dashboard/exam/create', compact('grade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'date' => 'required',
            'grade_id' => 'required'
        ]);

        Exam::create([
            'name' => $request->name,
            'date' => $request->date,
            'grade_id' => $request->grade_id
        ]);

        return redirect()->route('exam.index', ['id' => $request->grade_id])->with('success','تمت اضافة الامتحان بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        return view('dashboard/exam/edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $exam = Exam::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string',
            'date' => 'required',
            'grade_id' => 'required'
        ]);

        $exam->update([
            'name' => $request->name,
            'date' => $request->date,
            'grade_id' => $request->grade_id
        ]);

        return redirect()->route('exam.index', ['id' => $request->grade_id])->with('success','تم التعديل الامتحان بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()->back()->with('success',' تم الحذف بنجاح');
    }
}
