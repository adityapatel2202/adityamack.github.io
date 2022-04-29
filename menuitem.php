<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>




<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Food Item</h3>
            </div>


        </div>

        <div class="clearfix"></div>
        <br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> Menu Item Details</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">


                        <a class="btn btn-primary " class="pull-left" href="additem.php">Add Item</a>
                        <hr>
                        <br>
                        <!--<h1>hello</h1>-->
                        <?php
                        $sql = "SELECT * FROM `app_productsmain` order by id DESC ";

                        $check = mysqli_query($conn, $sql);
                        ?>

                        <style>.dt-head-center {text-align: center;}</style>
                        <script language="JavaScript" type="text/javascript">
                            function checkDelete() {
                                return confirm('Are you sure you want to delete?');
                            }
                        </script>



                        <center><table id="employee_data" class="table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th >View</th>
                                        <th >Edit</th>
                                        <th >Delete</th>
                                    </tr></thead>
<?php
$k = mysqli_fetch_array($check, MYSQLI_BOTH);

$product_id = $k['product_id'];

//echo $product_id;
//echo $img;

$sql = "SELECT * FROM `app_productsmain` ORDER BY `id` DESC";

$check = mysqli_query($conn, $sql);

while ($k = mysqli_fetch_array($check, MYSQLI_BOTH)) {
    //var_dump($k);

   

    echo '<tr>
                

                                  <td> <center>' . $k["product_name"] . '</td>
                  <td><center><img src="' . $k["primary_image"] . ' " height="100" width="100"></td>';
    if ($k['product_status'] == 'Available') {
        echo '
<td> <center> <span class="badge bg-green">' . $k["product_status"] . '</span></td>';
    } else {
        echo'<td><center> <span class="badge bg-red">' . $k["product_status"] . '';
    }echo' </td>
  <td><center>' . $k["date"] . '</td>                 
  <td><center><a href="viewproductsdetails.php?id=' . base64_encode($k["id"]) . '"><button class=" btn btn-primary" >View <i class="fa fa-eye" aria-hidden="true"></i></button></a></td>                
                  <td><center><a href="editproductsdetails.php?id=' . base64_encode($k["id"]) . '"><button class=" btn btn-primary  btn-success" >Edit <i class="fa fa-pencil" aria-hidden="true"></i></button></a></td>
                                  
                                 <td><center><a href="deleteproducts.php?id=' . base64_encode($k['id']) . '" class="btn btn-danger" onClick="return checkDelete()" ><i class="fa fa fa-trash-o"></i></a> </td> </tr>';
}
?>

                                </tbody></table></center>
                    </div></div>
</div>
                                <?php include 'scriptfooter.php'; ?>
<script>
    $(document).ready(function () {
        $('#employee_data').DataTable({

            "scrollX": true,
            'paging': true,
            "processing": true,
            'searching': true,
            'ordering': true,
 'order': [[ 3, "desc" ]],
            'info': true,
            'autoWidth': false,

            'responsive': true,

        });
    });
</script> 