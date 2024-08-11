<?php

namespace App\Http\Controllers;

use App\Models\CreditsAccount;
use App\Models\CreditsPurchase;
use App\Models\CreditsTransaction;
use App\Models\Log;
use App\Models\SenderID;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreditsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function purchaseCredits(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'momo_trans_id' => 'required|unique:credits_purchases,transaction_id,'
        ], [
            'amount.required' => 'Choose an amount',
            'momo_trans_id.required' => 'Provide transaction ID after payment.',
            'momo_trans_id.uniques' => 'The transaction ID has been used already.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Check your inputs.');
        }

        $option = $request->amount;

            if ($option == 1)
            {
                $amount = "50";
                $credit = "1228";
            }
            elseif($option == 2)
            {
                $amount = "100";
                $credit = "2830";
            }
            elseif($option == 3)
            {
                $amount = "200";
                $credit = "5850";
            }
            elseif($option == 4)
            {
                $amount = "500";
                $credit = "14645";
            }
            elseif($option == 5)
            {
                $amount = "1000";
                $credit = "32714";
            }

        $transactionID = $request->momo_trans_id;
        $uniqueNumber = $this->uniqueNumber();
        $randomString =  $this->generateRandomString();

        CreditsPurchase::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'number_of_credits' =>$credit,
            'amount' =>$amount,
            'uniqueId' => $uniqueNumber,
            'transaction_id'=>$transactionID,
            'confirmation'=> $randomString
        ]);

        $senderID = "Yensoft";
        $phoneNumber="0545055050";
        $message = "SMS Credit request from FaithFlow. Confirmation Code: " . $randomString ;

        $sendSMS = sendSMS($phoneNumber, $senderID , $message);

        //LOG
            $description = "User ". $user->id . " purchased SMS credit" ;
            $action = "Purchase";

            $log = Log::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'user_id' => $user->id,
                'action' => $action,
                'description' => $description,
            ]);
            //LOG

        return redirect()->route('sms.index')->with('success', 'SMS credits request sent successfully, confirmation will be in the next 10 minutes.');
    }

    public function confirmation(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'code' => 'required'
        ], [
            'code.required' => 'Provide confirmation code sent to you.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Check your inputs.');
        }

        $code = $request->code;

        $purRequestID = CreditsPurchase::where(function ($query) use ($code) {
            $query->where('confirmation', $code);
        })->value('id');

        if($purRequestID == null){
        return redirect()->back()
        ->withErrors($validator)
        ->withInput()
        ->with('error', 'The code you provided is incorrect.');
        }else{

        $purRequest = CreditsPurchase::find($purRequestID);

        $credit = $purRequest->number_of_credits;
        $uniqueNumber = $purRequest->uniqueId;
        $pendingTransactionId = $purRequest->confirmation;
        $status = $purRequest->status;

        $confirmationTransactionID = $code;

            if($status === 'Confirmed')
            {
                return redirect()->back()->with('info', 'The request has been confirmed already.');
            }
         }

        // dd($confirmationTransactionID, $churchId);
        if ($confirmationTransactionID != $pendingTransactionId)
        {
            $purRequest->status = 'Hold';
            $purRequest->save();
            return redirect()->back()->with('error', 'The transaction ID provided is invalid, the request has been put on hold until payment is confirmed.');
        }

        $account = CreditsAccount::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->first();
        if($account == null){
            CreditsAccount::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'balance' =>$credit,
            ]);

        }else{
            $available = $account->balance;
            $new_balance = $available + $credit;
            $account->balance = $new_balance;
            $account->save();

        }

        $purRequest->status = 'Confirmed';
        $purRequest->save();

        CreditsTransaction::create([
            'church_id' => $user->church_id,
            'church_branch_id' => $user->church_branch_id,
            'number_of_credits' =>$credit,
            'type' => "Increase",
            'uniqueId' => $uniqueNumber
        ]);

        return redirect()->back()->with('success', 'SMS credits purchase payment confirmed. Credit top up is successful.');

    }

    public function getCreditRequestDetails($requestId)
    {
        $purRequest = CreditsPurchase::find($requestId);
        return response()->json($purRequest);
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

    private function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    public function updateSenderID(Request $request)
    {
        $user = Auth()->user();

        $validator = Validator::make($request->all(), [
            'sender_id' => 'required|max:11',
        ], [
            'sender_id.required' => 'Provide Sender ID',
            'sender_id.max' => 'Sender name must not exceed 11 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Some inputs are missing.');
        }

        $senderId = $request->sender_id;
        $purpose = 'For business transactions';
        $account = CreditsAccount::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->first();

        $oldSenderID = SenderID::where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->where('name', 'LIKE', "%$senderId%")->first();

        if($oldSenderID ==null){

            SenderID::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'name' => $senderId,
            ]);

            $account->senderID = $senderId;
            $account->save();

            $requestID = requestSenderID($senderId, $purpose);
        }else{

            $account->senderID = $senderId;
            $account->save();

            return redirect()->back()->with('success', 'SenderID updated successfully.');

        }

            //LOG
            $description = "User ". $user->id . " updated church SMS senderID";
            $action = "Update";

            $log = Log::create([
                'church_id' => $user->church_id,
                'church_branch_id' => $user->church_branch_id,
                'user_id' => $user->id,
                'action' => $action,
                'description' => $description,
            ]);


        return redirect()->back()->with('success', 'SenderID updated successfully and approval request sent. Messages can be sent after 20 minutes.');
    }

}
