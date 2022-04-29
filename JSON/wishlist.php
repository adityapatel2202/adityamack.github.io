<?php

include '../config.php';
///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////GET POST DATA///////////////////////////////



$user_id = $_POST['user_id'];


if (!empty($user_id)) {


    $sql = "SELECT * FROM `users` WHERE `id`='" . $user_id . "'";
    $check = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($check);
    if ($rowcount > 0) {
        $resultcheck = mysqli_fetch_array($check, MYSQLI_BOTH);
        $uid = $resultcheck['uid'];
        $user_email = $resultcheck['email'];
        $status = $resultcheck['status'];
        if ($status == 'ACTIVE') {
            $qrycurr = "SELECT * FROM app_admin ";
            $res = mysqli_query($conn, $qrycurr);
            $recordscurr = mysqli_fetch_array($res, MYSQLI_ASSOC);
            $currency = $recordscurr['currency'];


            $sqlwish = "SELECT * FROM `users_wishlist` WHERE `uid`='" . $uid . "'";
            $checkwish = mysqli_query($conn, $sqlwish);
            $rowcount = mysqli_num_rows($checkwish);

//echo $rowcount;
            if ($rowcount > 0) {
                while ($wishlist = mysqli_fetch_array($checkwish)) {
                    $product_id = $wishlist['product_id'];
                    $email = $wishlist['email'];
//echo $product_id;
                    //$json[]=array("userid"=>$user_id,"productid"=>$product_id,"useremail"=>$email);
                    $qry = "SELECT * FROM app_productsmain where product_id='" . $product_id . "'";
                    $res1 = mysqli_query($conn, $qry);
                    while ($res = mysqli_fetch_array($res1, MYSQLI_ASSOC)) {
                        $product_id = $res['product_id'];
                        $product_des = $res['description'];
                        $product_des = htmlspecialchars_decode(str_replace("&quot;", "\"", $product_des));
                        $product_name = $res['product_name'];
                        $product_status = $res['product_status'];
                        $product_date = $res['date'];
                        $product_limit = $res['plimit'];
                        $product_image_primary = $serverimg . $res['primary_image'];

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
                            $var_id = $records_var['id'];
                            $var_name = $records_var['variant_name'];
                            $var_price = $records_var['variant_price'];
                            $jsonvar[] = array("varientid"=>$var_id,"variantname" => $var_name, "varprice" => $var_price);
                        }



                        $qry_ext = "select * from products_extra where product_id ='" . $product_id . "'";
                        $res_ext = mysqli_query($conn, $qry_ext);

                        $jsonext = array();

                        while ($records_ext = mysqli_fetch_array($res_ext)) {

                            $ext_name = $records_ext['extra_name'];
                            $ext_price = $records_ext['extra_price'];
                            $jsonext[] = array("extraname" => $ext_name, "extraprice" => $ext_price);
                        }







                        $json1[] = array("productId" => $product_id, "productName" => $product_name, "status" => $product_status, "primaryimage" => $product_image_primary, "description" => $product_des, "plimit" => $product_limit, "images" => $json, "variants" => $jsonvar, "extra" => $jsonext);

                        unset($json);

                        $json2 = array("success" => 'true', "message" => 'verified', "product" => $json1);
                    }
                }

                print_r(json_encode($json2));
                unset($json1);
                unset($json2);
                mysqli_close($conn);
            } else {
                $minfo = array("success" => 'true', "message" => 'empty wishlist');
                $jsondata = json_encode($minfo);
                print_r($jsondata);
                mysqli_close($conn);
                exit();
            }
        } else {
            $minfo = array("success" => 'false', "message" => 'please verify your mail');
            $jsondata = json_encode($minfo);
            print_r($jsondata);
            mysqli_close($conn);
            exit();
        }
    } else {
        $minfo = array("success" => 'false', "message" => 'user not registered');
        $jsondata = json_encode($minfo);
        print_r($jsondata);
        mysqli_close($conn);
        exit();
    }
} else {
    $minfo = array("success" => 'false', "message" => 'empty fields not allowed');
    $jsondata = json_encode($minfo);
    print_r($jsondata);
    mysqli_close($conn);
    exit();
}



