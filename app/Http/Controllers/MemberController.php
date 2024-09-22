<?php

namespace App\Http\Controllers;

use App\Exports\MembersExport;
use App\Models\Church;
use App\Models\GroupLeader;
use App\Models\GroupMember;
use App\Models\Log;
use App\Models\Member;
use App\Models\Pastor;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public function index()
    {
        $user = Auth()->user();

        $role = $user->churchRole->role->name;

        if ($role === "Church_admin") {

            $members = Member::where('church_id', $user->church_id)->where('is_deleted', false)->get();
            $memberCount = Member::where('church_id', $user->church_id)->where('is_deleted', false)->count();
            $memberCountGender = Member::where('church_id', $user->church_id)
                ->select(
                    'gender',
                    DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) >= 18 THEN 1 ELSE 0 END) as count_18_and_above'),
                    DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) < 18 THEN 1 ELSE 0 END) as count_below_18')
                )
                ->groupBy('gender')
                ->get();
            $pastorCount = Pastor::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->count();
            $staffCount = Staff::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->count();
            $leaderCount = GroupLeader::distinct()->count('member_id');


        }elseif ($role === "Branch_admin") {
            $members = Member::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();
            $memberCount = Member::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->count();
            $memberCountGender = Member::where('church_id', $user->church_id)
                ->where('church_branch_id', $user->church_branch_id)
                ->select(
                    'gender',
                    DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) >= 18 THEN 1 ELSE 0 END) as count_18_and_above'),
                    DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) < 18 THEN 1 ELSE 0 END) as count_below_18')
                )
                ->groupBy('gender')
                ->get();

            $pastorCount = Pastor::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->count();
            $staffCount = Staff::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->count();
            $leaderCount = GroupLeader::distinct()->count('member_id');

        }else {

            $members = Member::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();
            $memberCount = Member::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->count();
            $memberCountGender = Member::where('church_id', $user->church_id)
                ->where('church_branch_id', $user->church_branch_id)
                ->select(
                    'gender',
                    DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) >= 18 THEN 1 ELSE 0 END) as count_18_and_above'),
                    DB::raw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, dob, CURDATE()) < 18 THEN 1 ELSE 0 END) as count_below_18')
                )
                ->groupBy('gender')
                ->get();

            $pastorCount = Pastor::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->count();
            $staffCount = Staff::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->count();
            $leaderCount = GroupLeader::distinct()->count('member_id');

        }

        return view ('member.index', compact('members', 'memberCount', 'pastorCount', 'leaderCount', 'staffCount' , 'memberCountGender'));
    }

    public function create(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Name is required',
            'gender.required' => 'State the gender',
            'dob.required' => 'Date of birth is required',
            'phone.required' => 'Provide a phone number',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }
        // dd($church->id);
        $input = $request->all();
        $input['church_id'] = $user->church_id;
        $input['church_branch_id'] = $user->church_branch_id;

        $input = Member::create($input);

            //LOG
            $description = "User ". $user->id . " created a member: ". $input->id ;
            $action = "Create";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->route('member.index')->with('success', 'Member created successfully.');
    }

    // public function view(Request $request, $id)
    // {
    //     $user = Auth()->user();
    //     $member = Member::find($id);

    //     $groups = GroupMember::where('member_id', $id)->count();
    //     $groupDetails = GroupMember::with('group')->where('member_id', $id)->get();

    //     return view('member.member_details', compact('member', 'groups', 'groupDetails'));
    // }


    public function details($id)
    {
        $result = Member::find($id);
        return response()->json($result);
    }

    public function update (Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Name is required',
            'gender.required' => 'State the gender',
            'dob.required' => 'Date of birth is required',
            'phone.required' => 'Provide a phone number',
        ]);


        $id = $request->input('selectedId');
        $result = Member::findOrFail($id);
        $result->name = $request->name;
        $result->gender = $request->gender;
        $result->dob = $request->dob;
        $result->phone = $request->phone;
        $result->address = $request->address;
        $result->location = $request->location;
        $result->email = $request->email;

        $result->save();

            //LOG
            $action = "Update";

            $description = "User ". $user->id . " modified a member: ". $result->id;
            $action = "Update";


            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('member.index')->with('success', 'Member updated successfully.');

    }

    public function delete(Request $request)
    {
        $user = Auth()->user();

        $id = $request->input('selectedId');
        $result = Member::findOrFail($id);
        $result->delete();

            //LOG
            $description = "User ". $user->id . " deleted a member: ". $result->id;
            $action = "Delete";

            $log = Log::create([
                'user_id' => $user->id,
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('member.index')->with('success', 'Member deleted successfully.');
    }

    public function export(Request $request)
    {

        //LOG
        $user = Auth()->user();

        $description = "User ". $user->id . " downloaded members data.";
        $action = "Download";

        $log = Log::create([
            'user_id' => $user->id,
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
        'action' => $action,
            'description' => $description,
        ]);

        return Excel::download(new MembersExport, 'members.xlsx');
    }

    public function searchMember(Request $request)
    {
        // dd($request);
        $user = Auth()->user();

        $query = $request->get('query');

        $member = Member::find($query);

        $groups = GroupMember::where('member_id', $query)->count();
        $groupDetails = GroupMember::with('group')->where('member_id', $query)->get();

        // dd($groupDetails);

        return view('member.member_details', compact('member', 'groups', 'groupDetails'));
    }

    public function uploadImage(Request $request)
    {
        $path = 'files/';
        if (!File::exists(public_path($path))) {
             File::makeDirectory(public_path($path),0777,true);
        }
        $file = $request->file('file');
        $new_image_name = 'UIMG'.date('Ymd').uniqid().'.jpg';
        $upload = $file->move(public_path($path), $new_image_name);
        if($upload){
            return response()->json(['status'=>1, 'msg'=>'Image has been cropped successfully.', 'name'=>$new_image_name]);
        }else{
              return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);
        }
    }

}
