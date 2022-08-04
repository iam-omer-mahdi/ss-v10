<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('dashboard/user/index', compact('users'));
    }

    public function store(Request $request)
    {
        
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('dashboard/user/edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        $user->delete();

        return view('dashboard/user/index')->with('success','تم الحذف بنجاح');
    }


}
