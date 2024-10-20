<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Group;
use App\Models\Log;
use App\Models\ScheduledMessage;
use App\Models\Sender;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index()
    {
        $userID = Auth()->user()->id;
        $templates = Template::where('user_id', $userID)->get();
        $scheduled_message = ScheduledMessage::where('user_id', $userID)->get();
        $senderID = Sender::where('user_id', $userID)->get();
        $groups = Group::where('user_id', $userID)->get();

        return view ('message.index', compact('templates', 'senderID', 'groups', 'scheduled_message'));
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'senderID' => 'required|max:11',
            'purpose' => 'required',
        ], [
            'senderID.required' => 'Provide Sender ID',
            'senderID.max' => 'Sender name must not exceed 11 characters.',
            'purpose.required' => 'State the purose for the Sender ID',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $userId = Auth::user()->id;;
        $senderId = $request->senderID;
        $purpose = $request->purpose;

        $sender = Sender::create([
            'senderID' => $senderId,
            'purpose' => $purpose,
            'user_id' => $userId,
        ]);


            //LOG
            $user = Auth::user()->id;
            $staff_no = User::where('id', $user)->value('name');
            $description = "User ". $staff_no . " created a group:  ". $sender->name . "(".  $sender->id . ")";
            $action = "Create";

            $log = Log::create([
                'user_id' => $user,
                'action' => $action,
                'description' => $description,
            ]);

        return redirect()->route('dashboard')->with('success', 'Sender ID created successfully.');
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'senderID' => 'required|max:11',
            'title' => 'required',
        ], [
            'senderID.required' => 'Provide Sender ID',
            'senderID.max' => 'Sender name must not exceed 11 characters.',
            'purpose.required' => 'State the purose for the Sender ID',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $userID = Auth()->user()->id;

        $sender = Sender::where('id',$request->input('senderID'))->first();

        $template = Template::findOrFail($request->input('selectedId'));

        $group = Group::findOrFail($request->input('group'));
        $contacts = $group->contacts;

        $schduled = $request->delivery_date;
        $uniqueNumber = $this->generateRandomString();


        if ($schduled !== null) {

            $recipientString = '';

            foreach ($contacts as $contact) {
                $recipientString .= $contact->id . ', ';
            }

            $recipientString = rtrim($recipientString, ', ');
            // dd($recipientString);

                $scheduled_message = ScheduledMessage::create([
                    'user_id' => $userID,
                    'sender_id' => $request->senderID,
                    'batch' => $uniqueNumber,
                    'title' => $template->title,
                    'content' => $template->content,
                    'recipient' => $recipientString,
                    'send_at' => $schduled,
                ]);

            //LOG
            $staff_no = User::where('id', $userID)->value('name');
            $description = "User ". $staff_no . " scheduled a message:  ". $scheduled_message->title . "(".  $scheduled_message->id . ")";
            $action = "Schedule";

            $log = Log::create([
                'user_id' => $userID,
                'action' => $action,
                'description' => $description,
            ]);

            return redirect()->back()->with('success', 'Message scheduled successfully');
        }

        foreach ($contacts as $contact)
        {
            $messageContent = $template->content;
            $phone_number = $contact->phone_number;
            $senderID = $sender->senderID;
            $title = $template->title;
            $credit_used = '2';
                // Replace {{ first_name }} with the contact's first name
            if (strpos($messageContent, '{{ first_name }}') !== false) {
                $messageContent = str_replace('{{ first_name }}', $contact->first_name, $messageContent);
            }

            // Replace {{ last_name }} with the contact's last name
            if (strpos($messageContent, '{{ last_name }}') !== false) {
                $messageContent = str_replace('{{ last_name }}', $contact->last_name, $messageContent);
            }

            $sendSMS = sendSMS($phone_number,$senderID,$messageContent,$title,$credit_used);
        }

    }

    private function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 20; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
