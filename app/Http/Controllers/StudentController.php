<?php 

namespace App\Http\Controllers;


use App\Models\Student;
use App\Models\Discount;
use App\Models\GradeFee;
use App\Models\Classroom;
use App\Models\StudentFee;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\GuardianRelation;

class StudentController extends Controller 
{

  
  public function index(Request $request)
  {
    $classroom = Classroom::with('student')->findOrFail($request->id);
    $students = $classroom->student;

    return view('dashboard/student/index', compact(['students','classroom']));
  }

  public function search(Request $request)
  {

    // dd($request->search);
    $students = Student::with('classroom')->where('name','like', "%{$request->search}%")->get();
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

    return view('dashboard/student/create', compact(['classroom','nationalities','relations','discounts']));
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
      'discount_id'  => $request->discount,
    ]);
    // Student Fees

    // $grade_fees = GradeFee::where('grade_id',$student->classroom->grade->id)->get();
    
    // foreach ($grade_fees as $grade_fee) {
    //   dd($grade_fee);
    //   StudentFee::create([
    //     'grade_fee_id' => $grade_fee->id,
    //     'student_id' => $student->id
    //   ]);
    // }

    return redirect()->back()->with('success','تمت الاضافة بنجاح');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $student = Student::with(['classroom','grade.grade_fee','discount','nationality','guardian_relation'])->findOrFail($id);

    return view('dashboard/student/show', compact(['student']));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $student = Student::findOrFail($id);    
    
    $discounts = Discount::all();
    $nationalities = Nationality::all();
    $relations = GuardianRelation::all();

    return view('dashboard/student/edit', compact(['student','nationalities','relations','discounts']));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
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
      'discount_id'  => $request->discount,
    ]);

    return redirect()->route('student.show', $student->id)->with('success','تم التعديل بنجاح');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $student = Student::findOrFail($id);
    
    if ($student) {
      $student->delete();
      return redirect()->route('student.index', ['id' => $student->classroom_id])->with('success','تم الحذف بنجاح');
    }
  }
  
}

?>