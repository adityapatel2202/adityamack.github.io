<?php include_once 'scripthead.php';?>
<?php include_once 'sidebar.php';?>
<?php include_once 'tophead.php';?>


 
     
  <!-- page content -->
        <div class="right_col" role="main" style="min-height: 648px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Orders</h3>
              </div>

              
            </div>

            <div class="clearfix"></div>
<br>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Orders List</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
<table id="employee_data" class="table table-bordered table-responsive">
                <thead>
                <tr>
                  
                   <th>Order-Id</th>
                  
                  <th class="col-md-3">Address</th>
                  <th>Phone</th>
                  <th >Date</th>
                  <th >Status</th>
                  <th>View</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  </tr>
</thead>
 
   <?php
          $sql="SELECT * FROM `users_orders` order by id DESC ";
         
          $check= mysqli_query($conn, $sql);
          ?>
          
          
 <?php 
 
 foreach($check as $faq){?>
 
 <?php echo'
 <tr>
  <td>'.$faq['order_id'].'</td>
  <td class="col-md-3"> '.$faq['address'].'</td>
                   <td> '.$faq['phone'].'</td>
                   <td class="col-md-3"> '.$faq['order_date'].'</td>
<td class="col-md-3">'; if( $faq['order_status']=='In-Processing'){

echo '<div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-primary" style="width: 10%"></div>
                    </div>
                      
                    </div>
                    <br> '.$faq['order_status'].''; }elseif( $faq['order_status']=='Dispatch'){

 
 echo'<div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-warning" style="width: 80%"></div>
                    </div>
                    <br> '.$faq['order_status'].'';
 
 }elseif($faq['order_status']=='Complete'){

echo'<div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                      
                    </div>
                    <br> '.$faq['order_status'].'';

 }elseif( $faq['order_status']=='Cancel'){ 

echo '<div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: 100%"></div>
                      
                    </div>
                    <br> '.$faq['order_status'].'';}
                   
      echo '<td><a href="vieworderdetails.php?id= '.base64_encode($faq['id']).'"><span class="label"><button class=" btn btn-primary">View <i class="fa fa-eye" aria-hidden="true"></i></button></a>  </td> 


<td><a href="orderstatusdetails.php?id= '.base64_encode( $faq['id']).'"><span class="label"><button class=" btn btn-success" >Edit</button></a>  </td>   


<td><a href="deleteorderdetails.php?id= '.base64_encode( $faq['id']).'"><span class="label"><button class=" btn btn-danger" onClick="return checkDelete()">Delete <i class="fa fa-trash" aria-hidden="true"></i></button></a>  </td>               
               

                                  
                               </span></td> </tr>';
                               ?>             
<?php }?>

 
 
 
 
 
 
  </tbody></table></center>
                    </div></div>
</div>

 <?php include 'scriptfooter.php'; ?>
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({ 
   "scrollX": true,
   'paging'      : true,
    "processing": true,
    'searching'   : true, 
    'ordering'    : true,
'order': [[ 3, "desc" ]],
      'info'        : true,
      'autoWidth'   : false,  
 'responsive': true 
   });  
 });  
 </script> 
 