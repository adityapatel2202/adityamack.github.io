<?php
include 'scripthead.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //echo 'button pressed';
$oldpassinput=$_POST['oldpass'];
$newpass=$_POST['newpass'];
$oldpass=$rowadmin['password'];

if($oldpass==$oldpassinput)
{

$adminupdate= mysqli_query($conn,"UPDATE  app_admin SET password='".$newpass."'");
if($adminupdate){

?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Password Updated",
  text: "Successfully.Please login Again",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href = "logout.php";
//console.log('The Ok Button was clicked.');
});
</script>



<?php
}

}else{ ?>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Wrong Old Password",
  text: "please confirm your old password first",
  icon: "error",button: "close"
}).then(function() {
// Redirect the user
window.location.href = "profile.php";
//console.log('The Ok Button was clicked.');
});
</script>

<?php }

}

?>