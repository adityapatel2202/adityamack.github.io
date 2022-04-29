<?php
//ini_set("include_path", '/home/mobilytb/php:' . ini_get("include_path") );
//// Pear Mail Library
//require_once "Mail.php";
include '../config.php';
///////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////GET POST DATA///////////////////////////////
        
        $user_email=$_POST['email'];
	$user_email=filter_var($user_email, FILTER_SANITIZE_EMAIL);
	
    
  
  
///////////////////////////////////////////////////////////////	
	if(!empty($user_email)){
             ///check for record///
            //var_dump($username);
            //var_dump($password);
            //var_dump($user_email);
            ////var_dump($name);
            //var_dump($id);
            
          $sql="SELECT `email`,`password`,`forgot` FROM `users` WHERE `email`='".$user_email."'";
         
          $check= mysqli_query($conn, $sql);
          $resultcheck= mysqli_fetch_array($check,MYSQLI_NUM);
          
          //var_dump($check);
         //var_dump($resultcheck);
          
          if($resultcheck!='')
          {
//          $password = $resultcheck['1'];
          //$name=$resultcheck['name'];
          $email=$resultcheck[0];
          $code=$resultcheck[2];
          //var_dump($code);
          //var_dump($email);
          //var_dump($code);
                    

          
if($email==$user_email){
    
require 'PHPMailer_5.2.0/class.phpmailer.php';
$link=$serveradd.'reset.php?passkey=' . $code .'&email='.$user_email;
$message = file_get_contents('emailheadreset.php');
$message .= '<tr style="margin: 0; padding: 0; box-sizing: border-box; font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; color: #8F9BB3; font-size: 14px; line-height: 22px;">
                    <td class="action" style="margin: 0; padding: 0; box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; color: #8F9BB3; font-size: 14px; line-height: 22px; vertical-align: top; padding-top: 20px;">
                      <a href="'.$link.'" class="btn-primary" style="line-height: 22px; margin: 0; box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px; padding: 20px; display: block; font-weight: bold; background: #96232D; border-radius: 3px; text-decoration: none; text-align: center;">Reset your password here</a>
                    </td>
                  </tr>';
                  $message .= file_get_contents('emailfoot.php');
	include 'mailconfig.php';
	$mail->Subject = "Reset Your Ecommerce Store App Password";
	$mail->AddAddress($user_email);
 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {

      $minfo = array("success"=>'true', "message"=>'Reset Instructions Sent to Your Mail');
      $jsondata = json_encode($minfo);
}

     }else{
      
       $minfo = array("success"=>'false', "message"=>'Account Not Found');
      $jsondata = json_encode($minfo);

	}
          }else {
           $minfo = array("success"=>'false', "message"=>'Account Not Found');
      $jsondata = json_encode($minfo);    
          }
            
            
            
        }else {
           $minfo = array("success"=>'false', "message"=>'Empty Mail');
      $jsondata = json_encode($minfo);    
          }
        
        
        print_r($jsondata);
        $conn->close();

?>     
