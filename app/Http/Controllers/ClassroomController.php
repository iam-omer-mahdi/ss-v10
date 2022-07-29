<?php 

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $grade = Grade::with('classroom')->findOrFail($request->id);
    $classrooms = $grade->classroom;

    return view('dashboard/class/index', compact(['classrooms','grade']));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(Request $request)
  {
    $grade = Grade::with('school')->findOrFail($request->id);
    
    return view('dashboard/class/create', compact('grade'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'grade_id' => 'required',
      'name' => 'required|string',
    ]);

    Classroom::create([
      'name' => $request->name,
      'grade_id' => $request->grade_id,
    ]);

    return redirect()->route('class.index', ['id' => $request->grade_id])->with('success','تمت الاضافة بنجاح');
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
    $classroom = Classroom::findOrFail($id);
    $schools = School::with('grades')->get();
    
    return view('dashboard/class/edit', compact(['classroom','schools']));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $classroom = Classroom::findOrFail($id);

    $this->validate($request, [
      'grade_id' => 'required',
      'name' => 'required|string',
    ]);

    $classroom->update([
      'name' => $request->name,
      'grade_id' => $request->grade_id,
    ]);

    return redirect()->route('class.index', ['id' => $classroom->grade_id])->with('success','تمت الاضافة بنجاح');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $classroom = Classroom::findOrFail($id);
    
    if ($classroom) {
      $classroom->delete();
      return redirect()->route('class.index', ['id' => $classroom->grade_id])->with('success','تم الحذف بنجاح');
    }
  }
  
}

?>