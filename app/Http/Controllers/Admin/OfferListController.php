<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferList;
use App\Models\Semester;
use App\Models\Session;
use Illuminate\Http\Request;

class OfferListController extends Controller
{
    public function index()
    {
        $offerList = OfferList::latest()->get();
        $sessions = Session::latest()->get();
        $semesters = Semester::orderBy('name')->get();

        return view('panel.pages.offerList', compact(['offerList', 'sessions', 'semesters']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions,id',
            'semester_id' => 'required|exists:semesters,id',
            'section' => 'required',
            'course_code' => 'required',
            'course_title' => 'required',
            'course_credit' => 'required',
        ]);

        $offer = new OfferList();
        $offer->course_code = $request->course_code;
        $offer->course_title = $request->course_title;
        $offer->course_credit = $request->course_credit;
        $offer->section = $request->section;
        $offer->session_id = $request->session_id;
        $offer->semester_id = $request->semester_id;
        $offer->save();

        return back()->with('success', 'Offer Created Successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions,id',
            'semester_id' => 'required|exists:semesters,id',
            'section' => 'required',
            'course_code' => 'required',
            'course_title' => 'required',
            'course_credit' => 'required',
        ]);

        $offer = OfferList::findOrFail($id);
        $offer->course_code = $request->course_code;
        $offer->course_title = $request->course_title;
        $offer->course_credit = $request->course_credit;
        $offer->section = $request->section;
        $offer->session_id = $request->session_id;
        $offer->semester_id = $request->semester_id;
        $offer->save();

        return back()->with('success', 'Offer Updated Successfully');
    }

    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return back()->with('success', 'Offer Deleted Successfully');
    }
}
