<?php 
include 'scripthead.php';

$id=$_GET['id'];
       $id=base64_decode($id); 
 
$orderdetails="SELECT * FROM users_orders where id='".$id."'";
$orderquery=mysqli_query($conn, $orderdetails);
$orderdata=mysqli_fetch_array($orderquery,MYSQLI_ASSOC);
$orderid=$orderdata['order_id'];

$orderdetails="Delete FROM users_orders where id='".$id."'";
$orderquery=mysqli_query($conn, $orderdetails);

$sqlwish="Delete  FROM `ordered_varient` WHERE `order_id`='".$orderid."' ";
 $checkcart= mysqli_query($conn, $sqlwish);

$sqlwish="Delete  FROM `ordered_varient` WHERE `order_id`='".$orderid."' ";
 $checkcart= mysqli_query($conn, $sqlwish);
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "order Deleted",
  text: "Successfully",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href = "orderlist.php";
//console.log('The Ok Button was clicked.');
});
</script>
