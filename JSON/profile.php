<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>

<div class="right_col" role="main" style="min-height: 1886.99px;">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Admin Profile</h3>
            </div>


        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Admin Settings <small></small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view" src="<?php if(!empty($rowadmin['user_img'])){echo $rowadmin['user_img'];}else{ echo 'uploads/avatar.png';} ?>" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <h3><?php echo $rowadmin['name']; ?></h3>

                            <ul class="list-unstyled user_data">
                                <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $rowadmin['address']; ?> 
                                </li>

                                <li>
                                    <i class="fa fa-mobile user-profile-icon"></i> <?php echo $rowadmin['phone']; ?>
                                </li>


                            </ul>


                            <br>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <div class="profile_title">
                                <div class="col-md-6">
                                    <h2>Edit Admin Settings</h2>
                                </div>

                            </div>
                            <!-- start of user-activity-graph -->

                            <br>

                            <form method="POST"  class="form-horizontal form-label-left" enctype="multipart/form-data" action="updateadmin.php">


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" value="<?php echo $rowadmin['email']; ?>" name="email">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Full Name</label>
                                    <input type="text" class="form-control" value="<?php echo $rowadmin['name']; ?>" name="name">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <input type="text" class="form-control" value="<?php echo $rowadmin['address']; ?>" name="address">
                                </div>            

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" class="form-control" value="<?php echo $rowadmin['phone']; ?>" name="phone">
                                </div>             



                                <div class="form-group">
                                    <label for="exampleInputEmail1">Profile Picture</label>
                                    <input type="file"  name="catimg" >
                                </div>                






                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-success" value="Update Details" name="addcat">
                                    </form> </div>
                                <div class="ln_solid"></div>
                                <div class="pull-right"><button class="btn btn-primary " class="pull-right" data-toggle="modal" data-target="#myModal">Change Password</button></div>   










                                <!-- end of user-activity-graph -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include 'scriptfooter.php'; ?>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password Form </h4>
            </div>
            <div class="modal-body">

                <form   method="POST" action="updateadminpass.php" >
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Old Password</label>
                            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Enter Old Password" name="oldpass" required="required">
                        </div>
<br>
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Password</label>
                            <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Enter New Password" name="newpass" required="required">
                        </div>




<br>

                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Change Password" name="pass">
                            </form>
                        </div>
                    </div>
            </div>

        </div>
    </div>
</div>










