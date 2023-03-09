<?php 

namespace App\Http\Controllers;


use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller 
{

  // Permissions -------------------
  public function __construct()
  {
    $this->middleware(['can:read_school'])->only('index');
    $this->middleware(['can:create_school'])->only(['store','create']);
    $this->middleware(['can:update_school'])->only(['update','edit']);
    $this->middleware(['can:delete_school'])->only('destroy');
  }

  // School Page with school list
  public function index()
  {    
    $schools = School::all();
    return view('dashboard/school/index', compact('schools'));
  }

  // Create School page
  public function create()
  {
    return view('dashboard/school/create');
  }

  // Store School in Database
  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|string|unique:schools'
    ]);

    School::create([
      'name' => $request->name
    ]);

    return redirect()->route('school.index')->with('success','تمت الاضافة بنجاح');

  }

  // Show A School
  public function show($id)
  {
    
  }

  // Edit School Page
  public function edit($id)
  {
    $school = School::findOrFail($id);

    return view('dashboard/school/edit', compact('school'));
  }

  public function update(Request $request, $id)
  {

    $school = School::findOrFail($id);

    $this->validate($request, [
      'name' => 'required|string'
    ]);

    $school->update([
      'name' => $request->name
    ]);

    return redirect()->route('school.index')->with('success','تم التعديل بنجاح');
  }

  public function destroy($id)
  {

    $school = School::findOrFail($id);

    if ($school) {
      $school->delete();
      return redirect()->route('school.index')->with('success','تم الحذف بنجاح');
    }
  }
  
}
