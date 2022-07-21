<?php 

namespace App\Http\Controllers;


use App\Models\Grade;
use App\Models\School;
use Illuminate\Http\Request;

class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $grades = Grade::with('school')->get();
    $schools = School::all();
    return view('dashboard/grade/index', compact(['grades','schools']));
  }


  public function filter_by_school(Request $request)
  {
    dd($request);
    $grades = Grade::with('school')->where('school_id',$request->filter_grades)->get();
    $schools = School::all();

    return view('dashboard/grade/index', compact(['grades','schools']));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $schools = School::all();
    return view('dashboard/grade/create', compact('schools'));
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
      'school_id' => 'required'
    ]);

    Grade::create([
        'name' => $request->name,
        'school_id' => $request->school_id,
    ]);

    return redirect()->route('grade.index')->with('success','تمت الاضافة بنجاح');

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
    $grade = Grade::findOrFail($id);

    $schools = School::all();

    return view('dashboard/grade/edit', compact(['grade','schools']));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $grade = Grade::findOrFail($id);
    
    $this->validate($request, [
      'name' => 'required|string',
      'school_id' => 'required'
    ]);

    $grade->update([
        'name' => $request->name,
        'school_id' => $request->school_id,
    ]);

    return redirect()->route('grade.index')->with('success','تم التعديل بنجاح');

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $grade = Grade::findOrFail($id);
    
    if ($grade) {
      $grade->delete();
      return redirect()->route('grade.index')->with('success','تم الحذف بنجاح');
    }
  }
  
}

?>