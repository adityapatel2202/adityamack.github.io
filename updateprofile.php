<?php 

include '../config.php';
$userid=$_POST['user_id'];
$name=$_POST['name'];
$phone=$_POST['phone'];
$gender=$_POST['gender'];
$city=$_POST['city'];
$local=$_POST['local'];
$flat=$_POST['flat'];
$pin=$_POST['pincode'];
$state=$_POST['state'];
$land=$_POST['landmark'];



if(!empty($userid) && !empty($name) && !empty($phone) && !empty($gender) && !empty($city) && !empty($local) && !empty($flat) && !empty($pin) && !empty($state)){


$sql="SELECT * FROM `users` WHERE `id`='".$userid."'";
$check= mysqli_query($conn, $sql);
$rowcountuser=mysqli_num_rows($check);
          $resultcheck= mysqli_fetch_array($check,MYSQLI_BOTH);
$uid=$resultcheck['uid'];
$user_email=$resultcheck['email'];
$status=$resultcheck['status'];

$sqluser="SELECT * FROM `users_profile` WHERE `uid`='".$uid."'";
$checkuser= mysqli_query($conn, $sqluser);
$userdata=mysqli_fetch_array($checkuser,MYSQLI_BOTH);
$username=$userdata['name'];



if($rowcountuser>0){
if($status=='ACTIVE'){



 $sql="UPDATE `users_profile` SET name='".$name."',phone='".$phone."',city='".$city."',flat='".$flat."',landmark='".$land."',gender='".$gender."',pincode='".$pin."',local='".$local."',state='".$state."' WHERE `uid`='".$uid."'";
$check= mysqli_query($conn, $sql);


require_once '../PHPMailer_5.2.0/class.phpmailer.php';

$message .= '  <center>Hi '.strip_tags($username).',  <br><br>Your profile has been updated successfully for Ecommerce Store  App Demo.<br><br>Thanks for taking your time to update your profile.';
                  $message .= file_get_contents('emailfoot.php');
	include 'mailconfig.php';
	$mail->Subject = "Account Updatation Email For Ecommerce Store App Demo ";
	$mail->AddAddress($user_email);

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    //echo "Message has been sent"
//echo "Your Confirmation link Has Been Sent To Your Email Address.";


      $minfo = array("success"=>'true', "message"=>'Updation email sent successfully to your email address');
      $jsondata = json_encode($minfo); print_r($jsondata); mysqli_close($conn); exit();}




 
 
}else{ $minfo = array("success"=>'false', "message"=>'please verify your mail before using wishlist feature');
      $jsondata = json_encode($minfo); print_r($jsondata); mysqli_close($conn); exit();  }
}else{  $minfo = array("success"=>'false', "message"=>'user not registered');
      $jsondata = json_encode($minfo);  print_r($jsondata);  mysqli_close($conn); exit();}
 
}else{  $minfo = array("success"=>'false', "message"=>'empty fields not allowed');
      $jsondata = json_encode($minfo); print_r($jsondata); mysqli_close($conn); exit(); }
 