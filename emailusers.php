<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>











<?php
           $sql="SELECT * FROM `users` order by id DESC ";
         
          $check= mysqli_query($conn, $sql);?>




<div class="right_col" role="main" style="min-height: 1578.99px;">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Members Details Page</h3>
                </div>



            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>All Members </h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

<script language="JavaScript" type="text/javascript">
                            function checkDelete() {
                                return confirm('Are you sure you want to delete?');
                            }
                        </script>



                        <center><table id="employee_data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
<th>ID</th>
                                        <th>Name</th>
                  <th>Email</th>
                  <th >Status</th>
                  <th >Action</th>
                                    </tr></thead>
<?php          
while($faq= mysqli_fetch_array($check,MYSQLI_BOTH)) { ?>
                <tr>
                

                                   <td><?php echo $faq['id'];?></td>
<td><?php echo $faq['name'];?></td>
                  <td><?php echo $faq['email'];?></td>
                 

<td><?php if($faq['status']=="INACTIVE") { echo '<span class="badge bg-red">'.$faq['status']; }else{ echo '<span class="badge bg-green">'.$faq['status']; }?></td>

                  <td><a href="editemail.php?id=<?php echo base64_encode($faq['id']);?>"><button class=" btn btn-primary" >Edit<i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                  <a href="deleteemail.php?id=<?php echo base64_encode($faq['id']);?>"><button type="button" class="btn btn-primary" onClick="return checkDelete()" >Delete<i class="fa fa-trash-o" aria-hidden="true"></i></button></a></td>


 
 <?php  } ?>
               </tbody></table>
            
</table>


</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


<?php include_once'scriptfooter.php'; ?>
<script>  
 $(document).ready(function(){  
      $('#employee_data').DataTable({ 
   "scrollX": true,
   'paging'      : true,
    "processing": true,
    'searching'   : true, 
    'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
'responsive': true   
   });  
 });  
 </script> 
 