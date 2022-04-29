<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>

<?php
       
       $uid=$_GET['id'];
       $uid=base64_decode($uid);
           $sql="SELECT * FROM `users` WHERE id='$uid' ";
         
          $check= mysqli_query($conn, $sql);
          $resultcheck= mysqli_fetch_array($check,MYSQLI_BOTH);
        

 
 
 

 ?>
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

<form class="form-horizontal" action="upemail.php" method="post">
              <div class="box-body">
                  <div class="form-group">
                  <input class='input' type='hidden' name='id' value="<?php echo $uid; ?>" />
                  </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email" value="<?php echo $resultcheck['email']; ?>" name="email" readonly="readonly">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputPassword3" placeholder="Name" value="<?php echo $resultcheck['name']; ?>" name="name">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <input type="submit" class="btn btn-default pull-right" value="Update" name="update">
               
              </div>
              <!-- /.box-footer -->
            </form>