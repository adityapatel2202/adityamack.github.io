<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>
<style>* {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

.item {
  position: relative;
  
  border: 0px solid #333;
  margin: 2%;
  overflow: hidden;
  width: 540px;
}
.item img {
  max-width: 90%;
  
  -moz-transition: all 0.3s;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
}
.item:hover img {
  -moz-transform: scale(1.1);
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}</style>
<?php
$id = $_GET['id'];
$id = base64_decode($id);
//echo $id;

if (empty($id)) {
    echo'<script> alert("unauthrosize access not allowed");
            window.location.assign("dashboard.php")
            </script>';
} else {

    $qry = "SELECT * FROM app_productsmain where id='" . $id . "'";
    $res1 = mysqli_query($conn, $qry);
    while ($records1 = mysqli_fetch_array($res1, MYSQLI_ASSOC)) {
        $product_id = $records1['product_id'];
        $product_des = $records1['description'];
        $product_des = htmlspecialchars_decode(str_replace("&quot;", "\"", $product_des));
        $product_name = $records1['product_name'];
        $product_status = $records1['product_status'];
        $product_date = $records1['date'];
        $product_image_primary = $records1['primary_image'];

        $qry_image = "select * from product_images where product_id ='" . $product_id . "'";
        $res_image = mysqli_query($conn, $qry_image);

        $json = array();

        while ($records_image = mysqli_fetch_array($res_image)) {

            $product_image = $serverimg . $records_image['image'];
            $json[] = $product_image;
        }


        $qry_var = "select * from products_variant where product_id ='" . $product_id . "'";
        $res_var = mysqli_query($conn, $qry_var);

        $jsonvar = array();

        while ($records_var = mysqli_fetch_array($res_var)) {

            $var_name = $records_var['variant_name'];
            $var_price = $records_var['variant_price'];
            $jsonvar[] = array("variantname" => $var_name, "varprice" => $var_price);
        }



        $qry_ext = "select * from products_extra where product_id ='" . $product_id . "'";
        $res_ext = mysqli_query($conn, $qry_ext);

        $jsonext = array();

        while ($records_ext = mysqli_fetch_array($res_ext)) {

            $ext_name = $records_ext['extra_name'];
            $ext_price = $records_ext['extra_price'];
            $jsonext[] = array("extraname" => $ext_name, "extraprice" => $ext_price);
        }







        $json1[] = array("productId" => $product_id, "productName" => $product_name, "status" => $product_status, "description" => $product_des, "images" => $json, "variants" => $jsonvar, "extra" => $jsonext);
    }  //print_r($json1);
    ?>

    <div class="right_col" role="main" style="min-height: 1578.99px;">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Menu Details Page</h3>
                </div>



            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>All details </h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="product-image" id="main-img">
                                <div class="item"><img src="<?php echo $product_image_primary; ?>" alt="..." height="250" width="150" ><div class="item-overlay top"></div></div>
                            </div><br>
                            <div class="product_gallery" id="gallery" >
    <?php if(empty($json)){ ?>
<a data-toggle="modal" data-target="#myModal" href="#myGallery" data-slide-to="0"><img src="<?php echo $defimg; ?>" alt="..." height="100" width="100"></a><?php }else foreach ($json as $img) { ?> 


                                    <a data-toggle="modal" data-target="#myModal" href="#myGallery" data-slide-to="0"><img src="<?php echo $img; ?>" alt="..." height="100" width="100"></a>
    <?php } ?>


                            </div>
                        </div>

                        <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                            <h3 class="prod_title"><?php echo $product_name; ?></h3>

                            <p><?php echo $product_des; ?></p>
                            <br>


                            <br>

                            <div class="">
                                <h2>Size <small>variants available </small></h2>
                                <ul class="list-inline prod_size">
                                    <?php foreach ($jsonvar as $var) { ?><li>
                                            <button type="button" class="btn btn-default btn-xs"><?php echo $var['variantname']; ?></button>
                                        </li>
    <?php } ?>

                                </ul>
                                <h2>extras <small>extras available </small></h2>
                                <ul class="list-inline prod_size">
                                    <?php foreach ($jsonext as $extra) { ?><li>
                                            <button type="button" class="btn btn-default btn-xs"><?php echo $extra['extraname']; ?></button>
                                        </li>
    <?php } ?>
                                </ul>
                            </div>
                            <br>

                            <div class="">
                                <div class="product_price">
                                    <h1 class="price"><?php echo $product_status; ?></h1>
                                    <span class="price-tax"><?php echo $product_date; ?></span>
                                    <br>
                                </div>
                            </div>

                            <div class="">
                                <a href="editproductsdetails.php?id=<?php echo base64_encode($id);?>" type="button" class="btn btn-warning btn-lg fa fa-pencil"> Edit Item</a>
                                <a href="deleteproducts.php?id=<?php echo base64_encode($id);?>" onClick="return checkDelete()" type="button" class="btn btn-danger btn-lg fa fa fa-trash-o"> Delete Item</a>
                            </div>

                            <div class="product_social">

                            </div>

                        </div>

              <div class="col-md-12">
                            <div class="col-xs-12 table">
                   <table id="employee_data" class="table table-bordered table-hover"> 
<thead><th colspan="10"><center><h1>Price Chart</h1></center></th> </thead>           
<tr><td>
<table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Variant Name</th>
                                            <th>Variant Price</th>
                 </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
    <?php foreach ($jsonvar as $var) { ?>
                                                <td><?php echo $var['variantname'];?></td>
<td><?php echo $var['varprice'];?></td></tr><tr>
<?php }?>

                                            </tr>
                                        </tbody>
                                    </table>
</td>
<td>

<table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Extra Name</th>
                                            <th>Extra Price</th>
                 </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
    <?php foreach ($jsonext as $var) { ?>
                                                <td><?php echo $var['extraname'];?></td>
<td><?php echo $var['extraprice'];?></td></tr><tr>
<?php }?>

                                            </tr>
                                        </tbody>
                                    </table>

</td>
</tr>
</table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
 <!--begin modal window-->
<div class="modal fade" id="myModal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<div class="pull-left"><?php echo $resultcheck['product_name']; ?></div>
<button type="button" class="close" data-dismiss="modal" title="Close"> <span class="glyphicon glyphicon-remove"></span></button>
</div>
<div class="modal-body">





<!--begin carousel-->
<div id="myGallery" class="carousel slide" data-interval="false">
<div class="carousel-inner">
<div class="item active"><center><div class="item"> <img class="img-responsive" src="<?php echo $product_image_primary; ?>" alt="item0" height="200" width="200" ></div>
</div>

<?php  if(empty($json)){?>
<div class="item"> <center><img src="<?php echo $defimg; ?>" alt="item1" height="300" width="300"></center>

</div><?php }else{
                foreach($json as $image){
                ?>

<div class="item"> <center><img src="<?php echo $image; ?>" alt="item1" height="300" width="300"></center>

</div>

<?php }} ?>

<!--end carousel-inner--></div>
<!--Begin Previous and Next buttons-->
<a class="left carousel-control" href="#myGallery" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myGallery" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span></a>
<!--end carousel--></div>









<!--end modal-body--></div>
<div class="modal-footer">
<div class="pull-left">

</div>
<button class="btn-sm close" type="button" data-dismiss="modal">Close</button>
<!--end modal-footer--></div>
<!--end modal-content--></div>
<!--end modal-dialoge--></div>
<!--end myModal-->></div>


        <?php include_once'scriptfooter.php'; ?>
<script>
    $(document).ready(function () {
        $('#data').DataTable({
            "scrollX": true,
            'paging': true,
            "processing": true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,

            'responsive': true,

        });
    });
</script>
 
        <?php }
    ?>