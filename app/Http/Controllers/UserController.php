<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
      // Permissions -------------------
  public function __construct()
  {
    $this->middleware(['can:read_user'])->only('index');
    $this->middleware(['can:create_user'])->only(['store','create']);
    $this->middleware(['can:update_user'])->only(['update','edit']);
    $this->middleware(['can:delete_user'])->only('destroy');
  }

    public function index()
    {
        $users = '';
        if (auth()->user()->hasRole('super_admin')) {
            $users = User::with('roles')->get();
        } else {   
            $users = User::whereHas('roles', function($q)
            {
                $q->where('name', '=', 'accountant');
            })->get();
        }
        
        return view('dashboard/user/index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard/user/create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required',
            'username' => 'string|required|unique:users',
            'password' => 'confirmed|min:8|required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('role')) {
            $user->assignRole($request->role);
        } else {
            $user->assignRole('accountant');
        }

        return redirect()->route('user.index')->with('success','تمت الاضافة بنجاح');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('dashboard/user/edit', compact('user'));        
    }

    public function change_password($id)
    {
        $user = User::findOrFail($id);

        if ($user->id == auth()->user()->id) {    
            return view('dashboard/user/change_password', compact('user'));
        } else {
            return redirect()->route('home');
        }

    }

    public function update_password(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        } else {
            return redirect()->back()->with('error','كلمة المرور الحالية غير صحيحة');
        }


        return redirect()->back()->with('success','تم التعديل بنجاح');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'string|required',
            'username' => ['string','required', Rule::unique('users')->ignore($id)],
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);

        return redirect()->route('user.index')->with('success','تم التعديل بنجاح');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if (auth()->user()->id == $user->id) {
            return redirect()->back()->with('error','لا يمكن حذف الحساب');
        } else {
            $user->delete();
        }

        return redirect()->back()->with('success','تم الحذف بنجاح');
    }

}
