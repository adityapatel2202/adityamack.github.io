<?php 
include '../config.php';
$passkey = $_GET['passkey'];
$user_email=$_GET['email'];

//var_dump($user_email);
//var_dump($passkey);
//exit();
 if(isset($_POST['submitbtn'])){
     //var_dump($_POST);
     $newpass=$_POST['newpass'];
     $confirm=$_POST['password'];
     
     if(!empty($newpass) && !empty($confirm))
     {
         
         
       $checksql="SELECT * FROM `users` WHERE `forgot`='$passkey'";
       
$resultcheck=mysqli_query($conn,$checksql) or die(mysqli_error());

$datacheck= mysqli_fetch_array($resultcheck,MYSQLI_ASSOC);

//var_dump($datacheck);

if($datacheck['forgot']==$passkey)
{
        if($newpass==$confirm)
         {
             $codenew=md5(uniqid(rand()));
             $sql = "UPDATE `users` SET `forgot`='".$codenew."', `password`='".$confirm."' WHERE forgot='$passkey' AND email='$user_email'";
//var_dump($sql);

$result = mysqli_query($conn,$sql) or die(mysqli_error());
         
if($result)
{
  echo'<script>alert("Password Updated Successfully")</script>';
  echo"<script>  
window.location = 'resetthank.html';
</script>"; 
exit();
}
        }else ?> <?php
         {
            echo'<script>alert("Password did not match")</script>';
          
         }
 } else {
     echo '<script> alert("Access code expired ")</script>';
       echo"<script>  
window.location = 'resetfail.html';
</script>";
 }
     }else
{ echo'<script>alert("Empty password not allowed")</script>';
echo"<script>  
window.location = 'resetfail.html';
</script>";
   
}
 } else {
 echo'<script>alert("Unauthorized access not allowed ")</script>'; 
 echo"<script>  
window.location = 'resetfail.html';
</script>";
}
 
?>