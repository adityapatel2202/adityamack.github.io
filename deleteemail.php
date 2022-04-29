<?php
include'scripthead.php';    
    
 $uid=$_GET['id'];
       $uid=base64_decode($uid); 
 
$sql="SELECT * FROM `users` WHERE id='".$uid."' ";
         
          $check= mysqli_query($conn, $sql);
          $faq= mysqli_fetch_array($check,MYSQLI_BOTH);
 $uidofuser=$faq['uid'];  

$update_admin = mysqli_query($conn,"DELETE FROM  `users`  WHERE id='".$uid."'");
$update_admin1 = mysqli_query($conn,"DELETE FROM  `users_profile`  WHERE uid='".$uidofuser."'");
$update_admin1 = mysqli_query($conn,"DELETE FROM  `users_wishlist`  WHERE uid='".$uidofuser."'");
$update_admin1 = mysqli_query($conn,"DELETE FROM  `users_cart`  WHERE uid='".$uidofuser."'");
$update_admin1 = mysqli_query($conn,"DELETE FROM  `cart_extra`  WHERE uid='".$uidofuser."'");
if($update_admin){
    ?>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Record Deleted",
  text: "Successfully",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href = "emailusers.php";
//console.log('The Ok Button was clicked.');
});
</script>

      <?php
               } else {
                            
                     echo 'query fail';
                     echo"<script>  
window.location = 'emailusers.php';
</script>";
                        
                        }
   exit();

?>