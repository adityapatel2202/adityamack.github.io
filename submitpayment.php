<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>
   
<?php 

$id=$_GET['id'];
$id= base64_decode($id);
//echo $id;

$paid='succeeded';
$paymentref='Txn_'.uniqid(mt_rand(),true);


 $orderdetails="UPDATE users_orders SET payment_status='".$paid."',paymentref='".$paymentref."' where id='".$id."' AND paymentmode='COD'";
$orderquery=mysqli_query($conn, $orderdetails);

if($orderquery==TRUE)
{
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Payment received ",
  text: "order status changed to Paid",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href="orderstatusdetails.php?id=<?php echo base64_encode($id);?>";
//console.log('The Ok Button was clicked.');
});
</script>
<?php }else{ ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
   title: "Payment received fail ",
  text: "order status changed to UnPaid",
  icon: "error",button: "close"
}).then(function() {
// Redirect the user
window.location.href="orderstatusdetails.php?id=<?php echo base64_encode($id);?>";
//console.log('The Ok Button was clicked.');
});
</script>
<?php } ?>
 