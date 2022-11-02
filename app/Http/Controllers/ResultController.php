<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Mark;
use App\Models\Grade;
use App\Models\Result;
use App\Models\School;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{

    public function index(Request $request)
    {
        $schools = School::all();

        return view('dashboard/result/index', compact(['schools']));
    }

    public function create(Request $request)
    {

        $student = Student::find($request->id);
        $exams = Exam::where('grade_id', $student->grade->id)->get();

        return view('dashboard/result/create', compact(['exams', 'student']));
    }

    public function create_result(Request $request)
    {
        $exam = Exam::findOrFail($request->id);
        $grade = Grade::findOrFail($exam->grade_id);
        $classrooms = Classroom::where('grade_id', $grade->id)->pluck('id');
        
        // Check if the student already have a result
        $res = Result::where(['exam_id' => $exam->id])->pluck('student_id');

        if (count($res) > 0) {
            $students = Student::whereIn('classroom_id', $classrooms)->whereNotIn('id',$res)->orderBy('name')->get();
        } else {
            $students = Student::whereIn('classroom_id', $classrooms)->orderBy('name')->get();
        }

        return view('dashboard/result/create_result', compact(['exam', 'students']));
    }

    public function store_result(Request $request)
    {
        if ($request->has('students')) {     
        
            foreach ($request->students as $key => $student) {

                DB::transaction(function () use($request, $student) {
                    
                    $result = Result::create([
                        'exam_id' => $request->exam_id,
                        'student_id' => $student['student_id']
                    ]);

                    $marks = $student['subjects'];

                    foreach ($marks as $index => $mark) {
                        Mark::create([
                            'mark' => $mark['mark'],
                            'result_id' => $result->id,
                            'subject_id' => $mark['subject_id'],
                        ]);
                    }

                });

            }

            return redirect()->route('exam.index', ['id' => $request->grade_id])->with('success', 'تمت الاضافة بنجاح');
        }
        
        return redirect()->route('exam.index', ['id' => $request->grade_id]);
    }

    public function get_subjects(Request $request)
    {
        $subjects = Subject::where('exam_id', $request->exam_id)->get();

        return response()->json($subjects);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'mark' => 'required',
            'exam_id' => 'required',
            'student_id' => 'required',
        ]);

        $student = Student::find($request->student_id);

        $res = Result::where(['exam_id' => $request->exam_id])->where(['student_id' => $request->student_id])->get();

        if ($res->count() > 0) {
            return redirect()->back()->with('error', 'النتيجة موجودة مسبقا');
        }

        $result = Result::create([
            'exam_id' => $request->exam_id,
            'student_id' => $request->student_id
        ]);

        $marks = $request->mark;
        $subjects = Subject::where('exam_id', $request->exam_id)->get();

        foreach ($marks as $index => $mark) {
            Mark::create([
                'mark' => $mark,
                'result_id' => $result->id,
                'subject_id' => $subjects[$index]->id,
            ]);
        }

        return redirect()->route('student.index', ['id' => $student->classroom_id])->with('success', 'تمت الاضافة بنجاح');
    }

    public function show($id)
    {
        $student = Student::find($id);
        $results = Result::with(['exam.subject', 'mark'])->where('student_id', $id)->get();

        return view('dashboard/result/show', compact(['results', 'student']));
    }

    public function result_report(Request $request)
    {

        $exam = Exam::find($request->exam);
        $results = null;
        $classroom = null;
        
        if ($request->has('classroom')) {
            
            $classroom = Classroom::find($request->classroom);
            
            $results = Result::with(['exam.subject', 'mark', 'student'])
                ->where('exam_id', $request->exam)
                ->whereHas('student', function ($q) use ($request) {
                    $q->where('classroom_id', $request->classroom);
                })
                ->get();
        } else {
            $results = Result::with(['exam.subject', 'mark', 'student'])->where('exam_id', $request->exam)->get();
        }


        
        foreach ($results as $result) {
            $result['total_marks'] = 0;
            foreach ($result->mark as $mark) {
                $result['total_marks'] += $mark->mark;
            }
        }

        return view('dashboard/result/result_report', compact(['results', 'exam', 'classroom']));
    }

    public function edit(Result $result)
    {
        return view('dashboard/result/edit', compact('result'));
    }

    public function update(Request $request, Result $result)
    {
        $this->validate($request, [
            'mark' => 'required',
            'mark_id' => 'required',
        ]);

        // Mark Input 
        $marks = $request->mark;
        // Mark ID 
        $marks_id = $request->mark_id;

        foreach ($marks_id as $index => $mark) {
            // Get The Mark Model & Update ...
            Mark::find($mark)->update([
                'mark' => $marks[$index],
            ]);
        }

        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }

    public function destroy(Result $result)
    {
        $result->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }
}
