<?php include_once 'scripthead.php';?>
<?php include_once 'sidebar.php';?>
<?php include_once 'tophead.php';?>

<?php 

$id=$_GET['id'];
$id= base64_decode($id);
//echo $id;

$editimageshandel="SELECT * FROM app_details";
$gethandel=mysqli_query($conn, $editimageshandel);
$resulthandel=mysqli_fetch_array($gethandel,MYSQLI_ASSOC);
$imagehandel=$resulthandel['rescurrency'];
$tax=$resulthandel['restax'];

$compney=$resulthandel['resname'];
$address=$resulthandel['resaddress'];
//var_dump($imagehandel);


$orderdetails="SELECT * FROM users_orders where id='".$id."'";
$orderquery=mysqli_query($conn, $orderdetails);
$orderdata=mysqli_fetch_array($orderquery);
//var_dump($orderdata);



$userdetails="SELECT * FROM users_profile where uid='".$orderdata['uid']."'";
$userquery=mysqli_query($conn, $userdetails);
$userdata=mysqli_fetch_array($userquery);
//var_dump($userdata);

$sqlwish="SELECT * FROM `ordered_varient` WHERE `order_id`='".$orderdata['order_id']."' ";
 $checkcart= mysqli_query($conn, $sqlwish);
$productdata=mysqli_fetch_array($checkcart);
//var_dump($productdata);



    if($imagehandel=='USD'){ $currency='$'; }else{$currency='₹';}
?> 



<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Orders</h3>
              </div>

              
            </div>

            <div class="clearfix"></div>
<br>
            <div class="row">
              
                  <div class="x_content">
 


<div class="x_panel">
                  <div class="x_title">
                    <h2>Invoice</h2>
                    
                      
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
<?php if($orderdata['order_status']=='Complete'){ echo '<center><h1>Order Completed</h1></center>';}
      
      if($orderdata['order_status']=='Cancel'){ echo '<center><h1>Order canceled</h1></center>';}?>
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                          <i class="fa fa-globe"></i>  <?php echo $compney;?>
                                          <small class="pull-right"><?php echo $orderdata['order_date'];?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          From
                           <address>
            <strong><?php echo $compney;?></strong><br>
           <?php echo $address;?>
          </address>                  </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          To
                          <address>
            <strong><?php echo $userdata['name'];?></strong><br>
            <?php echo $orderdata['address'];?><br>
            
            Phone: <?php echo $orderdata['phone'];?><br>
            Email: <?php echo $userdata['email'];?>
          </address>      
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Invoice #<?php echo $orderdata['order_id'];?></b><br>
          <br>
          <b>Order ID:</b> <?php echo $orderdata['order_id'];?><br>
          <b>Payment Status:</b><?php echo $orderdata['payment_status'];?> <br>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                                            
                                <th>Product</th>
                                <th >Image</th>  
                                <th>Varient-Name</th>                                                              
                               <th>Qty</th>
                               <th>Price</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $varientallprice = 0;
                              $sql = "SELECT * FROM `ordered_varient` WHERE `order_id`='" . $orderdata['order_id'] . "'";
                    $check = mysqli_query($conn, $sql);
                    while ($cart = mysqli_fetch_array($check)) { $varientallprice = $varientallprice + $cart['varient_price'];
$varientallprice=$varientallprice * $cart['varient_quantity']; ?>
                        
                    
                              
                              
                              <tr>
                                                 
                              <td><?php echo $cart['product_name'];?></td> 
                              <td><img src="<?php echo $cart['product_image'];?>" height="100" width="80"></td>                                      
                              <td><?php echo $cart['varient_name'];?></td>
                               <td><?php echo $cart['varient_quantity'];?></td>
                                <td><?php echo $currency.$cart['varient_price'];?></td>
                                </tr>
                               <?php  } ?>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>                                                      
                                <th>Product</th>
                                <th></th>
                                <th>Extra-Name</th>                                                              
                               <th>Qty</th>
                               <th>Price</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $extraprice = 0;
                              $sql = "SELECT * FROM `ordered_extra` WHERE `order_id`='" . $orderdata['order_id'] . "'";
                    $check = mysqli_query($conn, $sql);
                    while ($cart = mysqli_fetch_array($check)) {?>
                        
                    
                              
                              
                              <tr>
                                                     
                              <td><?php echo $cart['product_name'];?> </td>
                              <td>WITH</td>                             
                              <td><?php echo $cart['extra_name'];?></td>
                               <td><?php echo $cart['extra_quantity'];?></td>
                               <td><?php echo $currency.$cart['extra_price'];?></td>
                                </tr>
                               <?php   
                    $extraprice = $extraprice + $cart['extra_price'];} ?>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="col-xs-6">
          <p class="lead">Payment Methods: <?php echo $orderdata['paymentmode']; ?><?php if($orderdata['paymentmode']=='Stripe Payment-Gateway'){  ?></p>
           
          <img src="dist/img/credit/visa.png" alt="Visa">
          <img src="dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="dist/img/credit/american-express.png" alt="American Express">
          <img src="dist/img/credit/paypal2.png" alt="Paypal">

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
           <b>Payment TXN ID: <?php echo $orderdata['paymentref'];?></b>
          </p>
          <?php }elseif($orderdata['paymentmode']=='RazorPay Payment-Gateway'){ ?>
          
          <br><img src="razor.png" width="200">
           
           <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
           <b>Payment TXN ID: <?php echo $orderdata['paymentref'];?></b>
          </p>
          <?php }elseif($orderdata['paymentmode']=='Paypal Payment-Gateway'){ ?>
          
          <br><img src="paypal.png"  height="30" width="120">
           
           <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
           <b>Payment TXN ID: <?php echo $orderdata['paymentref'];?></b>
          </p>
          <?php }else{?>
          <br><img src="cod.png" alt="Visa" height="70" width="200">
           <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
           <b>Payment TXN ID: <?php echo $orderdata['paymentref'];?></b>
          </p>
          <?php }?>
        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                          <p class="lead"><?php echo $orderdata['order_date'];?></p>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td><?php echo $currency; echo $totalPrice=$varientallprice+$extraprice; ?></td>
                                </tr>
                                <tr>
                                  <th>Tax (<?php echo $orderdata['tax'];?>%)</th>
                                  <td><?php echo $tax1=$totalPrice * ($orderdata['tax'] / 100);?></td>
                                </tr>
                                <tr>
                                  <th>Shipping:</th>
                                  <td><?php echo $shipping=$orderdata['delivery'] ;?></td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td><?php echo $currency; echo $grand=$totalPrice+$tax1+$shipping;?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                     <div class="row no-print">
        <div class="col-xs-12">
<?php  if($orderdata['paymentmode']=='COD' && $orderdata['paymentref']=='COD' &&  $orderdata['order_status']=='In-Processing' || $orderdata['order_status']=='Complete' || $orderdata['order_status']=='Dispatch'  ){?>
          <a href="submitpayment.php?id=<?php echo base64_encode($id);?>" class="btn btn-success"><i class="fa fa-credit-card"></i> Submit payment</a>
<?php }elseif($orderdata['paymentmode']=='COD' && $orderdata['order_status']=='Cancel'){ ?><a class="btn btn-success" disabled><i class="fa fa-credit-card"></i> Submit payment</a><?php }?>
          
          <?php  if($orderdata['order_status']=='In-Processing'){?>
         
          <a href="updateorderdetails.php?id=<?php echo base64_encode($id);?>&case=<?php echo base64_encode('Dispatch');?>" class="btn btn-info pull-right" style="margin-right: 5px;">
            <i class="fa fa-paper-plane-o"></i> Dispatch
          </a>
          
          
           <a href="updateorderdetails.php?id=<?php echo base64_encode($id);?>&case=<?php echo base64_encode('Complete');?>" class="btn btn-success pull-right" style="margin-right: 5px;">
            <i class="fa fa-check"></i> Complete
          </a>
          
          
          
           <a href="updateorderdetails.php?id=<?php echo base64_encode($id);?>&case=<?php echo base64_encode('Cancel');?>" class="btn btn-danger pull-right" style="margin-right: 5px;">
            <i class="fa fa-times"></i> Cancel
          </a>
          
          <a   class="btn btn-primary pull-right" style="margin-right: 5px;" disabled>
            <i class="fa fa-download"></i> Generate Invoice
          </a>
          
          <?php }elseif($orderdata['order_status']=='Dispatch'){  ?>
          
          <a  class="btn btn-info pull-right" style="margin-right: 5px;" disabled>
            <i class="fa fa-paper-plane-o"></i> Dispatch
          </a>
          
          
           <a href="updateorderdetails.php?id=<?php echo base64_encode($id);?>&case=<?php echo base64_encode('Complete');?>" class="btn btn-success pull-right" style="margin-right: 5px;">
            <i class="fa fa-check"></i> Complete
          </a>
          
          
          
           <a href="updateorderdetails.php?id=<?php echo base64_encode($id);?>&case=<?php echo base64_encode('Cancel');?>" class="btn btn-danger pull-right" style="margin-right: 5px;">
            <i class="fa fa-times"></i> Cancel
          </a>
          
          <a  class="btn btn-primary pull-right" style="margin-right: 5px;" disabled>
            <i class="fa fa-download"></i> Generate Invoice
          </a>
          <?php }?>
          
          
          <?php if($orderdata['order_status']=='Complete'){  ?>
          
          <a  class="btn btn-info pull-right" style="margin-right: 5px;" disabled>
            <i class="fa fa-paper-plane-o"></i> Dispatch
          </a>
          
          
           <a class="btn btn-success pull-right" style="margin-right: 5px;" disabled>
            <i class="fa fa-check"></i> Complete
          </a>
          
          
          
           <a class="btn btn-danger pull-right" style="margin-right: 5px;" disabled>
            <i class="fa fa-times"></i> Cancel
          </a>
          
          <a  href="invoice-print.php?id=<?php echo base64_encode($id);?>" class="btn btn-primary pull-right" style="margin-right: 5px;" >
            <i class="fa fa-download"></i> Generate Invoice
          </a>
          
          <?php }?>
          
           <?php if($orderdata['order_status']=='Cancel'){  ?>
           <a  class="btn btn-info pull-right" style="margin-right: 5px;" disabled>
            <i class="fa fa-paper-plane-o"></i> Dispatch
          </a>
          
          
           <a class="btn btn-success pull-right" style="margin-right: 5px;" disabled>
            <i class="fa fa-check"></i> Complete
          </a>
          
          
          
           <a class="btn btn-danger pull-right" style="margin-right: 5px;" disabled>
            <i class="fa fa-times"></i> Cancel
          </a>
          
           <a  class="btn btn-primary pull-right" style="margin-right: 5px;" disabled>
            <i class="fa fa-download"></i> Generate Invoice
          </a>
           <?php }?>
          
           
          
        </div>
      </div>
                    </section>
                  </div>
                </div>















<?php include'scriptfooter.php';?>