<?php

include'../config.php';
$main = array();
$cat = array();

$qrycurr = "SELECT * FROM app_details ";
$res = mysqli_query($conn, $qrycurr);
$recordscurr = mysqli_fetch_array($res, MYSQLI_ASSOC);
$currency = $recordscurr['rescurrency'];


$qry = "SELECT * FROM app_category order by cat_id DESC";
$res = mysqli_query($conn, $qry);
$records = mysqli_fetch_array($res, MYSQLI_ASSOC);
foreach ($res as $records) {

    $cat = $records;
    $pstatus='Available';
    $qry = "SELECT * FROM app_products where cat_id='" . $cat['cat_id'] . "' AND product_status='".$pstatus."' order by id DESC";
    $res1 = mysqli_query($conn, $qry);

    $json1 = array();

    while ($records1 = mysqli_fetch_array($res1, MYSQLI_ASSOC)) {
        $product_id = $records1['product_id'];
        $product_des = $records1['description'];
        $product_des = htmlspecialchars_decode(str_replace("&quot;", "\"", $product_des));
        $product_name = $records1['product_name'];
        $product_status = $records1['product_status'];
        $product_image_primary = $serverimg . $records1['primary_image'];
        $product_limit = $records1['plimit'];

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
            $var_id = $records_var['id'];
            $jsonvar[] = array("varientid" => $var_id, "variantname" => $var_name, "varprice" => $var_price);
        }



        $qry_ext = "select * from products_extra where product_id ='" . $product_id . "'";
        $res_ext = mysqli_query($conn, $qry_ext);

        $jsonext = array();

        while ($records_ext = mysqli_fetch_array($res_ext)) {

            $ext_name = $records_ext['extra_name'];
            $ext_price = $records_ext['extra_price'];
            $ext_id = $records_ext['id'];
            $jsonext[] = array("extraid" => $ext_id, "extraname" => $ext_name, "extraprice" => $ext_price);
        }







        $json1[] = array("productId" => $product_id, "productName" => $product_name, "status" => $product_status, "primaryimage" => $product_image_primary, "description" => $product_des, "plimit" => $product_limit, "images" => $json, "variants" => $jsonvar, "extra" => $jsonext);
    }
    $cat['products'] = $json1;
    $main[] = $cat;
    unset($json1);
    unset($jsonvar);
    unset($jsonext);
    unset($json);
    unset($cat);
}
//header("Content-Type: application/json; charset=utf-8");
echo json_encode($main, JSON_UNESCAPED_SLASHES);
unset($main);
mysqli_close($conn);
