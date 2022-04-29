<?php include_once 'scripthead.php';?>
<?php include_once 'sidebar.php';?>
<?php include_once 'tophead.php';
$id=$_GET['id'];
$id= base64_decode($id);

$case=$_GET['case'];
$case= base64_decode($case);

$sqlwish="SELECT * FROM `users_orders` WHERE id='".$id."'";
 $checkcart= mysqli_query($conn, $sqlwish);
$rowcountcart=mysqli_num_rows($checkcart);
$cartiteams=mysqli_fetch_array($checkcart,MYSQLI_ASSOC);

$uid=$cartiteams['uid'];

 $sql="SELECT * FROM `users_profile` WHERE `uid`='".$uid."'";
$check= mysqli_query($conn, $sql);
$rowcount=mysqli_num_rows($check);
//echo $rowcount;
if($rowcount>0){
$resultcheck= mysqli_fetch_array($check,MYSQLI_BOTH);
$user_email=$resultcheck['email'];

$name=$resultcheck['name'];

}
$imgdispatch="shopping-image.png";
 $imgcomplete="complete.png";
 $imgcancel="cancel.png";
 
 $imgdispatch=$serverimg.$imgdispatch;
 $imgcomplete=$serverimg.$imgcomplete;
 $imgcancel=$serverimg.$imgcancel;



switch($case){


 case Dispatch:
 
 
 
 $orderdetails="UPDATE users_orders SET order_status='".$case."'where id='".$id."'";
$orderquery=mysqli_query($conn, $orderdetails);
 
 require 'JSON/PHPMailer_5.2.0/class.phpmailer.php';
 
$message .= '<center><hr><br><br>Hi '.ucfirst($name).',</h1><br><br>
 <img src="'.$imgdispatch.'"><br><br><br></td>
                  </tr>';
  $message .= file_get_contents('JSON/emailfoot.php');
    
    
   
                 
	include 'JSON/mailconfig.php';
	$mail->Subject = "Order Status Email For Food Ordering App Demo";
	$mail->AddAddress($user_email);

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {?>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Order dispatched ",
  text: "order status changed to dipatch ",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href="orderstatusdetails.php?id=<?php echo base64_encode($id);?>";
//console.log('The Ok Button was clicked.');
});
</script>

<?php }

break;
 
 
  case Complete:
  
 $orderdetails="UPDATE users_orders SET order_status='".$case."'where id='".$id."'";
$orderquery=mysqli_query($conn, $orderdetails);
 
 require 'JSON/PHPMailer_5.2.0/class.phpmailer.php';
 
 
$message .= '<center><hr><br><br>Hi '.ucfirst($name).',</h1><br><br>
 <img src="'.$imgcomplete.'"><br><br><br></td>
                  </tr>';
  $message .= file_get_contents('JSON/emailfoot.php');
    
    
   
                 
	include 'JSON/mailconfig.php';
	$mail->Subject = "Order Status Email For Food Ordering App Demo";
	$mail->AddAddress($user_email);

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
?>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Order complete ",
  text: "this order completed successfully",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href="orderstatusdetails.php?id=<?php echo base64_encode($id);?>"
//console.log('The Ok Button was clicked.');
});
</script>

<?php }
break;
 
 
  case Cancel:
 
 $orderdetails="UPDATE users_orders SET order_status='".$case."'where id='".$id."'";
$orderquery=mysqli_query($conn, $orderdetails);
 
 require 'JSON/PHPMailer_5.2.0/class.phpmailer.php';
 
 
$message .= '<center><hr><br><br>Hi '.ucfirst($name).',</h1><br><br>
 <img src="'.$imgcancel.'"><br><br><br></td>
                  </tr>';
  $message .= file_get_contents('JSON/emailfoot.php');
    
    
   
                 
	include 'JSON/mailconfig.php';
	$mail->Subject = "Order Status Email For Food Ordering App Demo";
	$mail->AddAddress($user_email);

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
?>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Order cancel ",
  text: "This order is canceled successfully",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href="orderstatusdetails.php?id=<?php echo base64_encode($id);?>";
//console.log('The Ok Button was clicked.');
});
</script>

<?php }
break;
 
 
 default:
       
echo'<script>window.location.href="orderstatusdetails.php?id=<?php echo base64_encode($id);?>";</script>';
}