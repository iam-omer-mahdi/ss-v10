<?php 

namespace App\Http\Controllers;


use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $students = Student::all();

    return view('dashboard/student/index', compact('students'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('dashboard/student/create');
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
    ]);

    Student::create([
      'name'  => $request->name,
      'address'  => $request->address,
      'nationality'  => $request->nationality,
      'guardian'  => $request->guardian,
      'guardian_relation'  => $request->guardian_relation,
      'guardian_workplace'  => $request->guardian_workplace,
      'guardian_f_phone'  => $request->guardian_f_phone,
      'guardian_s_phone'  => $request->guardian_s_phone,
      'mother_name'  => $request->mother_name,
      'mother_f_phone'  => $request->mother_f_phone,
      'mother_s_phone'  => $request->mother_s_phone,
      'classroom_id'  => $request->classroom_id,
    ]);

    return redirect()->route('student.index')->with('success','تمت الاضافة بنجاح');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
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
    
    return view('dashboard/student/edit', compact('student'));
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
    ]);

    $student->update([
      'name'  => $request->name,
      'address'  => $request->address,
      'nationality'  => $request->nationality,
      'guardian'  => $request->guardian,
      'guardian_relation'  => $request->guardian_relation,
      'guardian_workplace'  => $request->guardian_workplace,
      'guardian_f_phone'  => $request->guardian_f_phone,
      'guardian_s_phone'  => $request->guardian_s_phone,
      'mother_name'  => $request->mother_name,
      'mother_f_phone'  => $request->mother_f_phone,
      'mother_s_phone'  => $request->mother_s_phone,
      'classroom_id'  => $request->classroom_id,
    ]);

    return redirect()->route('student.index')->with('success','تم التعديل بنجاح');
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
      return redirect()->route('student.index')->with('success','تم الحذف بنجاح');
    }
  }
  
}

?>