<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = Subject::where('grade_id','=', $request->id)->get();
        $grade = Grade::find($request->id);

        return view('dashboard/subject/index', compact(['subjects','grade']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $grade = Grade::findOrFail($request->id);

        return view('dashboard/subject/create', compact(['grade']));
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
            'full_mark' => 'required',
            'grade_id' => 'required',
        ]);

        Subject::create([
            'name' => $request->name,
            'full_mark' => $request->full_mark,
            'grade_id' => $request->grade_id,
        ]);

        return redirect()->route('subject.index', ['id' => $request->grade_id])->with('success','تمت اضافة المادة بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('dashboard/subject/edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'full_mark' => 'required',
            'grade_id' => 'required',
        ]);

        $subject->update([
            'name' => $request->name,
            'full_mark' => $request->full_mark,
            'grade_id' => $request->grade_id,
        ]);

        return redirect()->route('subject.index', ['id' => $request->grade_id])->with('success','تم تعديل المادة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subject.index', ['id' => $request->grade_id])->with('success','تم حذف المادة بنجاح');
    }
}
