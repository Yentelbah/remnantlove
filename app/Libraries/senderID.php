<?php

   if(!function_exists('requestSenderID')){
    function requestSenderID($sender_name, $purpose,){

        $endPoint = 'https://api.mnotify.com/api/senderid/register';
        // Obtain API Key from Config
        $apiKey = config('sms.api_key');
        // Obtain Sender ID from Config
        $url = $endPoint . '?key=' . $apiKey;

        $data = [
        'sender_name' => $sender_name,
        'purpose' => $purpose,
        ];

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

        $response="Sender ID Successfully Registered";

        } catch (\Throwable $th) {
            //throw $th;
            $response="Unable to send request";
        }

        return $response;
    }
   }

?>
