<?php

namespace App\Http\Controllers;

use App\Models\FoundationSchoolModule;
use Illuminate\Http\Request;

class FoundationModuleController extends Controller
{
    public function index()
    {
        $modules = FoundationSchoolModule::all();
        return view('foundation-modules.index', compact('modules'));
    }

    // Show form to create a new module
    public function create()
    {
        return view('foundation-modules.create');
    }

    // Store a new module
    public function store(Request $request)
    {
        $request->validate([
            'module_name' => 'required',
            'completion_date' => 'nullable|date',
        ]);

        FoundationSchoolModule::create($request->all());
        return redirect()->route('foundation-modules.index')->with('success', 'Module created successfully');
    }

    // View details of a specific module
    public function show($id)
    {
        $module = FoundationSchoolModule::findOrFail($id);
        return view('foundation-modules.show', compact('module'));
    }

    // Show form to edit a module
    public function edit($id)
    {
        $module = FoundationSchoolModule::findOrFail($id);
        return view('foundation-modules.edit', compact('module'));
    }

    // Update a module
    public function update(Request $request, $id)
    {
        $request->validate([
            'module_name' => 'required',
        ]);

        $module = FoundationSchoolModule::findOrFail($id);
        $module->update($request->all());
        return redirect()->route('foundation-modules.index')->with('success', 'Module updated successfully');
    }

    // Delete a module
    public function destroy($id)
    {
        $module = FoundationSchoolModule::findOrFail($id);
        $module->delete();
        return redirect()->route('foundation-modules.index')->with('success', 'Module deleted successfully');
    }
}
