<?php 
include '../config.php';


$passkey = $_GET['passkey'];
$user_email=$_GET['email'];
//var_dump($user_email);
//var_dump($passkey);

if(!empty($passkey) && !empty($user_email)){
                
  $query = "SELECT `email`,`com_code` FROM `users` WHERE `email`='".$user_email."' AND `com_code`='".$passkey."'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
                 $rowcount=mysqli_num_rows($result);
                 //var_dump($rowcount);
                 
                 if($rowcount > 0)
                 {
                $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
                //var_dump($rows);

if($rows)
{
               
                

$sql = "UPDATE users SET com_code=NULL, status='ACTIVE' WHERE com_code='$passkey' AND email='$user_email'";
//var_dump($sql);

$result = mysqli_query($conn,$sql) or die(mysqli_error());
//var_dump($result);
if($result)
{
 $minfo = array("success"=>'true', "message"=>'Your account activated');
      $jsondata = json_encode($minfo);
      header("location:thanks.html");
      }
      else
      {
      $minfo = array("success"=>'false', "message"=>'link expired! OR invalid activation code');
      $jsondata = json_encode($minfo);
      header("location:failcode.html");
      }
}
}else
{

 $minfo = array("success"=>'false', "message"=>'Account Activation Failed ');
      $jsondata = json_encode($minfo);
       header("location:failcode.html");
}


}else
{
    $minfo = array("success"=>'false', "message"=>'empty field found');
      $jsondata = json_encode($minfo);
                
} print_r($jsondata);
        $conn->close();  
           ?>