<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::latest()->get();

        return view('panel.pages.session', compact('sessions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sessions,name',
            'status' => 'required|in:Running,Completed',
        ]);

        $session = new Session();
        $session->name = $request->name;
        $session->status = $request->status;
        $session->save();

        return back()->with('success', 'Session Created Successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:sessions,name,'.$id,
            'status' => 'required|in:Running,Completed',
        ]);

        $session = Session::findOrFail($id);
        $session->name = $request->name;
        $session->status = $request->status;
        $session->save();

        return back()->with('success', 'Session Updated Successfully');
    }

    public function destroy($id)
    {
        $session = Session::findOrFail($id);
        $session->delete();

        return back()->with('success', 'Session Deleted Successfully');
    }
}
