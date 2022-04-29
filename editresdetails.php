<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>

<style>
    .row li {
        width: 33.3%;
        float: left;
    }

    img {
        border: 0 none;
        display: inline-block;

        max-width: 100%;
        vertical-align: middle;
    }
    .form-container{
        margin-left:5px;
        margin-top:10px;
    }

    .input-files input[type=file]{
        display:block;
        border:1px solid #eeeeee;
        position:relative;
        margin-bottom:5px;
        width:250px;
    }
    .add-more-cont{margin:10px 0px 10px 0px;}

    #add_more{
        font-size:13px;
        color:blue;
    }

    #add_more:hover{
        cursor:pointer;
    }
    .error-msg{
        background-color:#f2dede;
        border:1px solid #ebccd1;
        font-size:14px;
        color:#a94442;
        width:350px;
        padding:4px;
        margin-bottom:5px;
    }
    .success-msg{
        background-color:#dff0d8;
        border:1px solid #d6e9c6;
        font-size:14px;
        color:#3c763d;
        width:350px;
        padding:4px;
        margin-bottom:5px;
    }div.show-image {
        position: relative;
        float:left;
        margin:5px;
        height:50%;
    }
    div.show-image:hover img{
        opacity:0.5;
    }
    div.show-image:hover input {
        display: block;
    }
    div.show-image input {
        position:absolute;
        display:none;
    }
    div.show-image input.update {
        top:0;
        left:0;
    }
    div.show-image input.delete {
        top:0;
        left:79%;
    }



</style>












<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Restaurant Settings</h3>
            </div>


        </div>

        <div class="clearfix"></div>
        <br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> Restaurant Details</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">




                        <?php
                        $sql = "SELECT  *  FROM `res_details` ";
                        $check = mysqli_query($conn, $sql);
                        //var_dump($check);
                        $rowcount = mysqli_num_rows($check);
                        $row = mysqli_fetch_array($check, MYSQLI_BOTH);



                        $editimages = "SELECT * FROM res_images where res_id='" . $row['id'] . "'";
                        $getproductimages = mysqli_query($conn, $editimages);
                        $imagecounter = mysqli_num_rows($getproductimages);



                        $editimageshandel = "SELECT imagehandel FROM app_details";
                        $gethandel = mysqli_query($conn, $editimageshandel);
                        $resulthandel = mysqli_fetch_array($gethandel, MYSQLI_ASSOC);
                        $imagehandel = $resulthandel['imagehandel'];
                        ?>


                        <div class="modal-body">




                            <form class="forms-sample" method="POST" action="updateresdetails.php" enctype="multipart/form-data">
                                <div class="form-group">

                                    <label for="exampleInputEmail1">Restaurant Name</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add name of your restaurant."></i>
                                    <input type="text" class="form-control p-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Restaurant Name" name="resname" value="<?php echo $row['resname']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Restaurant Address</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add address of your restaurant."></i>
                                    <input type="text" class="form-control p-input" id="exampleInputPassword1" placeholder="Enter Restaurant Address" name="resaddress" value="<?php echo $row['resaddress']; ?>">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Restaurant Description</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add description of your restaurant."></i>

                                    <textarea name="editor1" id="editor1" rows="10" cols="80" required>
                                        <?php echo $row['resdes']; ?>	
                                    </textarea>
                                    <script src="ckeditor/ckeditor.js"></script>
                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.

                                        CKEDITOR.replace('editor1');
                                    </script>
                                </div>



                                <div class="form-group">




                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone No</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add phone no. of your restaurant."></i>
                                        <input type="text" class="form-control p-input" id="exampleInputEmail1" placeholder="Enter Restaurant Phone No" name="resphone" required="required" value="<?php echo $row['resphone']; ?>">
                                    </div>



                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Operational Hours</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add opening-closing time of your restaurant."></i>
                                        <input type="text" class="form-control p-input" id="exampleInputEmail1" placeholder="Enter Restaurant operational hours" name="resop" required="required" value="<?php echo $row['resop']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Latitude</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add latitude of your restaurant."></i>
                                        <input type="text" class="form-control p-input" id="txtlat" placeholder="Enter Restaurant Latitude" name="reslat" required="required" oninput="ValidateLat()"  onkeypress="return isFloatNumber(this, event)" value="<?php echo $row['reslat']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Longitude</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add longitude of your restaurant."></i>
                                        <input type="text" class="form-control p-input" id="txtlon" placeholder="Enter Restaurant Longitude" name="reslong" required="required" oninput="ValidateLon()"  onkeypress="return isFloatNumber(this, event)" value="<?php echo $row['reslong']; ?>">
                                        <p style="float: right"><a target="_blank" href="http://www.mapcoordinates.net/en">COORDINATE PICKER</a></p>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Website</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add website of your restaurant."></i>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Restaurant Website" name="resweb" required="required" value="<?php echo $row['resweb']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Current Images:</label><br>
                                        <?php if ($imagecounter == 0) { ?>
                                            <br><div class="bs-example" data-example-id="simple-jumbotron">
                                                <div class="jumbotron">
                                                    <h4>Please add at least one image </h4>
                                                    <p>If you do not add any image then layout will not look good in your app.</p>
                                                </div>
                                            </div>


                                            <div class="form-group"><br>

                                                <br>

                                                <label for="exampleInputFile">Restaurant Images</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add at least one image of your product."></i>
                                                <br>
                                                <div class="input-files1"><a class="fa fa-plus fa-4 btn btn-warning" aria-hidden="true"  id="moreImg">Add More Image</a></div>

                                                <br>
                                                <div class="input-files">

                                                    <input type="file" name="image_upload-1" >

                                                </div>
                                                <p class="help-block">Please upload GIf,JPG,Jpeg,BMP,PNG files only.</p>



                                                <div class="modal-footer">

                                                    <input type="submit" value="Update Restaurant Details" class="btn btn-primary mr-2" name="update">
                                                </div>


                                                </form>       <?php } else { ?>



                                                <?php
                                                foreach ($getproductimages as $files) {
                                                    $id = $files['id'];
                                                    $image = $files['image'];
                                                    echo '<div class="show-image"><img src="' . $image . '" width="100" height="200">';
                                                    echo '<input type="hidden" value="' . $image . '" name="delete_file" />';
                                                    //var_dump($files);
                                                    echo '<input type="button" value="Delete image" onclick="delete_post(' . $id . ');" class="btn btn-sm btn-danger" /></div>';
                                                }
                                                ?>       
                                                <script>
                                                    function delete_post(id) {
                                                        m = confirm("Are you sure you want to delete this  image?");
                                                        if (m == true) {
                                                            $.post('resimagedelete.php', {post_id: id}, // Set your ajax file path
                                                                    function (data) {
                                                                        $('#yourDataContainer').html(data); // You can Use .load too
                                                                        swal({
                                                                            title: 'Image removed successfully',
                                                                            icon: 'success',
                                                                            timer: 1500
                                                                        })
                                                                        location.reload();
                                                                    });
                                                        } else {
                                                            return false;
                                                        }
                                                    }
                                                </script>
                                                <br>
                                                <?php if ($imagecounter < $imagehandel) { ?><br>
                                                    <br><br><br><br><br><br><br><br><div class="form-group"><br>

                                                        <br><br><br>

                                                        <label for="exampleInputFile">Product Images</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add at least one image of your product."></i>
                                                        <br>
                                                        <div class="input-files1"><a class="fa fa-plus fa-4 btn btn-warning" aria-hidden="true"  id="moreImg">Add More Image</a></div>

                                                        <br>
                                                        <div class="input-files">

                                                            <input type="file" name="image_upload-1" >

                                                        </div>
                                                        <p class="help-block">Please upload GIf,JPG,Jpeg,BMP,PNG files only.</p>

                                                    <?php
                                                    } else {
                                                        echo '<br><br><br><br><br><br><br><br><br><br><br><br><div class="form-group">';
                                                        ?>
                                                        <div class=" table-responsive alert alert-info alert-dismissible">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                            <h4><i class="icon fa fa-info"></i> You have used your image limit(<?php echo $imagehandel; ?>)/item. Please delete one to add a new one)</h4><div></div><input type="hidden" value="" name="image_upload-1" /><?php } ?>

                                                    </div>







                                                    <div class="modal-footer">

                                                        <input type="submit" value="Update Restaurant Details" class="btn btn-primary mr-2" name="update">
                                                    </div>


<?php } ?> 

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
                                                $(document).ready(function () {
                                                    var id = 1;
                                                    var high = "<?php echo $imagehandel; ?>";
                                                    var counter = "<?php echo $imagecounter; ?>";
                                                    var total = high - counter;
                                                    //alert(high);
                                                    $("#moreImg").click(function () {
                                                        var showId = ++id;
                                                        //alert(counter);
                                                        if (showId <= total)
                                                        {
                                                            $(".input-files").append('<br><input type="file" name="image_upload-' + showId + '">');
                                                        }
                                                    });
                                                });
</script> 

<script>
    function ValidateLat() {
        var lat = document.getElementById("txtlat").value;


        if (lat < -90 || lat > 90) {
            swal({
                title: "Please Review",
                text: "Latitude must be between -90 and 90 degrees inclusive.",
                icon: "warning",

            });
            return;
        } else if (lat == "") {
            swal({
                title: "Please Review",
                text: "Enter a valid Latitude or Longitude!",
                icon: "warning",

            });
            return;
        }
    }

    function ValidateLon() {
        var lng = document.getElementById("txtlon").value;


        if (lng < -180 || lng > 180) {
            swal({
                title: "Please Review",
                text: "Longitude must be between -180 and 180 degrees inclusive",
                icon: "warning",

            });
            return;
        } else if (lng == "") {
            swal({
                title: "Please Review",
                text: "Enter a valid Latitude or Longitude!",
                icon: "warning",

            });
            return;
        }
    }



    function isFloatNumber(item, evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46)
        {
            var regex = new RegExp(/\./g)
            var count = $(item).val().match(regex).length;
            if (count > 1)
            {


                swal({
                    title: "Please Review",
                    text: "Please enter valid Lat Long input only",
                    icon: "warning",

                });
                return false;
            }
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            swal({
                title: "Please Review",
                text: "Please enter valid Lat Long input only",
                icon: "warning",

            });
            return false;
        }
        return true;
    }

</script>  
<?php include_once'scriptfooter.php' ?>  


<script>

    $(document).ready(function () {
        $('#example').DataTable();
    });
 