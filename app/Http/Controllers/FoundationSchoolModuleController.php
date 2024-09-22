<?php

namespace App\Http\Controllers;

use App\Models\FoundationModule;
use App\Models\FoundationSchool;
use App\Models\FoundationSchoolModule;
use Illuminate\Http\Request;

class FoundationSchoolModuleController extends Controller
{
    // View details of a specific module
    public function show($id)
    {
        $module = FoundationSchoolModule::findOrFail($id);
        $foundation_module = FoundationModule::findOrFail($module->module_id);

        return response()->json([
            'module' => $module,
            'foundation_module' => $foundation_module
        ]);
    }

    // Update a module
    public function update(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'selectedId' => 'required|exists:foundation_school_modules,id',
        ]);

        $module = FoundationSchoolModule::findOrFail($request->selectedId);
        $module->progress_status = $request->status;
        $module->save();

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
        ))->with('success', 'Module updated successfully');

    }

    // Delete a module
    public function destroy($id)
    {
        $module = FoundationSchoolModule::findOrFail($id);
        $module->delete();
        return redirect()->route('foundation-modules.index')->with('success', 'Module deleted successfully');
    }

}
