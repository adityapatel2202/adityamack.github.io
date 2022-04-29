<?php include_once 'scripthead.php';?>
<?php include_once 'sidebar.php';?>
<?php include_once 'tophead.php';?>


 
     
  <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Categories</h3>
              </div>

              
            </div>

            <div class="clearfix"></div>
<br>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Category Details</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     
            
             <button class="btn btn-primary " class="pull-left" data-toggle="modal" data-target="#myModal">Add Category</button>
             <hr>
                 <br>
            <!--<h1>hello</h1>-->
            <?php
           $sql="SELECT * FROM `app_category` order by cat_id DESC ";
         
          $check= mysqli_query($conn, $sql);
          
          

 
 ?>


<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure you want to delete?');
}
</script>



              <table id="employee_data" class="table table-bordered table-hover">
                <thead>
                <tr>
                  
                  <th>Name</th>
                  <th>Image</th>
                  <th >Edit</th>
                   <th >Delete</th>
                </tr></thead>
   <?php            
while($k= mysqli_fetch_array($check,MYSQLI_BOTH)) {
                echo '<tr>
                

                                   <td><center>'.$k['category_name'].'</td>
                  <td><center><img src="'. $k['category_image'].'" height="100" width="100"></td>
                  <td><center><a href="editcategory.php?id='.base64_encode($k['cat_id']).'"><button class=" btn btn-primary btn-warning" ><i class="fa fa-pencil" aria-hidden="true"></i>Edit</button></a></td>
                  <td><center><a href="deletecategory.php?id='.base64_encode($k['cat_id']).'" class="btn btn-danger btn-lg " onClick="return checkDelete()" ><i class="fa fa fa-trash-o"></i></a></td> </tr>';




   }?>
               
              </tbody></table>
            </div></div></div></div></div>
</div></section>
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
      'autoWidth'   : false   
   });  
 });  
 </script> 
 

      
      
      <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Category</h4>
      </div>
      <div class="modal-body">
        
          <form role="form" action="add-cat.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Category Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Category Name" name="catname" required="required">
                </div>
                
                <div class="form-group">
                  <label for="exampleInputFile">Category Image</label>
                  <input type="file" id="exampleInputFile" name="catimg" required>

                  <p class="help-block">Please upload GIf,JPG,Jpeg,BMP,PNG files only.</p>
                </div>
                
              </div>
        
        
        
      
      <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Add Category" name="addcat">
      </form>
</div>
      </div>
    </div>

  </div>
</div>
      
      
      