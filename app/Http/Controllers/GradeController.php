<?php 

namespace App\Http\Controllers;


use App\Models\Fee;
use App\Models\Grade;
use App\Models\School;
use App\Models\GradeFee;
use Illuminate\Http\Request;

class GradeController extends Controller 
{

  // Permissions -------------------
  public function __construct()
  {
    $this->middleware(['permission:Grade-read'])->only('index');
    $this->middleware(['permission:Grade-create'])->only(['store','create']);
    $this->middleware(['permission:Grade-update'])->only(['update','edit']);
    $this->middleware(['permission:Grade-delete'])->only('destroy');
  }

  public function index()
  {
    $grades = Grade::with('school')->orderBy('school_id')->get();
    
    return view('dashboard/grade/index', compact(['grades']));
  }
  // Get Grades by School id
  public function getGrades($id)
  {
    $grades = Grade::where('school_id',$id)->get();
    $school_id = $id;

    return response()->json($grades);
  }


  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $schools = School::all();
    $fees = Fee::all();

    return view('dashboard/grade/create', compact(['schools','fees']));
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
      'school_id' => 'required',
      'amount_1' => 'required',
      'amount_2' => 'required',
      'fee_1_id' => 'required',
      'fee_2_id' => 'required'
    ]);

    $grade = Grade::create([
      'name' => $request->name,
      'school_id' => $request->school_id,
    ]);

    GradeFee::create([
      'amount' => $request->amount_1,
      'grade_id' => $grade->id,
      'fee_id' => $request->fee_1_id
    ]);

    GradeFee::create([
      'amount' => $request->amount_2,
      'grade_id' => $grade->id,
      'fee_id' => $request->fee_2_id
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
    $fees = Fee::all();

    $schools = School::all();

    return view('dashboard/grade/edit', compact(['grade','schools', 'fees']));
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
    
    $grade_fee_1 = GradeFee::where('id', $request->fee_1_id);
    $grade_fee_2 = GradeFee::where('id', $request->fee_2_id);


    $this->validate($request, [
      'name' => 'required|string',
      'school_id' => 'required'
    ]);

    $grade->update([
        'name' => $request->name,
        'school_id' => $request->school_id,
    ]);

    $grade_fee_1->update([
      'amount' => $request->amount_1,
      'grade_id' => $grade->id,
      'fee_id' => $request->fee_1_id
    ]);

    $grade_fee_2->update([
      'amount' => $request->amount_2,
      'grade_id' => $grade->id,
      'fee_id' => $request->fee_2_id
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
