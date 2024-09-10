<?php

namespace App\Http\Controllers;

use App\Models\FoundationSchool;
use Illuminate\Http\Request;

class FoundationSchoolController extends Controller
{
    public function index()
    {
        $students = FoundationSchool::all();
        return view('foundation.index', compact('students'));
    }

    // Show form to enroll a new student
    public function create()
    {
        return view('foundation-school.create');
    }

    // Enroll a student in foundation school
    public function store(Request $request)
    {
        $request->validate([
            'convert_id' => 'required|exists:converts,id',
            'enrollment_date' => 'required|date',
        ]);

        FoundationSchool::create($request->all());
        return redirect()->route('foundation-school.index')->with('success', 'Student enrolled in Foundation School successfully');
    }

    // View a student's progress
    public function show($id)
    {
        $student = FoundationSchool::findOrFail($id);
        return view('foundation-school.show', compact('student'));
    }

    // Show form to edit a student's record
    public function edit($id)
    {
        $student = FoundationSchool::findOrFail($id);
        return view('foundation-school.edit', compact('student'));
    }

    // Update a student's foundation school record
    public function update(Request $request, $id)
    {
        $request->validate([
            'convert_id' => 'required|exists:converts,id',
            'enrollment_date' => 'required|date',
        ]);

        $student = FoundationSchool::findOrFail($id);
        $student->update($request->all());
        return redirect()->route('foundation-school.index')->with('success', 'Student record updated successfully');
    }

    // Remove a student from foundation school
    public function destroy($id)
    {
        $student = FoundationSchool::findOrFail($id);
        $student->delete();
        return redirect()->route('foundation-school.index')->with('success', 'Student removed from Foundation School');
    }
}
