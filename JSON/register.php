<?php
include '../config.php';
///////////////////////////////////////////////////////////////////////////////////////////




/////////////////////////////////////////////////GET POST DATA///////////////////////////////
        //$username = $_POST['username'];
        $user_email=$_POST['email'];
	$user_email=filter_var($user_email, FILTER_SANITIZE_EMAIL);
	$name=$_POST['name'];
        //$id= rand(100, 999);
        $com_code = md5(uniqid(rand()));
        $uid= md5(uniqid(rand()));   
         $cart_id= md5(uniqid(rand()));                                                                
        $forgot = md5(uniqid(rand()));
        $password=$_POST['password'];
$password=md5($password);
        $logintype=$_POST['logintype'];
///////////////////////////////////////////////////////////////	
	if(!empty($password) && !empty($user_email) && !empty($name)){
            if (strlen($_POST["password"]) <= '5') {
         $minfo = array("Success"=>'false', "Message"=>'Your password must contain at least 6 characters!');
      $jsondata = json_encode($minfo);
      print_r($jsondata);
    exit();}
             
            
          $sql="SELECT `email` FROM `users` WHERE `email`='".$user_email."'";
         
          $check= mysqli_query($conn, $sql);
          $resultcheck= mysqli_fetch_array($check,MYSQLI_BOTH);
$userid=$resultcheck['id'];
         
    
         
          
          if(!$resultcheck){
          
          
           
             
            $query = "INSERT INTO `users` (name,email,password,com_code,forgot,logintype,uid,cart_id) VALUES('".$name."','".$user_email."','".$password."','".$com_code."','".$forgot."','".$logintype."','".$uid."','".$cart_id."')";
           //var_dump($query);
            $resultinsert = mysqli_query($conn,$query) or die(mysqli_error($conn));
            //var_dump($resultinsert);
          $lastid=$conn->insert_id;
            

$query = "INSERT INTO `users_profile` (uid,email,name) VALUES('".$uid."','".$user_email."','".$name."')";
           //var_dump($query);
            $resultinsert = mysqli_query($conn,$query) or die(mysqli_error($conn));


             
            if($resultinsert)
                {require '../PHPMailer_5.2.0/class.phpmailer.php';
$link=$serveradd.'confirm.php?passkey=' . $com_code .'&email='.$user_email;
$message = file_get_contents('emailhead.php');
$message .= '
    <a href="'.$link.'" class="btn-primary" style="line-height: 22px; margin: 0; box-sizing: border-box; font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif; color: #ffffff; font-size: 18px; padding: 20px; display: block; font-weight: bold; background: #96232D; border-radius: 3px; text-decoration: none; text-align: center;">Confirm your email address</a>
                    </td>
                  </tr>';
                  $message .= file_get_contents('emailfoot.php');
	include 'mailconfig.php';
	$mail->Subject = "Confirmation Email For Food Ordering App Demo";
	$mail->AddAddress($user_email);

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    //echo "Message has been sent"
//echo "Your Confirmation link Has Been Sent To Your Email Address.";


      $minfo = array("success"=>'true', "message"=>'Account confimation email sent successfully to your email address',"userid"=>$lastid);
      $jsondata = json_encode($minfo);
}
                }else
{
 $minfo = array("success"=>'false', "message"=>'Failed to register. Please try again.');
      $jsondata = json_encode($minfo);

} 
            }else{
      
       $minfo = array("success"=>'false', "message"=>'E-Mail already exist. Please Signin');
      $jsondata = json_encode($minfo); 

	}
          }else
          {
            //echo 'QUERY FAILED';
             $minfo = array("success"=>'false', "message"=>'Empty field not allowed');
      $jsondata = json_encode($minfo);
            
        } 
            
        
        
        
        print_r($jsondata);
        $conn->close();

?>