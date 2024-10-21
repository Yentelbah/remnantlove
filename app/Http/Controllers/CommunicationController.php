<?php

namespace App\Http\Controllers;

use App\Models\CreditsAccount;
use App\Models\CreditsTransaction;
use App\Models\Group;
use App\Models\Log;
use App\Models\Member;
use App\Models\Message;
use App\Models\Pastor;
use App\Models\SenderID;
use App\Models\Staff;
use App\Models\Template;
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
        $sent_messages = Message::where('church_branch_id', $user->church_branch_id)->where('sender', $user->id)->orderBy('created_at', 'desc')->get();
        $credits = CreditsAccount::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->first();
        $groups = Group::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();

        $senderID = SenderID::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->get();
        $templates = Template::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->where('user_id', $user->id)->get();
        return view('messaging.index', compact('sent_messages','credits', 'groups','senderID', 'templates'));
    }

    public function sendSingle(Request $request)
    {
        $user = Auth()->user();
        $account = CreditsAccount::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->first();
        $availableCredit = $account->balance;
        $senderID = $account->senderID;

        $contactNumbers = $request->input('phone_number');
        $message = $request->input('message');
        $subject =  $request->input('title');
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

        if($request->schedule == 'schedule')
        {
            $schdule=true;
            $delivery = $request->delivery_date;
        }else{

            $schdule=false;
            $delivery = null;
        }


        $sent = new Message;
        $sent->church_id =  $user->church_id;
        $sent->church_branch_id =  $user->church_branch_id;
        $sent->recipient = $request->input('phone_number');
        $sent->content = $message;
        $sent->title = $subject;
        $sent->sender = $sender;
        $sent->credits = $creditsUsed;
        $sent->type = "quick";
        $sent->mode = "single";
        $sent->status = "sent";
        $sent->send_at = now();
        $sent->save();

        foreach ($numbers as $phoneNumber) {
            // $sendSMS = sendSMS($phoneNumber, $senderID , $message);
            try {
                // Assuming ReminderNotification has a method to send SMS directly
                (new reminderNotification($phoneNumber, $message, $senderID, $schdule, $delivery))->sendSMS();

                // Log success or perform other actions as needed
                // Log::info('SMS sent successfully to ' . $phone);
            } catch (\Exception $e) {
                // Handle notification sending failure
                return redirect()->back()->with('error', 'Failed to send notification: ' . $e->getMessage());
            }

        }

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

        // dd($request);
        $smsType = $request->type;

        if($smsType == 'custom')
        {
            $validator = Validator::make($request->all(), [
            'group' => 'required',
            'message' => 'required',
            'title' => 'required',
            ], [
                'group.required' => 'Choose a group',
                'title.required' => 'State state the title',
                'message.required' => 'Include a message',
            ]);


            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Check your inputs.');
            }
        }

        $group = $request->group;

        if ($group == "members")
        {
            $contacts = Member::where('is_deleted', false)
            ->where('church_id', $user->church_id)
            ->where('church_branch_id', $user->church_branch_id)
            ->whereRaw('LENGTH(phone) >= 9')
            ->distinct('phone')
            ->get();

            $group == "members";
            $contactNumbers = $contacts->count();
            $recipient = "Members: ";
        }

        elseif($group == "pastors")
        {
            $contacts = Pastor::join('members', 'members.id', '=', 'pastors.member_id')
            ->where('pastors.church_id', $user->church_id)
            ->where('pastors.church_branch_id', $user->church_branch_id)
            ->whereRaw('LENGTH(members.phone) >= 9')
            ->distinct()
            ->get();

            $group == "pastors";
            $contactNumbers = $contacts->count();
            $recipient = "Pastors: ";
        }

        elseif($group == "staff")
        {
            $contacts = Staff::join('members', 'members.id', '=', 'staff.member_id')
                ->where('staff.church_id', $user->church_id)
                ->where('staff.church_branch_id', $user->church_branch_id)
                ->whereRaw('LENGTH(members.phone) >= 9')
                ->distinct()
                ->get();


            $group == "staff";
            $contactNumbers = $contacts->count();
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
                ->get();

            $group = $groupContacts->name;
            $contactNumbers = $contacts->count();
            $recipient = "$group";
        };

        if($smsType == "template")
        {
            $template = Template::find($request->template_id);
            $messageContent = $template->content;
            $subject = $template->title;

            $maxLength = 160;
            $Length = strlen($messageContent);
            $numberOfPages = ceil($Length / $maxLength);
            $messageLenght = $numberOfPages;

        }
        else
        {

            $messageContent = $request->input('message');
            $subject =  $request->input('title');
            $messageLenght = $request->input('numberOfPages');

        }

        $message = $messageContent;

        $creditsUsed = $contactNumbers*$messageLenght;

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

        foreach ($contacts as $contact) {
            // Split the name by space
            $nameParts = explode(' ', $contact->name);

            // Extract first name and last name
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : ''; // Handle single name case

            if (strpos($message, '{{ first_name }}') !== false || strpos($message, '{{ last_name }}') !== false) {

                $personalizedMessage = str_replace(['{{ first_name }}', '{{ last_name }}'], [$firstName, $lastName], $message);
            } else {
                $personalizedMessage = $message;
            }

            if($request->schedule == 'schedule')
            {
                $schdule=true;
                $delivery = $request->delivery_date;
            }else{

                $schdule=false;
                $delivery = null;
            }

            $phoneNumber = $contact->phone;

            try {
                // Assuming ReminderNotification has a method to send SMS directly
                (new reminderNotification($phoneNumber, $personalizedMessage, $senderID, $schdule, $delivery))->sendSMS();

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
        $sent->recipient = $recipient . '('. $contactNumbers. ')';
        $sent->content = $message;
        $sent->title = $subject;
        $sent->sender = $user->id;
        $sent->credits = $creditsUsed;
        $sent->type = "bulk";
        $sent->mode = "bulk";
        $sent->send_at = now();
        $sent->status = "sent";


        $sent->save();

        CreditsTransaction::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'number_of_credits' =>$creditsUsed,
            'type' => "Decrease",
            'uniqueId' => $uniqueNumber
        ]);

        $description = "User ". $user->id . " sent a bulk message to " . $group. ". Message: ". $sent->id;
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
