<?php  if(isset($_POST['update']))
{
include 'scripthead.php';
    
    
$uid=$_POST['id'];  
$email=$_POST['email'];
//$user_email=filter_var($user_email, FILTER_SANITIZE_EMAIL);
$name=$_POST['name'];
//var_dump($uid); 
// var_dump($name);
//var_dump($email); 
   
   
$sql1="UPDATE users SET email='$email', name='$name' where id='$uid'";
$update_admin = mysqli_query($conn,"UPDATE `users` SET name='".$name."', email='".$email."' WHERE id='".$uid."'");
if($update_admin){
    ?>
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Details Updated",
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
} else {
 echo "button is not pressed ";
 echo"<script>  
window.location = 'dashboard.php';
</script>"; 

}
?>
</body>
</html>