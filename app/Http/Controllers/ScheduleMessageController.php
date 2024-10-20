<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Log;
use App\Models\ScheduledMessage;
use App\Models\Sender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ScheduleMessageController extends Controller
{
    public function scheduleMessage(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'group' => 'required|string',
            'delivery_date' => 'required|date',
        ]);

        $userID = Auth()->user()->id;

        $sender = Sender::where('id',$request->input('senderID'))->first();

        $group = Group::findOrFail($request->input('group'));
        $contacts = $group->contacts;

        $schduled = $request->delivery_date;

        $uniqueNumber = $this->generateRandomString();

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
                    'title' => $request->title,
                    'content' => $request->content,
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

    public function details($id)
    {
        $result = ScheduledMessage::find($id);
        return response()->json($result);
    }


    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ], [
            'senderID.required' => 'Provide Sender ID',
            'content.required' => 'State the purose for the Sender ID',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $id = $request->input('selectedId');
        $result = ScheduledMessage::findOrFail($id);
        $result->title = $request->title;
        $result->sender_id = $request->senderID;
        $result->content = $request->content;
        $result->send_at = $request->delivery_date;

        $result->save();

            //LOG
            $user = Auth::user()->id;
            $staff_no = User::where('id', $user)->value('name');
            $description = "User ". $staff_no . " modified a temmplate: ". $result->title . "(".  $result->id . ")";
            $action = "Update";

            $log = Log::create([
                'user_id' => $user,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('message.index')->with('success', 'Contact updated successfully.');

    }


    public function delete(Request $request)
    {
        $id = $request->input('selectedId');
        $result = ScheduledMessage::findOrFail($id);
        $result->delete();

            //LOG
            $user = Auth::user()->id;
            $staff_no = User::where('id', $user)->value('name');
            $description = "User ". $staff_no . " deleted a scheduled message: ". $result->title . "(".  $result->id . ")";
            $action = "Delete";

            $log = Log::create([
                'user_id' => $user,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->route('message.index')->with('success', 'Contact deleted successfully.');
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
