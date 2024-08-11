<?php

   if(!function_exists('sendSMS')){
    function sendSMS($recepient,$sender_id,$message,$schedule_message=false, $delivery_date=null){

        // Handle Message Schedule if $schedule_message is true *requires delivery_date value, default vaule is null.
        switch ($schedule_message) {
            case 'true':
                $schedule_message=true;
                break;

            default:
                $schedule_message=false;
                break;
        }

        // Set Url endpoint for sending SMS
        $endPoint = 'https://api.mnotify.com/api/sms/quick';

        // Obtain API Key from Config
        $apiKey = config('sms.api_key');
        // Obtain Sender ID from Config
        $sender_id=$sender_id ?? config('sms.sender_id');
        // Build Url using Endpoint and Api Key for Authroization
        $url = $endPoint . '?key=' . $apiKey;
        // Build Message Body/Data
        $data = [
        'recipient' => ["$recepient"],
        'sender' => $sender_id,
        'message' => $message,
        'is_schedule' => $schedule_message,
        'schedule_date' => $delivery_date,
        ];

        // Start CURL and Send Messave via POST Request
        $response="Attempting to send SMS";
        try {

        $ch = curl_init();
        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        $result = json_decode($result, TRUE);
        curl_close($ch);

        $response="SMS Successfully Sent";

        } catch (\Throwable $th) {
            //throw $th;
            $response="Unable to send SMS";
        }

        return $response;
    }

   }
?>
