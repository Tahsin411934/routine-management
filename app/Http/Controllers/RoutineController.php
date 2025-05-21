<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use App\Models\User;
use App\Models\Semester;
use App\Models\Session;
use App\Models\RoutineSection;
use App\Models\RoutineTeacher;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoutineController extends Controller
{
    public function index(Request $request)
    {
        $sessions = Session::all();
        $semesters = Semester::all();
        $teachers = User::where('role', 'teacher')->orderBy('priority', 'desc')->get();

        $latestSession = Session::latest()->first();
        $selectedSession = $request->get('session', $latestSession->id);

        $routines = Routine::where('session', $selectedSession)
            ->with(['routineSections', 'routineSections.routineTeachers.teacher'])
            ->get()
            ->groupBy(function ($routine) {
                return Carbon::parse($routine->date)->format('Y-m-d');
            });

        return view('panel.pages.routine', compact(
            'routines',
            'sessions',
            'selectedSession',
            'semesters',
            'teachers'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'session' => 'required|exists:sessions,id',
            'semester' => 'required',
            'course_name' => 'required|string',
            'course_code' => 'required|string',
            'sections' => 'required|array',
            'sections.*.section' => 'required|string',
            'sections.*.room' => 'required|string',
            'sections.*.teachers' => 'required|array',
            'sections.*.teachers.*.teacher_id' => 'required|exists:users,id',
        ]);

        $formattedTime = date("g:i A", strtotime($request->start_time)) . ' - ' . 
                         date("g:i A", strtotime($request->end_time));

        $routine = Routine::create([
            'date' => $request->date,
            'time' => $formattedTime,
            'session' => $request->session,
            'semester' => $request->semester,
            'course_name' => $request->course_name,
            'course_code' => $request->course_code,
        ]);

        foreach ($request->sections as $sectionData) {
            $section = $routine->routineSections()->create([
                'section' => $sectionData['section'],
                'room' => $sectionData['room'],
            ]);

            foreach ($sectionData['teachers'] as $teacherData) {
                RoutineTeacher::create([
                    'section_id' => $section->id,
                    'teacher_id' => $teacherData['teacher_id']
                ]);
            }
        }

        return redirect()->back()->with('success', 'Routine created successfully.');
    }

    public function update(Request $request, Routine $routine)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'session' => 'required|exists:sessions,id',
            'semester' => 'required',
            'course_name' => 'required|string',
            'course_code' => 'required|string',
            'sections' => 'required|array',
            'sections.*.section' => 'required|string',
            'sections.*.room' => 'required|string',
            'sections.*.teachers' => 'required|array',
            'sections.*.teachers.*.teacher_id' => 'required|exists:users,id',
        ]);

        $formattedTime = date("g:i A", strtotime($request->start_time)) . ' - ' . 
                         date("g:i A", strtotime($request->end_time));

        $routine->update([
            'date' => $request->date,
            'time' => $formattedTime,
            'session' => $request->session,
            'semester' => $request->semester,
            'course_name' => $request->course_name,
            'course_code' => $request->course_code,
        ]);

        // Delete existing sections and teachers
        $routine->routineSections()->each(function($section) {
            RoutineTeacher::where('section_id', $section->id)->delete();
            $section->delete();
        });

        // Create new sections with teachers
        foreach ($request->sections as $sectionData) {
            $section = $routine->routineSections()->create([
                'section' => $sectionData['section'],
                'room' => $sectionData['room'],
            ]);

            foreach ($sectionData['teachers'] as $teacherData) {
                RoutineTeacher::create([
                    'section_id' => $section->id,
                    'teacher_id' => $teacherData['teacher_id']
                ]);
            }
        }

        return redirect()->back()->with('success', 'Routine updated successfully.');
    }

    public function destroy(Routine $routine)
    {
        // Delete all related records
        $routine->routineSections()->each(function($section) {
            RoutineTeacher::where('section_id', $section->id)->delete();
            $section->delete();
        });
        
        $routine->delete();
        
        return redirect()->back()->with('success', 'Routine deleted successfully.');
    }
}