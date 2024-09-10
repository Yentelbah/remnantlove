<?php

namespace App\Http\Controllers;

use App\Models\FollowUp;
use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    public function index()
    {
        $followUps = FollowUp::all();
        return view('follow-ups.index', compact('followUps'));
    }

    // Show form to schedule a new follow-up
    public function create()
    {
        return view('follow-ups.create');
    }

    // Store a new follow-up
    public function store(Request $request)
    {
        $request->validate([
            'convert_id' => 'required|exists:converts,id',
            'follow_up_date' => 'required|date',
            'method' => 'required',
        ]);

        FollowUp::create($request->all());
        return redirect()->route('follow-ups.index')->with('success', 'Follow-up scheduled successfully');
    }

    // View a specific follow-up
    public function show($id)
    {
        $followUp = FollowUp::findOrFail($id);
        return view('follow-ups.show', compact('followUp'));
    }

    // Show form to edit a follow-up
    public function edit($id)
    {
        $followUp = FollowUp::findOrFail($id);
        return view('follow-ups.edit', compact('followUp'));
    }

    // Update a follow-up
    public function update(Request $request, $id)
    {
        $request->validate([
            'follow_up_date' => 'required|date',
            'method' => 'required',
        ]);

        $followUp = FollowUp::findOrFail($id);
        $followUp->update($request->all());
        return redirect()->route('follow-ups.index')->with('success', 'Follow-up updated successfully');
    }

    // Delete a follow-up
    public function destroy($id)
    {
        $followUp = FollowUp::findOrFail($id);
        $followUp->delete();
        return redirect()->route('follow-ups.index')->with('success', 'Follow-up deleted successfully');
    }
}
