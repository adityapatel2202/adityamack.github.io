<?php 

class Fcm {
   
   
    //Define SendNotification function
    function sendNotification($dataArr) {
    	
$fcmApiKey = 'SERVER_KEY';//App API Key(This is google cloud messaging api key not web api key)

        $url = 'https://fcm.googleapis.com/fcm/send';//Google URL


unset($_SESSION['result']);
$registrationIds = $dataArr['device_id'];//Fcm Device ids array
 
    	$message = $dataArr['message'];//Message which you want to send
        $title = $dataArr['title'];
        $image=$dataArr['image'];
        $place_id=$dataArr['product_id'];
        $random_id=$dataArr['random_id'];
        // prepare the bundle
        $msg = array('message' => $message,'title' => $title,"image"=>$image,"product_id"=>$place_id,"random_id"=>$random_id);
        $fields = array('registration_ids' => $registrationIds,'data' => $msg);
 



        $headers = array(
            'Authorization: key=' . $fcmApiKey,
            'Content-Type: application/json'
        );
 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, $url );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);    

$_SESSION['result']=$result; 
        return $result;

    }    
    
    
    
    }
