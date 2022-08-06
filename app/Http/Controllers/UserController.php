<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
            $user->attachRole($request->role);
        } else {
            $user->attachRole('accountant');
        }

        return redirect()->route('user.index')->with('success','تمت الاضافة بنجاح');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('dashboard/user/edit', compact('user'));
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