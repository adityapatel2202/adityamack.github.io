<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>


<?php
$qry_var = "select * from res_city ";
$res_var = mysqli_query($conn, $qry_var);

$jsoncity = array();

while ($records_var = mysqli_fetch_array($res_var)) {
    $cityid = $records_var['id'];
    $citypin = $records_var['pincode'];

    $jsoncity[] = array("id" => $cityid, "pincode" => $citypin);
}

//print_r($jsoncity);
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>All Settings</h3>
            </div>


        </div>

        <div class="clearfix"></div>
        <br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> App Settings</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">



                        <?php
                        $sql = "SELECT  *  FROM `app_details` ";
                        $check = mysqli_query($conn, $sql);
//var_dump($check);
                        $rowcount = mysqli_num_rows($check);
                        $row = mysqli_fetch_array($check, MYSQLI_BOTH);

                        $total = $row['id'];
//print_r($row);

                        ?>
                        <form class="forms-sample" method="POST" action="processappsettings.php" >







                            <div class="form-group">

                                <label for="exampleInputEmail1">No. of images</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Maximum no. of images you want to add per item."></i>                      
                                <input type="number" class="form-control p-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Maximum no. of images you want to add per item." name="imagehandel" value="<?php echo $row['imagehandel']; ?>">
                            </div>




                            <div class="form-group">
                                <label for="exampleInputEmail1">Tax %</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Enter tax in percentage."></i>
                                <input type="number" class="form-control p-input" id="exampleInputEmail1" placeholder="Enter tax in percentage." name="restax" required="required" value="<?php echo $row['restax']; ?>">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Currency </label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Choose your currency"></i>

                                <select name="currency" class="form-control" required>


                                    <option value="<?php echo $row['rescurrency']; ?>" SELECTED="YES"><?php echo $row['rescurrency']; ?></option>
                                    <?php if ($row['rescurrency'] == 'USD') { ?>
                                        <option value="INR">INR</option><?php } else { ?><option value="USD">USD</option><?php } ?>



                                </select>

                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Minimum price per order</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Enter minimum price per order."></i>
                                <input type="number" class="form-control p-input" id="exampleInputEmail1" placeholder="Enter minimum price per order." name="resminorder" required="required" value="<?php echo $row['resminorder']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Delivery Charges</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Enter delivery charges."></i>
                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Enter delivery charges." name="delivery" required="required" value="<?php echo $row['delivery']; ?>">
                            </div>


                            <br>
                            <label>Delivery Pin-Code:</label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Enter all delivery pin code for your restaurant."></i>
                            <div class="col-xs-12 table"><table id="employee_table" align=center class="table table-striped">
                                    <th>Pin-code</th>
                                    <th>Manage Pin code</th>

                                    <?php
                                    foreach ($jsoncity as $key => $vari) {
                                        $id = $vari['id'];
                                        ?>

                                        <tr id="row1">

                                            <td><input type="text" name="pin[]" placeholder="Enter delivery pincode value." class="form-control"  value="<?php echo $vari['pincode']; ?>" required ></td>

                                            <?php if ($key == 0) { ?>
                                                <td><input type='button' class='fa fa-plus fa-4 btn btn-primary' value='DELETE'  disabled></td>

                                            <?php } else { ?>
                                                <td><span class='delete' id='del_<?php echo $id; ?>'><input type='button' class='fa fa-plus fa-4 btn btn-primary' value='DELETE' id='del_<?php echo $id; ?>' ></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                </table>
                                                <a type="button" onclick="add_row();"  class="fa fa-plus-circle btn btn-primary"> Add More Pincode</a>

                                                </div> 




                                                <div class="modal-footer">

                                                    <input type="submit" value="Update Setting" class="btn btn-primary mr-2" name="update">
                                                </div>



                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                <!-- /page content -->

                                                <?php include_once'scriptfooter.php'; ?>
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
                                                        url: 'removepin.php',
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
                                
                                function add_row()
                            {

                                                                        $rowno = $("#employee_table tr").length;
                                                                $rowno = $rowno + 1;
                                                                            $("#employee_table tr:last").after("<tr id='row" + $rowno + "'><td><input type='text' name='pin[]' placeholder='Enter delivery pincode value.' class='form-control' required></td><td><input type='button' class='fa fa-plus fa-4 btn btn-primary' value='DELETE' onclick=delete_row('row" + $rowno + "')></td></tr>");
                                }
                                function delete_row(rowno)
                                {
                                                                        $('#' + rowno).remove();
                                    }
                                    </script>  


