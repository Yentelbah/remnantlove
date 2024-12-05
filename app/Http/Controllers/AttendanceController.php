<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Church;
use App\Models\ChurchService;
use App\Models\ChurchServiceAttendance;
use App\Models\FamilyMember;
use App\Models\Log;
use App\Models\Member;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
        $church_id = Auth::user()->church_id;
        $church_branch_id = Auth::user()->church_branch_id;
        $attendanceLink = route('attendance.form', [
            'churchId' => $church_id,
            // 'churchBranchId' => $church_branch_id
        ]);
        $image = QrCode::size(200)->generate($attendanceLink);

        return view('attendance.index', compact('attendances', 'statistics','services', 'chartData', 'image', 'church_id',));
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

    public function showAttendanceForm($churchId)
    {
        $date = Carbon::today()->toDateString();
        $service = ChurchService::where('service_date', $date)->get();
        return view('attendance.form', compact('service', 'churchId',));
    }

    public function recordAttendance(Request $request)
    {
        $request->validate([
            'church_id' => 'required|exists:churches,id',
            'is_member' => 'required|in:yes,no',
            'family_members' => 'array', // Validate family_members as an array if provided
        ]);

        $service = ChurchService::find($request->service);
        $attendee_id = null;
        $is_member = false;

        if ($request->is_member == 'yes') {
            // Find or create member
            $member = Member::where('email', $request->member_email)
                ->orWhere('phone', $request->member_phone)
                ->first();

            if (!$member) {
                $member = Member::create([
                    'name' => $request->member_name,
                    'phone' => $request->member_phone,
                    'email' => $request->member_email,
                    'church_id' => $request->church_id,
                    'church_branch_id' => $service->church_branch_id,
                ]);
            }

            // Process family members
            if ($request->family_members) {
                foreach ($request->family_members as $familyMemberId) {
                    // Find the family member by their ID
                    $familyMember = Member::find($familyMemberId);

                    // Check if the family member exists
                    if ($familyMember) {
                        $alreadyMarked = ChurchServiceAttendance::where('attendee_id', $familyMember->id)
                            ->whereDate('created_at', Carbon::today())
                            ->exists();

                        if ($alreadyMarked) {
                            continue; // Skip this family member if attendance is already marked
                        }

                        // Record attendance for each family member
                        ChurchServiceAttendance::create([
                            'attendee_id' => $familyMember->id, // Use the family member's ID
                            'date' => Carbon::now(),
                            'is_member' => true, // Assuming all family members are members
                            'service_id' => $service->id,
                            'church_id' => $request->church_id,
                            'church_branch_id' => $service->church_branch_id,
                        ]);
                    }
                }
            }

            $attendee_id = $member->id;
            $is_member = true;
        }

        if ($request->is_member == 'no') {
            // Find or create visitor
            $visitor = Visitor::where('church_id', $request->church_id)
                ->where(function ($query) use ($request) {
                    $query->where('email', $request->email)
                          ->orWhere('phone', $request->phone);
                })
                ->first();

            if (!$visitor) {
                $visitor = Visitor::create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'date_visited' => Carbon::now(),
                    'location' => $request->location,
                    'email' => $request->email,
                    'dob' => $request->dob,
                    'occupation' => $request->occupation,
                    'preferred_contact' => $request->preferred_contact,
                    'best_time' => $request->best_time,
                    'church_id' => $request->church_id,
                    'invitee' => $request->invitee,
                    'church_branch_id' => $service->church_branch_id,
                ]);
            }

            $attendee_id = $visitor->id;
            $is_member = false;
        }

        // Check if attendance is already marked today for the main attendee
        $alreadyMarked = ChurchServiceAttendance::where('attendee_id', $attendee_id)
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($alreadyMarked) {
            return back()->with('error', 'Attendance has already been registered for today.');
        }

        // Record attendance for the main attendee
        ChurchServiceAttendance::create([
            'attendee_id' => $attendee_id,
            'date' => Carbon::now(),
            'is_member' => $is_member,
            'service_id' => $service->id,
            'church_id' => $request->church_id,
            'church_branch_id' => $service->church_branch_id,
        ]);

        return back()->with('status', 'Your attendance has been recorded successfully.');
    }

    public function service_attendance($id)
    {
        // Initialize counters
        $adultMaleCount = 0;
        $adultFemaleCount = 0;
        $childMaleCount = 0;
        $childFemaleCount = 0;
        $result = ChurchService::findOrFail($id);


        // Fetch all attendance records for the given service
        $attendances = ChurchServiceAttendance::where('service_id', $id)->get();

        foreach ($attendances as $attendance) {
            if ($attendance->is_member) {
                // Fetch attendee details from the members table
                $member = Member::find($attendance->attendee_id);

                if ($member) {
                    $age = Carbon::parse($member->dob)->age; // Assuming `dob` (date of birth) is in the `members` table
                    if ($age >= 18) {
                        if (strtolower($member->gender) == 'male') {
                            $adultMaleCount++;
                        } elseif (strtolower($member->gender) == 'female') {
                            $adultFemaleCount++;
                        }
                    } else {
                        if (strtolower($member->gender) == 'male') {
                            $childMaleCount++;
                        } elseif (strtolower($member->gender) == 'female') {
                            $childFemaleCount++;
                        }
                    }
                }
            } else {
                // Fetch attendee details from the visitors table
                $visitor = Visitor::find($attendance->attendee_id);

                if ($visitor) {
                    $age = Carbon::parse($visitor->dob)->age; // Assuming `dob` (date of birth) is in the `visitors` table
                    if ($age >= 18) {
                        if (strtolower($visitor->gender) == 'male') {
                            $adultMaleCount++;
                        } elseif (strtolower($visitor->gender) == 'female') {
                            $adultFemaleCount++;
                        }
                    } else {
                        if (strtolower($visitor->gender) == 'male') {
                            $childMaleCount++;
                        } elseif (strtolower($visitor->gender) == 'female') {
                            $childFemaleCount++;
                        }
                    }
                }
            }
        }

        // Return the counts as JSON for the modal
        return response()->json([
            'adult_male_count' => $adultMaleCount,
            'adult_female_count' => $adultFemaleCount,
            'child_male_count' => $childMaleCount,
            'child_female_count' => $childFemaleCount,
            'service_name'=> $result->name,
            'service_id' =>$result->id,
        ]);
    }

}
