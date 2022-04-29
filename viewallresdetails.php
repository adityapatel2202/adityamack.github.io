<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>
<!-- page content -->
<script language="JavaScript" type="text/javascript">
    function checkDelete() {
        return confirm('Are you sure you want to delete?');
    }
</script>
<?php
$sql = "SELECT  *  FROM `res_details` ";
$check = mysqli_query($conn, $sql);
//var_dump($check);
$rowcount = mysqli_num_rows($check);
$row = mysqli_fetch_array($check, MYSQLI_BOTH);




$editimages = "SELECT * FROM res_images where res_id='" . $row['id'] . "'";
$getproductimages = mysqli_query($conn, $editimages);
$imagecounter = mysqli_num_rows($getproductimages);
?>

<div class="right_col" role="main" style="min-height: 626px;">
    <div class="page-title">
        <div class="title_left">
            <h3>View Settings</h3>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="clearfix"></div>
            <a href="editresdetails.php" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Edit Settings</a>

            <div class="x_panel">

                <div class="x_content">


                    <table id="employee_data" class="table table-bordered table-hover">


                        <tr>
                        <label for="exampleInputEmail1">Restaurant Name</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add name of your restaurant."></i>
                        <input type="text" class="form-control p-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $row['resname']; ?>" name="resname" disabled=disabled>

                        </tr>
                        <tr>
                        <label for="exampleInputPassword1">Restaurant Address</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add address of your restaurant."></i>
                        <input type="text" class="form-control p-input" id="exampleInputPassword1" placeholder="<?php echo $row['resaddress']; ?>" disabled=disabled>  
                        </tr>
                        <tr>
                        <label for="exampleInputEmail1">Restaurant Description</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add description of your restaurant."></i>

                        <textarea name="editor1" id="editor1" rows="800" disabled=disabled>
                            <?php echo $row['resname']; ?> 	
                        </textarea>
                        <script src="ckeditor/ckeditor.js"></script>
                        <script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.

    CKEDITOR.replace('editor1');
                        </script>
                        </tr>
                        <tr>
                        <label for="exampleInputEmail1">Phone No</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add phone no. of your restaurant."></i>
                        <input type="text" class="form-control p-input" id="exampleInputEmail1" placeholder="<?php echo $row['resphone']; ?>" disabled=disabled>  
                        </tr>
                        <tr>

                        <label for="exampleInputEmail1">Operational Hours</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add opening-closing time of your restaurant."></i>
                        <input type="text" class="form-control p-input" id="exampleInputEmail1" placeholder="<?php echo $row['resop']; ?>" disabled=disabled>
                        </tr>

                        <label for="exampleInputEmail1">Latitude</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add latitude of your restaurant."></i>
                        <input type="text" class="form-control p-input" id="txtlat" placeholder="<?php echo $row['reslat']; ?>" disabled=disabled>

                        <tr>

                        <label for="exampleInputEmail1">Longitude</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add longitude of your restaurant."></i>
                        <input type="text" class="form-control p-input" id="txtlon" placeholder="<?php echo $row['reslong']; ?>" disabled=disabled>
                        <p style="float: right"><a target="_blank" href="http://www.mapcoordinates.net/en">COORDINATE PICKER</a></p>
                        </tr>


                        <tr>
                        <label for="exampleInputEmail1">Website</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add website of your restaurant."></i>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $row['resweb']; ?>" disabled=disabled>




                        <tr class="table-responsive">
                        <label>Current Images:</label><br>
                        <?php
                        foreach ($getproductimages as $files) {
                            $image = $files['image'];
                            ?>
                            <td><img src="<?php echo $image; ?>" width="50" height="70"></td>


                        <?php } ?>       
                        </tr>

                    </table>
                    <a href="editresdetails.php" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Edit Settings</a>
                    <a href="deleteresdetails.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-danger mr-2" onclick="return checkDelete()"><i class="fa fa fa-trash-o"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once'scriptfooter.php';
exit();
?>






