<?php 

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller 
{

  // Permissions -------------------
  public function __construct()
  {
    $this->middleware(['can:read_classroom'])->only('index');
    $this->middleware(['can:create_classroom'])->only(['store','create']);
    $this->middleware(['can:update_classroom'])->only(['update','edit']);
    $this->middleware(['can:delete_classroom'])->only('destroy');
  }

  public function index(Request $request)
  {
    $grade = Grade::with(['classroom'])->findOrFail($request->id);
    $classrooms = $grade->classroom;

    return view('dashboard/class/index', compact(['classrooms','grade']));
  }

  public function create(Request $request)
  {
    $grade = Grade::with('school')->findOrFail($request->id);
    
    return view('dashboard/class/create', compact('grade'));
  }

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

  public function edit($id)
  {
    $classroom = Classroom::findOrFail($id);
    $schools = School::with('grades')->get();
    
    return view('dashboard/class/edit', compact(['classroom','schools']));
  }

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
  
  public function destroy($id)
  {
    $classroom = Classroom::findOrFail($id);
    
    if ($classroom) {
      $classroom->delete();
      return redirect()->route('class.index', ['id' => $classroom->grade_id])->with('success','تم الحذف بنجاح');
    }
  }
  
}
