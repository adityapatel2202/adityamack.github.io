<?php
include '../config.php';
////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////GET POST DATA///////////////////////////////
        
        $user_email=$_POST['email'];
	
	
    
  
  
///////////////////////////////////////////////////////////////	
	if(!empty($user_email)){
            
            
          $sql="SELECT `email`,`com_code` FROM `users` WHERE `email`='".$user_email."'";
         
          $check= mysqli_query($conn, $sql);
         // var_dump($check);
          $num_rows = mysqli_num_rows($check);
          
          //var_dump($num_rows);
         
          
          $resultcheck= mysqli_fetch_array($check,MYSQLI_NUM);
          //var_dump($resultcheck);
         
          
          
          
          
          if($num_rows > 0)
          {
          
         
          
        $email=$resultcheck[0];
          $code=$resultcheck[1];
          
          
if($email=$user_email && $code!=''){
    require 'PHPMailer_5.2.0/class.phpmailer.php';
$link=$serveradd.'confirm.php?passkey=' . $code .'&email='.$user_email;
$message = file_get_contents('emailhead.php');
$message .= '<tr style="margin: 0; padding: 0; box-sizing: border-box; font-family:Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; color: #8F9BB3; font-size: 14px; line-height: 22px;">
                    <td class="action" style="margin: 0; padding: 0; box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; color: #8F9BB3; font-size: 14px; line-height: 22px; vertical-align: top; padding-top: 20px;">
                      <a href="'.$link.'" class="btn-primary" style="line-height: 22px; margin: 0; box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px; padding: 20px; display: block; font-weight: bold; background: #96232D; border-radius: 3px; text-decoration: none; text-align: center;">Confirm your email address</a>
                    </td>
                  </tr>';
	$message .= file_get_contents('emailfoot.php');
	include 'mailconfig.php';
	
	$mail->Subject = " Confirmation Email For Food Ordering App Demo";
	$mail->AddAddress($user_email);
 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {

      $minfo = array("success"=>'true', "message"=>'Account activation email sent successfully to your email address');
      $jsondata = json_encode($minfo);
}

	} else {
            
        
            $minfo = array("success"=>'true', "message"=>'Account already active. Please Signin.');
      $jsondata = json_encode($minfo); 
        }
          }else {
           $minfo = array("success"=>'false', "message"=>'Account not found. Please register');
      $jsondata = json_encode($minfo);    
          }
            
            
            
        }else {
           $minfo = array("success"=>'false', "message"=>'Empty email Field');
      $jsondata = json_encode($minfo);    
          }
        
        
        print_r($jsondata);
        $conn->close();

?>     
