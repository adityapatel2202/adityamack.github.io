<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>





<?php
$pstatus='Available';
$sql = "SELECT * FROM `app_productsmain`  WHERE product_status='".$pstatus."' order by id DESC ";

$check = mysqli_query($conn, $sql);
$resultcheck = mysqli_fetch_array($check, MYSQLI_BOTH);
?><!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Push Notification Page</h3>
            </div>




        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Push Notification </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">


                    <br><center><h3>Choose Notification Type</h3>

                        <select id='purpose' class="form-control" title="Choose Type">
                            <option value="0">Select Option</option>
                            <option value="1">Simple Notification</option>
                            <option value="2">Custom Notification</option>

                        </select></br></br>

                    </center>

                    <div style='display:none;' id='simple'>

                        <div class="x_title">


                            <h3 class="box-title">Simple Notification Panel</h3>
                        </div>

                        <!-- form start -->
                        <form action="send.php?type=<?php echo base64_encode('simple'); ?>" method="post" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Title</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Title" name="title" required >
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Message</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" placeholder="Message"  name="msg" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Product</label>

                                <div class="col-sm-10">
                                    <select name="place"  class="form-control" data-live-search="true"   title="Choose here..." id="place" required >

                                        <?php foreach ($check as $pageid) { ?>



                                            <option value="<?php echo $pageid['product_id']; ?>" id="<?php echo $pageid['product_id']; ?>"><?php echo $pageid['product_name']; ?></option>



                                        <?php } ?></select></div></div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Image</label>

                                <div class="col-sm-10">

                                    <center><br><img id = "imm" src="complete-details-icon.png" height="200" width="150"> </center> <br> 
                                </div>
                            </div>

                            <div class="form-group">

                                <center>
                                    <input type="submit" class="btn btn-primary pull-right" value="Send Notification" name="simple">
                                </center>

                            </div>





                        </form></div>

                    <div style='display:none;' id='custom'>

                        <div class="x_title">
                            <h3 class="box-title">Custom Notification Panel</h3>

                        </div>
                        <!-- form start -->
                        <form class="form-horizontal" action="send.php?type=<?php echo base64_encode('custom'); ?>" method="post" enctype="multipart/form-data">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Title</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Title" name="title" required >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Message</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="Message"  name="msg" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Product</label>

                                    <div class="col-sm-10">
                                        <select name="place"  class="form-control" data-live-search="true"   title="Choose here..."id="place"  >
                                              <option value="">App Home</option>
                                            <?php foreach ($check as $pageid) { ?>


                                                
                                                <option value="<?php echo $pageid['product_id']; ?>" id="<?php echo $pageid['product_id']; ?>"><?php echo $pageid['product_name']; ?></option>



                                            <?php } ?></select></div></div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Choose Image</label>
                                    <input type="file" id="exampleInputFile" class="btn " name="catimg" required>


                                </div>



                                <div class="form-group">

                                    <div class="col-sm-10">
                                        <input type="submit" class="btn btn-primary pull-right" value="Send Notification" name="custom">
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
</div>

<?php include 'scriptfooter.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>





<script>$(document).ready(function () {
        $('#purpose').on('change', function () {

            if (this.value == '1')
            {
                $("#simple").show();
            } else
            {
                $("#simple").hide();
            }
            if (this.value == '2')
            {
                $("#custom").show();
            } else
            {
                $("#custom").hide();
            }
        });
    });</script> 




<script>
    $(document).ready(function () {
// code to get all records from table via select box
        $("#place").change(function () {
            var defaultvari = 'loading.gif'
            var id = $(this).find(":selected").val();
            var dataString = 'placeid=' + id;
            console.log(id);
            $.ajax({
                url: 'getimg.php',
                dataType: "json",
                data: dataString,
                cache: false,
                beforeSend: function () {
                    $('#imm').show();
                },
                success: function (d) {
//alert(d.image); //will alert ok
                    $('#imm').attr('src', d.image);
                    var imageurl = d.image;
                    $.post("send.php", {"imageurl": imageurl});
                    //alert(imageurl);
                }


            });
        })
    });

</script>





















