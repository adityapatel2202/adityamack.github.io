<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>


<?php
$editcurrencyhandel = "SELECT rescurrency FROM app_details";
$gethandelcurrency = mysqli_query($conn, $editcurrencyhandel);
$resulthandelcurr = mysqli_fetch_array($gethandelcurrency, MYSQLI_ASSOC);
$currency = $resulthandelcurr['rescurrency'];
?> 
<?php
if ($currency == 'USD') {
    $currency = '$';
} else {
    $currency = '₹';
}
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Add Menu Item</h3>
            </div>


        </div>

        <div class="clearfix"></div>
        <br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Menu Item Details</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php
                        $editimageshandel = "SELECT imagehandel FROM app_details";
                        $gethandel = mysqli_query($conn, $editimageshandel);
                        $resulthandel = mysqli_fetch_array($gethandel, MYSQLI_ASSOC);
                        $imagehandel = $resulthandel['imagehandel'];
                        $variant = $resulthandel['resvariant'];
                        $extra = $resulthandel['resextra'];
                        ?>
                        <form role="form" method="POST" enctype="multipart/form-data" action="item-process.php" name="form1" onsubmit="required()"  >
                            <!-- text input -->
                            <div class="form-group">
                                <label>Item Name:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Enter name of your menu item"></i>
                                <input type="text" class="form-control" placeholder="Enter name of your menu item" name="name" required>
                            </div>


                            <div class="form-group">
                                <label>Menu Item Description:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Enter description of your menu item"></i>

                                <textarea name="editor1" id="editor1" rows="10" cols="80" required>
									
                                </textarea>
                                <script src="ckeditor/ckeditor.js"></script>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor
                                    // instance, using default configuration.

                                    CKEDITOR.replace('editor1');
                                </script>
                            </div>



                            <div class="form-group">
                                <label>Menu Item Variant:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Enter variant of your menu item"></i>
                                <table id="employee_table" align=center class="table table-striped">
                                    <th>Variant Size</th>
                                    <th>Variant Price</th>
                                    <tr id="row1">
                                        <td><input type="text" name="vname[]" placeholder="Size of your menu item" class="form-control" required></td>
                                        <td><input type="number"  step="0.01" min="0" max="10000000" name="vprice[]" placeholder="Price of variant" class="form-control" required></td>

                                    </tr>
                                    
                                </table>
                                <a type="button" onclick="add_row();"  class="fa fa-plus-circle btn btn-primary"> ADD Variant</a>

                            </div>





                            <br><div class="form-group">
                                <label>Extras:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Enter extras of your menu item"></i>
                                <table id="employee_table1" align=center class="table table-striped">
                                    <th>Extra item name</th>
                                    <th>Extra item Price</th>
                                    <tr id="row">
                                        <td><input type="text" name="extra[]" placeholder="Extra item name" class="form-control" ></td>
                                        <td><input type="number"  step="0.01" min="0" max="10000000" name="extraprice[]" placeholder="Price of extra item" class="form-control" ></td>

                                    </tr>
                            </table>
                            <a type="button" onclick="add_rows();"  class="fa fa-plus-circle btn btn-primary"> ADD Extra</a>

                            </div>

                            <br>
                            
                  
                

                
                   
                <div class="form-group">
  <label for="sel1">Product Status:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Choose status of your item."></i>
  <select class="form-control" id="sel1" name="product_status" required>
                      <option value="Available">Available</option>
                       <option value="Not Available">Not Available</option>

  </select>
</div>


<div class="form-group">
  <label for="sel1">Recommended:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Choose if you want to add this item to recommended list."></i>
  <select class="form-control" id="sel1" name="rec" >
                      <option value="0">Not Recommended</option>
                       <option value="1">Recommended</option>

  </select>
</div>


 <div class="form-group">
                  <label>Product Quantity Limit Per Order:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="How many quantity customer can order at one time."></i>
                  <input type="number" class="form-control" placeholder="No. of quantity customer can order at one time" name="plimit"   required >
                </div>

<div class="form-group">

                                <label for="exampleInputFile">Primary Image</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add primary image of your item."></i>
                                
                                <input type="file" name="primary" required id="fileUpload">

</div>


                            <div class="form-group">

                                <label for="exampleInputFile">Item Images</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Add at least one image of your item."></i>
                                <br>
                                <div class="input-files1"><a class="fa fa-plus fa-4 btn btn-primary" aria-hidden="true"  id="moreImg">Add More Image</a></div>

                                <br>
                                <div class="input-files">

                                    <input type="file" name="image_upload-1"  id="fileUpload">

                                </div>
                                <p class="help-block">Please upload GIf,JPG,Jpeg,BMP,PNG files only.</p>



                                <div class="form-group text-muted well well-sm no-shadow">
                                    <p class="help-block">Please check at least one category.</p>                     
                                    <lable><b>Categories</b></lable><br>

                                    <?php
                                    $sql1 = "SELECT * FROM `app_category` ";
                                    // var_dump($sql);
                                    $check1 = mysqli_query($conn, $sql1);
                                    $resultcheck1 = mysqli_fetch_array($check1, MYSQLI_BOTH);

                                    foreach ($check1 as $row) {
                                        ?>

                                        <div class="checkbox-inline">
                                            <span style="margin-left:10px"></span><input name="chk[]" value="<?php echo $row['cat_id']; ?>" type="checkbox" id="mycheckbox"><span><?php echo $row['category_name']; ?> </span><span style="margin-left:10px"></span>
                                        </div>

                                    <?php } ?>
                                    <br>

                                </div>
                            </div>



                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" value="Add Menu Item" name="addproduct" id="postme" disabled title='Fill all the deatails completely'>

                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
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




                <script type="text/javascript">
                    function add_row()
                    {

                        $rowno = $("#employee_table tr").length;
                        $rowno = $rowno + 1;
                        $("#employee_table tr:last").after("<tr id='row" + $rowno + "'><td><input type='text' name='vname[]' placeholder='Size of your menu item' class='form-control' required></td><td><input type='number'  step='0.01' min='0' max='10000000'  name='vprice[]' placeholder='Price of variant' class='form-control' required></td><td><input type='button' class='fa fa-plus fa-4 btn btn-primary' value='DELETE' onclick=delete_row('row" + $rowno + "')></td></tr>");
                    }
                    function delete_row(rowno)
                    {
                        $('#' + rowno).remove();
                    }
                </script>     


                <script type="text/javascript">
                    function add_rows()
                    {

                        $rowno = $("#employee_table1 tr").length;
                        $rowno = $rowno + 1;
                        $("#employee_table1 tr:last").after("<tr id='row" + $rowno + "'><td><input type='text' name='extra[]' placeholder='Extra item name' class='form-control' required></td><td><input type='number' placeholder='Price of extra item' step='0.01' min='0' max='10000000'  name='extraprice[]' class='form-control' required></td><td><input type='button' class='fa fa-plus fa-4 btn btn-primary' value='DELETE' onclick=delete_row('row" + $rowno + "')></td></tr>");
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
                        $("#moreImg").click(function () {
                            var showId = ++id;
                            if (showId <= high)
                            {
                                $(".input-files").append('<br><input type="file" name="image_upload-' + showId + '">');
                            }
                        });
                    });
                </script>                          

            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php include_once'scriptfooter.php'; ?>