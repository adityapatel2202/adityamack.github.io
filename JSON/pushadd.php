<?php 
include '../config.php';

$accesstoken=$_POST['accesstoken'];

if(!empty($accesstoken))
{
$sql="INSERT INTO `devices` (`token`) VALUES ('".$accesstoken."')";
$check= mysqli_query($conn, $sql);
if($check==True);

{

$minfo = array("Success"=>'true', "Message"=>'Device Registered Sucessfully');
      $jsondata = json_encode($minfo);
}


}
else{
$minfo = array("Success"=>'flase', "Message"=>'Empty Accesstoken');
      $jsondata = json_encode($minfo);
}
print_r($jsondata);

mysqli_close($conn);
exit();