<?php

namespace App\Http\Controllers;

use App\Models\Convert;
use App\Models\FoundationSchool;
use App\Models\FoundationSchoolModule;
use App\Models\Log;
use Illuminate\Http\Request;

class FoundationSchoolController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $students = FoundationSchool::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();
        return view('foundation.index', compact('students'));
    }

    public function profile(Request $request)
    {
        $foundationSchool = FoundationSchool::with(['foundationSchoolModules' => function($query) {
            $query->join('foundation_modules', 'foundation_school_modules.module_id', '=', 'foundation_modules.id')
                  ->select('foundation_school_modules.*', 'foundation_modules.module_name') // Include necessary fields
                  ->orderBy('foundation_modules.module_name', 'asc');
        }])->findOrFail($request->student_id);

        $student = FoundationSchool::with('foundationSchoolModules')->find($request->student_id);

        if (!$student) {
            // Handle case where student is not found
            return redirect()->back()->with('error', 'Student not found.');
        }

        // Calculate the number of modules and their statuses for the student
        $totalModules = $student->foundationSchoolModules->count();
        $notStartedModules = $student->foundationSchoolModules->where('progress_status', 'Not Started')->count();
        $inProgressModules = $student->foundationSchoolModules->where('progress_status', 'In Progress')->count();
        $missedModules = $student->foundationSchoolModules->where('progress_status', 'Missed')->count();
        $completedModules = $student->foundationSchoolModules->where('progress_status', 'Completed')->count();

        // Calculate overall progress (percentage of completed modules)
        $progressPercentage = $totalModules > 0 ? ($completedModules / $totalModules) * 100 : 0;

                // Check if all modules are completed
                if ($completedModules === $totalModules && $totalModules > 0) {
                    // Update the student's progress_status to 'Completed'
                    $student->progress_status = 'Completed';
                    $student->save(); // Save the update to the database
                }
                else
                {
                    $student->progress_status = 'In Progress';
                    $student->save();
                }

        return view('foundation.show', compact('foundationSchool',
            'student',
            'totalModules',
            'notStartedModules',
            'inProgressModules',
            'missedModules',
            'completedModules',
            'progressPercentage'
        ));
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
        $convert = Convert::findOrFail($student->convert_id);

        return response()->json([
            'student' => $student,
            'convert' => $convert
        ]);

    }

    // Remove a student from foundation school
    public function destroy(Request $request)
    {
        $user = Auth()->user();

        $student = FoundationSchool::findOrFail($request->selectedId);
        $modules = FoundationSchoolModule::where('foundation_school_id', $student->id)->get();

        foreach ($modules as $module)
        {
            $module->delete();
        }

        $student->delete();

        //LOG

        $description = "User ". $user->id . " deleted a foundation school student:  ". $student->id;
        $action = "Delete";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('foundation-school.index')->with('success', 'Student removed from Foundation School');
    }
}
