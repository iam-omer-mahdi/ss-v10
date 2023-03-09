<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Discount;
use App\Models\GradeFee;
use App\Models\Classroom;
use App\Models\Nationality;
use App\Models\StudentPart;
use Illuminate\Http\Request;
use App\Models\GuardianRelation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{

  // Permissions -------------------
  public function __construct()
  {
    $this->middleware(['can:read_student'])->only('index');
    $this->middleware(['can:create_student'])->only(['store', 'create']);
    $this->middleware(['can:update_student'])->only(['update', 'edit']);
    $this->middleware(['can:delete_student'])->only('destroy');
  }

  public function index(Request $request)
  {
    $classroom = Classroom::with('student')->findOrFail($request->id);
    $students = $classroom->student;

    return view('dashboard/student/index', compact(['students', 'classroom']));
  }

  public function create_result($id)
  {
    $student = Student::with(['grade', 'classroom'])->findOrFail($id);

    $subjects = Subject::where('grade_id', $student->grade->id)->get();
    $exams = Exam::where('grade_id', $student->grade->id)->get();

    return view('dashboard/student/create_result', compact(['student', 'subjects', 'exams']));
  }

  public function search(Request $request)
  {
    $students = Student::with('classroom')->where('name', 'like', "%{$request->search}%")->get();

    return view('dashboard/student/search', compact(['students']));
  }

  /**
   * Show the form for creating a new resource.
   * 
   * @return Response
   */

  public function create(Request $request)
  {

    $discounts = Discount::all();
    $classroom = Classroom::findOrFail($request->id);
    $nationalities = Nationality::all();
    $relations = GuardianRelation::all();

    return view('dashboard/student/create', compact(['classroom', 'nationalities', 'relations', 'discounts']));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

    $this->validate($request, [
      'name' => 'required|string',
      'address' => 'string|nullable',
      'nationality' => 'required',
      'guardian' => 'required|string',
      'guardian_relation' => 'required',
      'guardian_workplace' => 'string|nullable',
      'guardian_f_phone' => 'required',
      'guardian_s_phone' => 'nullable',
      'mother_name' => 'required|string',
      'mother_f_phone' => 'required',
      'mother_s_phone' => 'nullable',
      'classroom_id' => 'required',
      'discount' => 'nullable',
    ]);

    $student = null;

    DB::transaction(function () use ($request, &$student) {

      $student = Student::create([
        'name'  => $request->name,
        'address'  => $request->address,
        'nationality_id'  => $request->nationality,
        'guardian'  => $request->guardian,
        'guardian_relation_id'  => $request->guardian_relation,
        'guardian_workplace'  => $request->guardian_workplace,
        'guardian_f_phone'  => $request->guardian_f_phone,
        'guardian_s_phone'  => $request->guardian_s_phone,
        'mother_name'  => $request->mother_name,
        'mother_f_phone'  => $request->mother_f_phone,
        'mother_s_phone'  => $request->mother_s_phone,
        'classroom_id'  => $request->classroom_id,
        'no_payment' => $request->no_payment,
        'discount_id'  => $request->discount,
      ]);

      if (!$request->has('no_payment')) { // check if student is payment free

        $grade_fee = GradeFee::where('grade_id', $student->grade->id)->whereHas('fee', function ($q) {
          $q->where('type', '=', 2);
        })->first();

        $registration_fee = GradeFee::where('grade_id', $student->grade->id)->whereHas('fee', function ($q) {
          $q->where('type', '=', 1);
        })->first();

        $student_fee = $grade_fee->amount - (($student->discount->amount / 100) * $grade_fee->amount);

        // Reg Fee
        StudentPart::create([
          'part_number' => 4,
          'type' => 1,
          'amount' => $registration_fee->amount,
          'student_id' => $student->id,
        ]);

        // Student FeesParts
        StudentPart::create([
          'part_number' => 1,
          'type' => 2,
          'amount' => $student_fee * 0.5,
          'student_id' => $student->id,
        ]);

        StudentPart::create([
          'part_number' => 2,
          'type' => 2,
          'amount' => $student_fee * 0.25,
          'student_id' => $student->id,
        ]);

        StudentPart::create([
          'part_number' => 3,
          'type' => 2,
          'amount' => $student_fee * 0.25,
          'student_id' => $student->id,
        ]);
      }
      return $student;
    });

    return redirect()->route('student.show', $student->id)->with('success', 'تمت الاضافة بنجاح');
  }


  public function show($id)
  {
    $student = Student::with(['classroom', 'grade.grade_fee', 'discount', 'nationality', 'guardian_relation'])->findOrFail($id);

    $total_paid_amount = StudentPart::where('student_id', $student->id)->where('paid', 1)->sum('amount');
    $total_remaining_amount = StudentPart::where('student_id', $student->id)->where('paid', 0)->sum('amount');

    return view('dashboard/student/show', compact(['student', 'total_paid_amount', 'total_remaining_amount']));
  }


  public function edit($id)
  {
    $student = Student::findOrFail($id);

    $discounts = Discount::all();
    $nationalities = Nationality::all();
    $relations = GuardianRelation::all();

    return view('dashboard/student/edit', compact(['student', 'nationalities', 'relations', 'discounts']));
  }


  public function update(Request $request, $id)
  {
    $student = Student::findOrFail($id);

    $this->validate($request, [
      'name' => 'required|string',
      'address' => 'string|nullable',
      'nationality' => 'required',
      'guardian' => 'required|string',
      'guardian_relation' => 'required',
      'guardian_workplace' => 'string|nullable',
      'guardian_f_phone' => 'required',
      'guardian_s_phone' => 'nullable',
      'mother_name' => 'required|string',
      'mother_f_phone' => 'required',
      'mother_s_phone' => 'nullable',
      'classroom_id' => 'required',
      'discount_id' => 'nullable',
    ]);

    DB::transaction(function () use ($request, $student) {
      $student->update([
        'name'  => $request->name,
        'address'  => $request->address,
        'nationality_id'  => $request->nationality,
        'guardian'  => $request->guardian,
        'guardian_relation_id'  => $request->guardian_relation,
        'guardian_workplace'  => $request->workplace,
        'guardian_f_phone'  => $request->guardian_f_phone,
        'guardian_s_phone'  => $request->guardian_s_phone,
        'mother_name'  => $request->mother_name,
        'mother_f_phone'  => $request->mother_f_phone,
        'mother_s_phone'  => $request->mother_s_phone,
        'classroom_id'  => $request->classroom_id,
        'no_payment' => $request->no_payment,
        'discount_id'  => $request->discount,
      ]);

      // Edit Parts If Discount Updated
      if ($student->wasChanged('discount_id')) {
        // Delete Old Parts
        $parts = StudentPart::where('student_id', $student->id)->get();



        foreach ($parts as $part) {
          $image_path = "images/payment/" . $part->payment_image;
          if (File::exists($image_path)) {
            File::delete($image_path);
          }
          $part->delete();
        }

        // Create New Parts According To New Discount
        $grade_fee = GradeFee::where('grade_id', $student->grade->id)->whereHas('fee', function ($q) {
          $q->where('type', '=', 2);
        })->first();

        $registration_fee = GradeFee::where('grade_id', $student->grade->id)->whereHas('fee', function ($q) {
          $q->where('type', '=', 1);
        })->first();

        $student_fee = $grade_fee->amount - ($student->discount->amount / 100) * $grade_fee->amount;

        // Reg Fee
        StudentPart::create([
          'part_number' => 4,
          'type' => 1,
          'amount' => $registration_fee->amount,
          'student_id' => $student->id,
        ]);

        // Student FeesParts
        StudentPart::create([
          'part_number' => 1,
          'type' => 2,
          'amount' => $student_fee * 0.5,
          'student_id' => $student->id,
        ]);

        StudentPart::create([
          'part_number' => 2,
          'type' => 2,
          'amount' => $student_fee * 0.25,
          'student_id' => $student->id,
        ]);

        StudentPart::create([
          'part_number' => 3,
          'type' => 2,
          'amount' => $student_fee * 0.25,
          'student_id' => $student->id,
        ]);
      }
    });

    return redirect()->route('student.show', $student->id)->with('success', 'تم التعديل بنجاح');
  }

  public function destroy($id)
  {
    $student = Student::findOrFail($id);

    if ($student) {
      $student->delete();
      return redirect()->route('student.index', ['id' => $student->classroom_id])->with('success', 'تم الحذف بنجاح');
    }
  }
}
