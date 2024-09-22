<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Church;
use App\Models\ChurchService;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth()->user();
        $attendances = Attendance::with(['service'])->where('church_id', $user->church_id)->where('church_branch_id',$user->church_branch_id)->orderBy('created_at', 'Desc')->get();
        $services = ChurchService::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->orderBy('service_date', 'desc')->get()->take('20');


        $categories = ['Sunday', 'All Night', 'Special', 'Other'];
        $statistics = [];
        $chartData = [];

        foreach ($categories as $category) {
            $lastAttendance = Attendance::getLastAttendanceByCategory($category);
            $previousAttendance = $lastAttendance ? Attendance::getPreviousAttendanceByCategory($category, $lastAttendance->created_at) : null;

            if ($lastAttendance && $previousAttendance) {
                $change = $lastAttendance->total_attendance - $previousAttendance->total_attendance;
                $percentageChange = ($change / $previousAttendance->total_attendance) * 100;
            } else {
                $percentageChange = null;
            }

            $totalAttendance = Attendance::getTotalAttendanceByCategory($category);

            // Fetch the last five attendance records
            $lastFiveAttendances = Attendance::getLastFiveAttendancesByCategory($category);
            $chartData[$category] = [
                'dates' => $lastFiveAttendances->pluck('created_at')->map(function ($date) {
                    return $date->format('Y-m-d');
                })->toArray(),
                'attendances' => $lastFiveAttendances->pluck('total_attendance')->toArray()
            ];

            $statistics[$category] = [
                'last_attendance' => $lastAttendance ? $lastAttendance->total_attendance : 0,
                'percentage_change' => $percentageChange,
                'total_attendance' => $totalAttendance,
            ];
        }

        return view('attendance.index', compact('attendances', 'statistics','services', 'chartData'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $user = Auth()->user();

        $request->validate([
            'service_id' => 'required|uuid|exists:church_services,id',
        ]);

        $total = $request->children_males+$request->children_females+$request->adult_males+$request->adult_females;
        $input = $request->all();
        $input['church_id'] = $user->church_id;
        $input['church_branch_id'] = $user->church_branch_id;
        $input['total_attendance'] = $total;

        $check = Attendance::where('service_id', $request->service_id)->first();

        if($check ==!null){
            return redirect()->back()->with('info', 'Attendance for the service has been recorded already.');
        }

        $att = Attendance::create($input);

            //LOG
            $description = "User ". $user->id . " recoreded an attendance: ". $att->id ;
            $action = "Attendance Record";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('attendance.index')->with('success', 'Attendance recorded successfully.');
    }

    public function details(Request $request, $id)
    {
        $result = Attendance::findOrFail($id);
        return response()->json($result);
    }

    public function update(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'att_id' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $attendance = Attendance::findOrFail($request->att_id);
        $total = $request->children_males+$request->children_females+$request->adult_males+$request->adult_females;
        $attendance->total_attendance = $total;
        $attendance->update($request->all());

        //LOG

        $description = "User ". $user->id . " updated attendance recorded:  ". $attendance->id;
        $action = "Update";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('attendance.index')->with('success', 'Service updated successfully');
    }

    public function storeService(Request $request)
    {
        $user = Auth()->user();

        $request->validate([
            'name' => 'required',
            'category' => 'required|in:Sunday,All Night,Special,Other'
        ]);

        $input = $request->all();
        $input['church_id'] = $user->church_id;
        $input['church_branch_id'] = $user->church_branch_id;

        $service = ChurchService::create($input);

                    //LOG
                    $description = "User ". $user->id . " create a church service: ". $service->id ;
                    $action = "Create";

                    $log = Log::create([
                        'user_id' => $user->id,
                        'church_id' => $user->church_id,
                        'church_branch_id' => $user->church_branch_id,
                        'action' => $action,
                        'description' => $description,
                    ]);

        return redirect()->route('attendance.index')->with('success', 'Service has been add successfully.');

    }


    public function service_update(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Provide a name of the service',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $service = ChurchService::findOrFail($request->selectedId);
        $service->update($request->all());

        //LOG

        $description = "User ". $user->id . " updated ionformation of a service:  ". $service->id;
        $action = "Update";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('attendance.index')->with('success', 'Service updated successfully');
    }

    public function service_details($id)
    {

        $result = ChurchService::findOrFail($id);
        return response()->json($result);

    }

    public function service_delete(Request $request)
    {
        $user = Auth()->user();
        $service = ChurchService::findOrFail($request->selectedId);

        $attendance = Attendance::where('service_id', $service->id)->first();
        $attendance->delete();
        $service->delete();

        //LOG

        $description = "User ". $user->id . " deleted a church service:  ". $service->id;
        $action = "Delete";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('attendance.index')->with('success', 'Service deleted successfully');
    }

}
