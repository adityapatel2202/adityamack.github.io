<?php 

include '../config.php';

/////////////////////////////////////////////////GET POST DATA///////////////////////////////
 $user_id=$_POST['user_id'];
 
//////////////////////////////////////////FETCHING DATA ////////////////////////////
if(!empty($user_id)){


$sql="SELECT * FROM `users` WHERE `id`='".$user_id."'";
$check= mysqli_query($conn, $sql);
$rowcountuser=mysqli_num_rows($check);
          $resultcheck= mysqli_fetch_array($check,MYSQLI_BOTH);
$uid=$resultcheck['uid'];
$user_email=$resultcheck['email'];
$status=$resultcheck['status'];
$name=$resultcheck['name'];
if($rowcountuser>0){
if($status=='ACTIVE'){
$sql="SELECT * FROM `users_profile` WHERE `uid`='".$uid."'";
$check= mysqli_query($conn, $sql);

foreach($check as $row){ 
 


$json=array("success"=>'true',"message"=>'verified',"name"=>$row['name'],"gender"=>$row['gender'],"mobile"=>$row['phone'],"city"=>$row['city'],"locality"=>$row['local'],"flat"=>$row['flat'],"pincode"=>$row['pincode'],"state"=>$row['state'],"landmark"=>$row['landmark'],"email"=>$user_email);

 
}
$jsondata = json_encode($json);  print_r($jsondata);  mysqli_close($conn); exit();

}else{$minfo = array("success"=>'false', "message"=>'please verify your mail ');
      $jsondata = json_encode($minfo); print_r($jsondata); mysqli_close($conn); exit();  }
}else{ $minfo = array("success"=>'false', "message"=>'user not registered');
      $jsondata = json_encode($minfo);  print_r($jsondata);  mysqli_close($conn); exit();  }
 
}else{  $minfo = array("success"=>'false', "message"=>'empty fields not allowed');
      $jsondata = json_encode($minfo); print_r($jsondata); mysqli_close($conn); exit(); }
 




