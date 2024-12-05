<?php

namespace App\Http\Controllers;

use App\Models\Convert;
use App\Models\CreditsAccount;
use App\Models\CreditsTransaction;
use App\Models\FollowUp;
use App\Models\Log;
use App\Models\Member;
use App\Models\Message;
use App\Models\Visitor;
use App\Notifications\FollowupNotification;
use Illuminate\Http\Request;
use App\Notifications\reminderNotification;


class FollowUpController extends Controller
{
    public function index()
    {
        $followUps = FollowUp::all();
        return view('follow-ups.index', compact('followUps'));
    }

    // Store a new follow-up
    public function store(Request $request)
    {
        $request->validate([
            'selectedId' => 'required',
            'follow_up_date' => 'required|date',
            'method' => 'required',
        ]);

        $user = Auth()->user();
        $account = CreditsAccount::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->first();
        $availableCredit = $account->balance;
        $senderID = $account->senderID;

        if ($request->origin == 'visitor')
        {
            $contact = Visitor::find($request->selectedId);
            $contact_type = 'visitor';
        }

        elseif($request->origin == 'convert')
        {
            $contact = Convert::find($request->selectedId);
            $contact_type = 'convert';
        }

        elseif($request->origin == 'member')
        {
            $contact = Member::find($request->selectedId);
            $contact_type = 'member';
        }

        $message = $request->input('message');

        if($request->method == 'sms')
        {
            $contactNumbers = $contact->phone;
            $subject =  'Follow-up';
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


            $sent = new Message;
            $sent->church_id =  $user->church_id;
            $sent->church_branch_id =  $user->church_branch_id;
            $sent->recipient = $contact->phone;
            $sent->message = $message;
            $sent->title = $subject;
            $sent->sender = $sender;
            $sent->credits = $creditsUsed;
            $sent->type = "quick";
            $sent->mode = "single";
            $sent->status = "sent";
            $sent->send_at = now();
            $sent->save();

            $followup = FollowUp::create([
                'method' => $request->method,
                'message' => $message,
                'contact_id' => $contact->id,
                'follow_up_date' =>$request->follow_up_date,
                'contact_type' => $contact_type,
                'status' => "followup",
                'church_id' => auth()->user()->church_id,
                'church_branch_id' => auth()->user()->church_branch_id,

            ]);

            $schdule=false;
            $delivery = null;


            foreach ($numbers as $phoneNumber) {
                try {
                    // Assuming ReminderNotification has a method to send SMS directly
                    (new reminderNotification($phoneNumber, $message, $senderID, $schdule, $delivery))->sendSMS();

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

        }

        elseif($request->method == 'phone')
        {
            $followup = FollowUp::create([
                'method' => $request->method,
                'message' => $message,
                'contact_id' => $contact->id,
                'follow_up_date' =>$request->follow_up_date,
                'contact_type' => $contact_type,
                'status' => "followup",
                'church_id' => auth()->user()->church_id,
                'church_branch_id' => auth()->user()->church_branch_id,
            ]);
        }

        elseif($request->method == 'email')
        {
            $followup = FollowUp::create([
                'method' => $request->method,
                'message' => $message,
                'contact_id' => $contact->id,
                'follow_up_date' =>$request->follow_up_date,
                'contact_type' => $contact_type,
                'status' => "followup",
                'church_id' => auth()->user()->church_id,
                'church_branch_id' => auth()->user()->church_branch_id,
            ]);

            $contact->notify(new FollowupNotification($followup));

        }

        //LOG
        $description = "User ". $user->id . " sent a followup message : ". $followup->id;
        $action = "SMS Sending";

        $log = Log::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'user_id' => $user->id,
            'action' => $action,
            'description' => $description,
        ]);

        return redirect()->back()->with('success', 'Follow-up sent successfully');
    }

    // View a specific follow-up
    public function show($id)
    {
        $result = FollowUp::find($id);
        return response()->json($result);
    }

    // Update a follow-up
    public function update(Request $request)
    {
        $request->validate([
            'notes' => 'required',
        ]);

        $followUp = FollowUp::findOrFail($request->selectedId);
        $followUp->notes = $request->notes;
        $followUp->save();

        return  redirect()->route('member.index')->with('success', 'Follow-up response updated successfully');
    }

    // Delete a follow-up
    public function destroy($id)
    {
        $followUp = FollowUp::findOrFail($id);
        $followUp->delete();
        return redirect()->route('follow-ups.index')->with('success', 'Follow-up deleted successfully');
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
}
