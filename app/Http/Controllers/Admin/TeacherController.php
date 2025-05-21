<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')->orderBy('priority', 'desc')->get();

        return view('panel.pages.teacher', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'designation' => 'required',
            'priority' => 'required|min:1',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->designation = $request->designation;
        $user->priority = $request->priority;
        $user->password = Hash::make($request->password);
        $user->role = 'teacher';
        $user->save();

        return back()->with('success', 'Teacher Created Successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'designation' => 'required',
            'priority' => 'required|min:1',
            'password' => 'nullable|min:8',
            'confirm_password' => 'required_with:password|same:password',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->designation = $request->designation;
        $user->priority = $request->priority;
        if ($request->confirm_password) {
            $user->password = Hash::make($request->confirm_password);
        }
        $user->save();

        return back()->with('success', 'Teacher Updated Successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Teacher Deleted Successfully');
    }
}
