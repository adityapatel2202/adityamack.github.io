<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>
<style>
    #registration-step{margin:0;padding:0;}
    #registration-step li{list-style:none; float:left;padding:5px 10px;border-top:#EEE 1px solid;border-left:#EEE 1px solid;border-right:#EEE 1px solid;}
    #registration-step li.highlight{background-color:#EEE;}
    #registration-form{clear:both;border:1px #EEE solid;padding:20px;}
    .demoInputBox{padding: 10px;border: #F0F0F0 1px solid;border-radius: 4px;background-color: #FFF;width: 50%;}
    .registration-error{color:#FF0000; padding-left:15px;}
    .message {color: green;font-weight: bold;width: 100%;padding: 10;}
    .btnAction{padding: 5px 10px;background-color: #09F;border: 0;color: #FFF;cursor: pointer; margin-top:15px;}
</style>
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
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script>

    $(document).ready(function () {
        $("#next").click(function () {


            var current = $(".highlight");
            //alert (current);
            var next = $(".highlight").next("li");
            if (next.length > 0) {
                $("#" + current.attr("id") + "-field").hide();
                $("#" + next.attr("id") + "-field").show();
                $("#back").show();
                $("#finish").hide();
                $(".highlight").removeClass("highlight");
                next.addClass("highlight");
                if ($(".highlight").attr("id") == $("li").last().attr("id")) {
                    $("#next").hide();
                    $("#finish").show();
                }
            }

        });
        $("#back").click(function () {
            var current = $(".highlight");
            var prev = $(".highlight").prev("li");
            if (prev.length > 0) {
                $("#" + current.attr("id") + "-field").hide();
                $("#" + prev.attr("id") + "-field").show();
                $("#next").show();
                $("#finish").hide();
                $(".highlight").removeClass("highlight");
                prev.addClass("highlight");
                if ($(".highlight").attr("id") == $("li").first().attr("id")) {
                    $("#back").hide();
                }
            }
        });
    });
</script>
<?php
$id = $_GET['id'];
$id1 = $id;
$id = base64_decode($id);
//echo $id1;



$editimageshandel = "SELECT imagehandel FROM app_details";
$gethandel = mysqli_query($conn, $editimageshandel);
$resulthandel = mysqli_fetch_array($gethandel, MYSQLI_ASSOC);
$imagehandel = $resulthandel['imagehandel'];



$qry = "SELECT * FROM app_productsmain where id='" . $id . "'";
$res1 = mysqli_query($conn, $qry);
while ($records1 = mysqli_fetch_array($res1, MYSQLI_ASSOC)) {
    $product_id = $records1['product_id'];
    $product_des = $records1['description'];
    $product_des = htmlspecialchars_decode(str_replace("&quot;", "\"", $product_des));
    $product_name = $records1['product_name'];
    $product_status = $records1['product_status'];
    $product_date = $records1['date'];
    $product_limit = $records1['plimit'];
    $product_image_primary = $records1['primary_image'];
//echo $product_id .$product_image_primary;
    $qry_image = "select * from product_images where product_id ='" . $product_id . "'";
    $res_image = mysqli_query($conn, $qry_image);
    $imagecounter = mysqli_num_rows($res_image);
    $json = array();

    while ($records_image = mysqli_fetch_array($res_image)) {
        $jsonim[] = $records_image;
        $product_image = $serverimg . $records_image['image'];
        $json[] = $product_image;
    }


    $qry_var = "select * from products_variant where product_id ='" . $product_id . "'";
    $res_var = mysqli_query($conn, $qry_var);

    $jsonvar = array();

    while ($records_var = mysqli_fetch_array($res_var)) {
        $varid = $records_var['id'];
        $var_name = $records_var['variant_name'];
        $var_price = $records_var['variant_price'];
        $jsonvar[] = array("id" => $varid, "variantname" => $var_name, "varprice" => $var_price);
    }



    $qry_ext = "select * from products_extra where product_id ='" . $product_id . "'";
    $res_ext = mysqli_query($conn, $qry_ext);

    $jsonext = array();

    while ($records_ext = mysqli_fetch_array($res_ext)) {
        $extid = $records_ext['id'];
        $ext_name = $records_ext['extra_name'];
        $ext_price = $records_ext['extra_price'];
        $jsonext[] = array("id"=>$extid,"extraname" => $ext_name, "extraprice" => $ext_price);
    }







    $json1[] = array("productId" => $product_id, "productName" => $product_name, "status" => $product_status, "description" => $product_des, "images" => $json, "variants" => $jsonvar, "extra" => $jsonext);
}  //print_r($json1);
?>










<div class="right_col" role="main" style="min-height: 948.994px;">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Plain Page</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Plain Page</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content"> 
                        <br>
                        <div class="message">
                            <center><h5><?php
                                    if (isset($_SESSION['message'])) {
                                        echo $_SESSION['message'];
                                    }unset($_SESSION['message']);
                                    ?></h5></center></div><br>
                        <ul id="registration-step">
                            <li id="account" class="highlight">Menu Item Details</li>
                            <li id="password">Primary-Image</li>
                            <li id="general">Optional Images</li>



                        </ul>
                        <form name="frmRegistration" id="registration-form" method="post" action="item-update.php?id=<?php echo $id1; ?>" >
                            <div id="account-field">
                                <label>Item Name:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Enter name of your Menu Item"></i>
                                <input type="text" class="form-control" placeholder="Enter name of your Menu Item" name="name" required value="<?php echo $product_name; ?>">  <br>

                                <label>Menu Item Description:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Enter description of your Menu Item"></i>

                                <textarea name="editor1" id="editor1" rows="10" cols="80" required>
                                    <?php echo $product_des; ?>				
                                </textarea>

                                <br>
                                <label>Menu Item Variant:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Enter variant of your Menu Item"></i>
                                <div class="col-xs-12 table"><table id="employee_table" align=center class="table table-striped">
                                        <th>Variant Size</th>
                                        <th>Variant Price</th>
                                        <th> Varient Manage</th>
                                        <?php foreach ($jsonvar as $key => $vari) {
                                            $id = $vari['id'];
                                            ?>

                                            <tr id="row1">

                                                <td><input type="text" name="vname[]" placeholder="Size of your menu item" class="form-control"  value="<?php echo $vari['variantname']; ?>" id="vanme"></td>
                                                <td><input type="text" name="vprice[]" placeholder="Price  of that sized item" class="form-control"  value="<?php echo $vari['varprice']; ?>"></td>
    <?php if ($key == 0) { ?>
                                                    <td><input type='button' class='fa fa-plus fa-4 btn btn-primary' value='DELETE'  disabled></td>

    <?php } else { ?>
                                                    <td><span class='delete' id='del_<?php echo $id; ?>'><input type='button' class='fa fa-plus fa-4 btn btn-primary' value='DELETE' id='del_<?php echo $id; ?>' ></td>
                                                            </tr>
                                                        <?php }
                                                    }
                                                    ?>
                                                    </table>
                                                    <a type="button" onclick="add_row();"  class="fa fa-plus-circle btn btn-primary"> ADD Variant</a>

                                                    </div> <br>
                                                    <label>Extras:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Enter extras of your Menu Item"></i>
                                                    <table id="employee_table1" align=center class="table table-striped">
                                                        <th>Extra item name</th>
                                                        <th>Extra item Price</th>
                                                        <th> Varient Manage</th>
<?php foreach ($jsonext as $ext) {
    $id1 = $ext['id']; ?>
                                                            <tr id="row">
                                                                <td><input type="text" name="extra[]" placeholder="extra item name" class="form-control" value="<?php echo $ext['extraname']; ?>" ></td>
                                                                <td><input type="text" name="extraprice[]" placeholder="Price  of that extra item" class="form-control" value="<?php echo $ext['extraprice']; ?>" ></td>
                                                                <td><span class='delete1' id='del_<?php echo $id1; ?>'><input type='button' class='fa fa-plus fa-4 btn btn-primary' value='DELETE' id='del_<?php echo $id1; ?>' ></td>
                                                                        </tr>
<?php } ?>
                                                                    </table>
                                                                    <a type="button" onclick="add_rows();"  class="fa fa-plus-circle btn btn-primary"> ADD Extra</a> 
                                                                    <br><br>
                                                                    <div class="form-group text-muted well well-sm no-shadow">
                                                                        <p class="help-block">Please check at least one category.</p>  
                                                                        <lable><b>Categories</b></lable><br>
                                                                        <?php
                                                                        $sql1 = "SELECT * FROM `app_category` ";
                                                                        // var_dump($sql);
                                                                        $check1 = mysqli_query($conn, $sql1);
                                                                        $resultcheck1 = mysqli_fetch_array($check1, MYSQLI_BOTH);

                                                                        $sql11 = "SELECT * FROM `app_products` where product_id='" . $product_id . "'";
                                                                        // var_dump($sql);
                                                                        $check11 = mysqli_query($conn, $sql11);
                                                                        $autocheck = mysqli_fetch_array($check11, MYSQLI_ASSOC);
//foreach($check11 as $row1){var_dump($row1);}exit();
//exit();

                                                                        foreach ($check1 as $row) {
                                                                            ?>

                                                                            <div class="checkbox-inline">
                                                                                <span style="margin-left:10px"></span><input name="chk[]" value="<?php echo $row['cat_id']; ?>" type="checkbox" id="mycheckbox"  <?php
                                                                                foreach ($check11 as $row1) {
                                                                                    if ($row['cat_id'] == $row1['cat_id']) {
                                                                                        echo 'checked="checked"';
                                                                                    } else {
                                                                                        
                                                                                    }
                                                                                }
                                                                                ?> ><span><?php echo $row['category_name']; ?> </span><span style="margin-left:10px"></span>
                                                                            </div>

<?php } ?>
                                                                        <br>



                                                                    </div> 
                                                                    <?php
                                                                    $sql1 = "SELECT * FROM `app_productsrec` where product_id='" . $product_id . "'";
                                                                    // var_dump($sql);
                                                                    $check1 = mysqli_query($conn, $sql1);
                                                                    $countrow = mysqli_num_rows($check1);
                                                                    ?>
                                                                    <br><label for="sel1">Product Status:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Choose status of your product."></i>
                                                                    <select class="form-control" id="sel1" name="product_status" required>
                                                                        <option value="Available">Available</option>
                                                                        <option value="Not Available">Not Available</option>

                                                                    </select>
                                                                    <br>


                                                                    <label for="sel1">Recommended:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Choose if you want to add this product to recommended list."></i>
                                                                    <select class="form-control" id="sel1" name="rec" required>
                                                                        <option value="<?php echo $countrow; ?>" SELECTED="YES"><?php
                                                                            if ($countrow == 1) {
                                                                                echo 'Recommended';
                                                                            } else {
                                                                                echo 'Not Recommended';
                                                                            }
                                                                            ?></option>
<?php if ($countrow == 1) { ?> <option value="0">Not Recommended</option><?php } else { ?><option value="1">Recommended</option><?php } ?>


                                                                    </select>


                                                                    <br><label>Product Quantity Limit Per Order:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="How many quantity customer can order at one time. Keep it between 1 to 5 to avoid spam bulk orders."></i>
                                                                    <input type="number" class="form-control" placeholder="No. of quantity customer can order at one time" name="plimit" value="<?php echo $product_limit; ?>"   required >
                                                                    <br>  
                                                                    <input class="btn btn-success" type="submit" name="finish"  value="Update Details"></div>

                                                                    <div id="password-field" style="display:none;">
                                                                        <label>Primary-Image</label> 
                                                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Adding primary Image is Complusary"></i>


                                                                        <table id="employee_table1" align=center class="table ">
                                                                            <tr><td>
                                                                                <img src="<?php echo $product_image_primary; ?>" height="200" width="180"><td> </tr>
                                                                            <tr><td><input class="btn btn-primary " type="button" name="back"  data-toggle="modal" data-target="#update" value="Update"></td>
                                                                        </table>
                                                                    </div>

                                                                    </div>
                                                                    <div id="general-field" style="display:none;">
                                                                        <label>Optional Images:</label><br>
                                                                        <?php
                                                                        if (empty($jsonim)) {
                                                                            echo '<div class="show-image"><img src="' . $defimg . '" width="180" height="200"></div>';
                                                                        } else {
                                                                            foreach ($jsonim as $files) {
                                                                                $id = $files['id'];
                                                                                $image = $files['image'];
                                                                                echo '<div class="show-image"><img src="' . $image . '" width="100" height="200">';
                                                                                echo '<input type="hidden" value="' . $image . '" name="delete_file" />';
                                                                                echo '<input type="button" value="Delete image" onclick="delete_post(' . $id . ');" class="btn btn-sm btn-danger" /></div>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <br>
                                                                        <br><br><br><br><br><br><br><br>
                                                                        <br>

                                                                        <br><br><br>


                                                                    </div>
                                                                    <br>
                                                                    <div class="modal-footer">
                                                                        <input class="btn btn-primary " type="button" name="back" id="back" value="Back" style="display:none;">
                                                                        <input class="btn btn-warning" type="button" name="next" id="next" value="Next" >
                                                                        <input class="btn btn-primary " type="button" name="back" id="finish"  data-toggle="modal" data-target="#updateimage" value="Add Optional Images" style="display:none;">
                                                                    </div>
                                                                    </form>







                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <script type="text/javascript">
                                                                        function add_row()
                                                                        {

                                                                            $rowno = $("#employee_table tr").length;
                                                                            $rowno = $rowno + 1;
                                                                            $("#employee_table tr:last").after("<tr id='row" + $rowno + "'><td><input type='text' name='vname[]' placeholder='Size of your Menu Item' class='form-control'></td><td><input type='text'  name='vprice[]' placeholder='price  of that Sized item' class='form-control'></td><td><input type='button' class='fa fa-plus fa-4 btn btn-primary' value='DELETE' onclick=delete_row('row" + $rowno + "')></td></tr>");
                                                                        }
                                                                        function delete_row(rowno)
                                                                        {
                                                                            $('#' + rowno).remove();
                                                                        }
                                                                    </script>     


                                                                    <script type="text/javascript">

                                                                        //Variant Deleting script///

                                                                        $(document).ready(function () {
                                                                            // Delete 
                                                                            $('.delete').click(function () {
                                                                                var el = this;
                                                                                var id = this.id;
                                                                                var splitid = id.split("_");

                                                                                // Delete id
                                                                                var deleteid = splitid[1];

                                                                                alert('Are you sure you want to delete?');
                                                                                $.ajax({
                                                                                    url: 'remove.php',
                                                                                    type: 'POST',
                                                                                    data: {id: deleteid},
                                                                                    success: function (response) {
                                                                                        // Removing row from HTML Table
                                                                                        $(el).closest('tr').css('background', 'tomato');
                                                                                        $(el).closest('tr').fadeOut(800, function () {
                                                                                            $(this).remove();
                                                                                        });

                                                                                    }
                                                                                });

                                                                            });

                                                                        });

                                                                        //Extra Deleting Script ///

                                                                        $(document).ready(function () {
                                                                            // Delete 
                                                                            $('.delete1').click(function () {
                                                                                var el = this;
                                                                                var id = this.id;
                                                                                var splitid = id.split("_");

                                                                                // Delete id
                                                                                var deleteid = splitid[1];
                                                                                //alert(deleteid);
alert('Are you sure you want to delete?');
 
                                                                                $.ajax({
                                                                                    url: 'remove1.php',
                                                                                    type: 'POST',
                                                                                    data: {id: deleteid},
                                                                                    success: function (response) {
                                                                                        // Removing row from HTML Table
                                                                                        $(el).closest('tr').css('background', 'tomato');
                                                                                        $(el).closest('tr').fadeOut(800, function () {
                                                                                            $(this).remove();
                                                                                        });

                                                                                    }
                                                                                });

                                                                            });

                                                                        });



                                                                        function add_rows()
                                                                        {

                                                                            $rowno = $("#employee_table1 tr").length;
                                                                            $rowno = $rowno + 1;
                                                                            $("#employee_table1 tr:last").after("<tr id='row" + $rowno + "'><td><input type='text' name='extra[]' placeholder='addon item' class='form-control'></td><td><input type='text'  name='extraprice[]' placeholder='addon price' class='form-control'></td><td><input type='button' class='fa fa-plus fa-4 btn btn-primary' value='DELETE' onclick=delete_row('row" + $rowno + "')></td></tr>");
                                                                        }
                                                                        function delete_row(rowno)
                                                                        {
                                                                            $('#' + rowno).remove();
                                                                        }
                                                                    </script>  




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

                                                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                                                                    <script>
                                                                        var checkboxes = $("input[type='checkbox']"),
                                                                                submitButt = $("input[type='submit']");

                                                                        checkboxes.click(function () {
                                                                            submitButt.attr("disabled", !checkboxes.is(":checked"));
                                                                        });
                                                                        $("#sel1").change(function () {
                                                                            var disabled = (this.value == "not" || this.value == "default");
                                                                            console.log(disabled);
                                                                            $("#product_text").prop("disabled", disabled);
                                                                        }).change(); //to trigger on load
                                                                    </script>  
                                                                    <script>
                                                                        function delete_post(id) {
                                                                            m = confirm("Are you sure you want to delete this product image?");
                                                                            if (m == true) {
                                                                                $.post('productimagedelete.php', {post_id: id}, // Set your ajax file path
                                                                                        function (data) {
                                                                                            $('#yourDataContainer').html(data); // You can Use .load too
                                                                                            alert('Deleted');
                                                                                            location.reload();
                                                                                        });
                                                                            } else {
                                                                                return false;
                                                                            }
                                                                        }
                                                                    </script>
                                                                    <script src="ckeditor/ckeditor.js"></script>
                                                                    <script>
                                                                        // Replace the <textarea id="editor1"> with a CKEditor
                                                                        // instance, using default configuration.

                                                                        CKEDITOR.replace('editor1');
                                                                    </script> 
<?php include_once'scriptfooter.php'; ?>
                                                                    <!-- Modal -->
                                                                    <!-- Modal -->
                                                                    <div id="update" class="modal fade" role="dialog">
                                                                        <div class="modal-dialog">

                                                                            <!-- Modal content-->
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Add New Category</h4>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <form role="form" action="add-primary.php?id=<?php echo $id1; ?>" method="POST" enctype="multipart/form-data">
                                                                                        <div class="box-body">


                                                                                            <div class="form-group">
                                                                                                <label for="exampleInputFile">Category Image</label>
                                                                                                <input type="file" id="exampleInputFile" name="primary" required>

                                                                                                <p class="help-block">Please upload GIf,JPG,Jpeg,BMP,PNG files only.</p>
                                                                                            </div>

                                                                                        </div>




                                                                                        <div class="modal-footer">
                                                                                            <input type="submit" class="btn btn-success" value="Add primary image" name="addcat">
                                                                                            </form>
                                                                                        </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <!-- Modal -->
                                                                    <div id="updateimage" class="modal fade" role="dialog">
                                                                        <div class="modal-dialog">

                                                                            <!-- Modal content-->
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Add Optional Images</h4>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <form action="editoptional.php?id=<?php echo $id1; ?>" method="POST" enctype="multipart/form-data">
                                                                                        <div class="box-body">

<?php if ($imagecounter < $imagehandel) { ?>
                                                                                                <div class="form-group">
                                                                                                    <label for="exampleInputFile">Optional Images</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add at least one image of your product."></i>
                                                                                                    <br>
                                                                                                    <div class="input-files1"><a class="fa fa-plus fa-4 btn btn-primary" aria-hidden="true"  id="moreImg">Add More Image</a></div>

                                                                                                    <br>
                                                                                                    <div class="input-files">

                                                                                                        <input type="file" name="image_upload-1" >

                                                                                                    </div>
                                                                                                    <p class="help-block">Please upload GIf,JPG,Jpeg,BMP,PNG files only.</p>

                                                                                                    <div class="modal-footer">
                                                                                                        <input type="submit" class="btn btn-success" value="Upload Images" name="addcat">
                                                                                                        </form>
                                                                                                    </div>

                                                                                                    <?php
                                                                                                } else {
                                                                                                    echo ' <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                      <h1>limit exceeded</h1>
                      <p>You have used your image limit(' . $imagehandel . ' images for single product please delete one and try )</p>
                    </div>
                  </div>          </div>';
                                                                                                }
                                                                                                ?>            







                                                                                            </div>
                                                                                        </div>

                                                                                </div>
                                                                            </div>


