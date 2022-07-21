<?php 

namespace App\Http\Controllers;


use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $schools = School::all();
    return view('dashboard/school/index', compact('schools'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('dashboard/school/create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
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
    $school = School::findOrFail($id);

    return view('dashboard/school/edit', compact('school'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
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

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $school = School::findOrFail($id);

    if ($school) {
      $school->delete();
      return redirect()->route('school.index')->with('success','تم الحذف بنجاح');
    }
  }
  
}

?>