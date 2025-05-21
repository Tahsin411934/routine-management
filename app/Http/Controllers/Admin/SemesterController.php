<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::latest()->get();

        return view('panel.pages.semester', compact('semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:semesters,name',
        ]);

        $semester = new Semester();
        $semester->name = $request->name;
        $semester->save();

        return back()->with('success', 'Semester Created Successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:sessions,name,'.$id,
        ]);

        $semester = Semester::findOrFail($id);
        $semester->name = $request->name;
        $semester->save();

        return back()->with('success', 'Semester Updated Successfully');
    }

    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return back()->with('success', 'Semester Deleted Successfully');
    }
}
