<?php

namespace App\Http\Controllers;

use App\Exports\EventsExport;
use App\Models\Event;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class EventController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $events = Event::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();
        return view ('event.index', compact('events'));
    }

    public function create(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            // 'description' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
        ], [
            'title.required' => 'Provide a title for the event',
            // 'description.required' => 'Provide a description for the event',
            'start_datetime.required' => 'Provide event start date and time',
            'end_datetime.required' => 'Provide event end date and time',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $newEvent = Event::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'title' => $request->title,
            'description' => $request->description,
            'start_datetime' => $request->start_datetime,
            'end_datetime' => $request->end_datetime,
            'event_level' => $request->event_level,
        ]);

        //LOG
        $description = "User ". $user->id . " created an event: ". $newEvent->id;
        $action = "Update";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->back()->with('success', 'Event created successfully.');
    }

    public function details($id)
    {
        $result = Event::find($id);
        return response()->json($result);
    }

    public function update (Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
        ], [
            'title.required' => 'Provide a title for the event',
            'description.required' => 'Provide a description for the event',
            'start_datetime.required' => 'Provide event start date and time',
            'end_datetime.required' => 'Provide event end date and time',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        if($request->selectedId == null){

            $newEvent = Event::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'title' => $request->title,
                'description' => $request->description,
                'start_datetime' => $request->start_datetime,
                'end_datetime' => $request->end_datetime,
                'event_level' => $request->event_level,
            ]);

            $description = "User ". $user->id . " created an event: ". $newEvent->id;
            $action = "Update";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);
            return redirect()->back()->with('success', 'Event created successfully.');


        }else{

        $id = $request->input('selectedId');
        $result = Event::findOrFail($id);
        $result->title = $request->title;
        $result->description = $request->description;
        $result->start_datetime = $request->start_datetime;
        $result->end_datetime = $request->end_datetime;
        $result->event_level = $request->event_level;

        $result->save();

            //LOG
            $description = "User ". $user->id . " modified a event: ". $result->id;
            $action = "Update";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

            return redirect()->back()->with('success', 'Event updated successfully.');
        }

    }

    public function delete(Request $request)
    {
        $user = Auth()->user();

        $id = $request->input('selectedId');
        $result = Event::findOrFail($id);
        $result->delete();

            //LOG
            $description = "User ". $user->id . " deleted a event: ". $result->id ;
            $action = "Delete";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('event.index')->with('success', 'Event deleted successfully.');
    }

    public function export(Request $request)
    {
        $user = Auth()->user();

        //LOG
        $description = "User ". $user->id . " downloaded events data.";
        $action = "Download";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return Excel::download(new EventsExport, 'events.xlsx');
    }


}
