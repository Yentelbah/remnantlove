<?php

namespace App\Http\Controllers;

use App\Models\CreditsAccount;
use App\Models\CreditsTransaction;
use App\Models\Group;
use App\Models\Log;
use App\Models\Member;
use App\Models\Message;
use App\Models\Pastor;
use App\Models\Staff;
use App\Notifications\reminderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommunicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth()->user();
        $role = $user->role;
        // dd($role);
        $sent_messages = Message::orderBy('created_at', 'desc')->take(7)->where('church_branch_id', $user->church_branch_id)->get();
        $credits = CreditsAccount::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->first();
        $groups = Group::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();
        return view('messaging.index', compact('sent_messages','credits', 'groups'));
    }

    public function sendSingle(Request $request)
    {
        $user = Auth()->user();
        $account = CreditsAccount::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->first();
        $availableCredit = $account->balance;
        $senderID = $account->senderID;

        $contactNumbers = $request->input('phone_number');
        $message = $request->input('message');
        $subject =  $request->input('subject');
        $sender =  $user->id;
        $messageLenght = $request->input('numberOfPages');
        $numbers = explode(', ', $contactNumbers);

        $count = count($numbers);
        $creditsUsed = $count*$messageLenght;

        if($availableCredit == 0 || $availableCredit < $creditsUsed){
            return redirect()->back()
            ->withInput()
            ->with('error', 'You do not have enough credits to send message');

        }else{
            $new_balance = $account->balance - $creditsUsed;
            $account->balance = $new_balance;
            $account->save();
        }

        $uniqueNumber = $this->uniqueNumber();

        foreach ($numbers as $phoneNumber) {
            // $sendSMS = sendSMS($phoneNumber, $senderID , $message);
            try {
                // Assuming ReminderNotification has a method to send SMS directly
                (new reminderNotification($phoneNumber, $message))->sendSMS();

                // Log success or perform other actions as needed
                // Log::info('SMS sent successfully to ' . $phone);
            } catch (\Exception $e) {
                // Handle notification sending failure
                return redirect()->back()->with('error', 'Failed to send notification: ' . $e->getMessage());
            }

        }

        $sent = new Message;
        $sent->church_id =  $user->church_id;
        $sent->church_branch_id =  $user->church_branch_id;
        $sent->recipient = $request->input('phone_number');
        $sent->message = $message;
        $sent->subject = $subject;
        $sent->sender = $sender;
        $sent->credits = $creditsUsed;
        $sent->type = "Single";
        $sent->save();

        CreditsTransaction::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'number_of_credits' =>$creditsUsed,
            'type' => "Decrease",
            'uniqueId' => $uniqueNumber
        ]);

        //LOG
        $description = "User ". $user->id . " sent a message : ". $sent->id;
        $action = "SMS Sending";

        $log = Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully.');
    }

    private function uniqueNumber()
    {
        $year = date('y');
        $month = date('m');
        $randomNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $newExeId = $year . $month . $randomNumber;
        $newNumber = $newExeId;
        return $newNumber;
    }

    public function sendBulk(Request $request)
    {
        $user = Auth()->user();

        $account = CreditsAccount::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->first();
        $availableCredit = $account->balance;
        $senderID = $account->senderID;

        $validator = Validator::make($request->all(), [
            'group' => 'required',
            'message' => 'required'
        ], [
            'group.required' => 'Choose a group',
            'message.required' => 'Ples provide a message',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Check your inputs.');
        }

        $group = $request->group;

        if ($group == "members")
        {
            $contacts = Member::where('is_deleted', false)
            ->where('church_id', $user->church_id)
            ->where('church_branch_id', $user->church_branch_id)
            ->whereRaw('LENGTH(phone) >= 9')
            ->distinct('phone')
            ->pluck('phone');

            $group == "members";
            $contactNumbers = str_replace(['[', ']', '"'], '', $contacts);
            $recipient = "Members: ";
        }

        elseif($group == "pastors")
        {
            $contacts = Pastor::join('members', 'members.id', '=', 'pastors.member_id')
            ->where('pastors.church_id', $user->church_id)
            ->where('pastors.church_branch_id', $user->church_branch_id)
            ->whereRaw('LENGTH(members.phone) >= 9')
            ->distinct()
            ->pluck('members.phone');

            $group == "pastors";
            $contactNumbers = str_replace(['[', ']', '"'], '', $contacts);
            $recipient = "Pastors: ";
        }

        elseif($group == "staff")
        {
            $contacts = Staff::join('members', 'members.id', '=', 'staff.member_id')
                ->where('staff.church_id', $user->church_id)
                ->where('staff.church_branch_id', $user->church_branch_id)
                ->whereRaw('LENGTH(members.phone) >= 9')
                ->distinct()
                ->pluck('members.phone');


            $group == "staff";
            $contactNumbers = str_replace(['[', ']', '"'], '', $contacts);
            $recipient = "Staff: ";
        }

        elseif($group != "pastors" && $group != "members" && $group != "staff")
        {

            $groupContacts = Group::find($group);
            $contacts = $groupContacts->members()
                ->leftJoin('members as m', 'group_members.member_id', '=', 'm.id')
                ->select('group_members.*', 'm.id', 'm.name', 'm.phone')
                ->where('m.church_id', $user->church_id)
                ->where('m.church_branch_id', $user->church_branch_id)
                ->whereRaw('LENGTH(m.phone) >= 9')
                ->distinct()
                ->pluck('m.phone');

            $group = $groupContacts->name;
            $contactNumbers = str_replace(['[', ']', '"'], '', $contacts);
            $recipient = "Suppliers: ";
        }

        $message = $request->input('message');
        $messageLenght = $request->input('numberOfPages');

        $numbers = explode(',', $contactNumbers);

        $count = count($numbers);

        $creditsUsed = $count*$messageLenght;

        if($availableCredit == 0 || $availableCredit < $creditsUsed){
            return redirect()->back()
            ->withInput()
            ->with('error', 'You do not have enough credits to send message');


        }else{
            $new_balance = $account->balance - $creditsUsed;
            $account->balance = $new_balance;
            $account->save();
        }

        $uniqueNumber = $this->uniqueNumber();

        foreach ($numbers as $phoneNumber) {
            // $sendSMS = sendSMS($phoneNumber, $senderID , $message);
            try {
                // Assuming ReminderNotification has a method to send SMS directly
                (new reminderNotification($phoneNumber, $message))->sendSMS();

                // Log success or perform other actions as needed
                // Log::info('SMS sent successfully to ' . $phone);
            } catch (\Exception $e) {
                // Handle notification sending failure
                return redirect()->back()->with('error', 'Failed to send notification: ' . $e->getMessage());
            }

        }

        $sent = new Message;
        $sent->church_id =  $user->church_id;
        $sent->church_branch_id =  $user->church_branch_id;
        $sent->recipient = $recipient . '('. $count. ')';
        $sent->message = $request->input('message');
        $sent->subject = $request->input('subject');
        $sent->sender = $user->id;
        $sent->credits = $creditsUsed;
        $sent->type = "Bulk";

        $sent->save();

        CreditsTransaction::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'number_of_credits' =>$creditsUsed,
            'type' => "Decrease",
            'uniqueId' => $uniqueNumber
        ]);

        $description = "User ". $user->id . " sent a bulk message : ". $sent->id;
        $action = "SMS Sending";

        $log = Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);


        return redirect()->route('sms.index')->with('success', 'Message sent successfully.');

    }

    public function getSentDetails($sentId)
    {
        $message = Message::find($sentId);
        return response()->json($message);
    }

    public function delete(Request $request)
    {
        $user = Auth()->user();

        $id = $request->input('selectedSentId');
        $sent = Message::find($id);
        $sent->delete();

        //LOG
        $description = "User ". $user->id . " deleted a sent message with ID" . $sent->id;
        $action = "Delete";

        $log = Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->route('sms.index')->with('success', 'Sent message deleted successfully.');
    }
}
