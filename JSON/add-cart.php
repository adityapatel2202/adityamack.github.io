<?php

include'../config.php';

$userid = $_POST['userid'];

$varientid = $_POST['varient_id'];
$varient_name = $_POST['varient_name'];
$varient_price = $_POST['varient_price'];
$varientquantity = $_POST['varient_quantity'];
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$json_string = $_POST['json_param'];

$data = json_decode($json_string, TRUE);

//print_r($_POST);
//exit();

if (!empty($userid) && !empty($varientid) && !empty($product_id) && !empty($varientquantity)) {

    $sql = "SELECT * FROM `users` WHERE `id`='" . $userid . "'";
    $check = mysqli_query($conn, $sql);
    $rowcountuser = mysqli_num_rows($check);
    $resultcheck = mysqli_fetch_array($check, MYSQLI_BOTH);
    $uid = $resultcheck['uid'];

    $cart_id = $resultcheck['cart_id'];
    $status = $resultcheck['status'];
    if ($status == 'ACTIVE') {
        if ($rowcountuser > 0) {

///add logic here ///

            $sql = "SELECT * FROM `users_cart` WHERE `product_id`='" . $product_id . "' AND varient_id='" . $varientid . "' AND uid='" . $uid . "'";
            $check = mysqli_query($conn, $sql);

            $rowcount = mysqli_num_rows($check);
//echo $rowcount;
            if ($rowcount > 0) {


                //when varient present in cart update the extra if extra 0 add extra if not then update  logic start here///
                $sql = "SELECT * FROM `cart_extra` where cart_id='" . $cart_id . "'";
                $check = mysqli_query($conn, $sql);
                $rowcountextra = mysqli_num_rows($check);

                if ($rowcountextra > 0) {

                    $sql = "UPDATE `users_cart` SET varient_quantity='" . $varientquantity . "' WHERE `product_id`='" . $product_id . "' AND varient_id='" . $varientid . "'";
                    $check = mysqli_query($conn, $sql);

                    $sql = "DELETE FROM `cart_extra`  WHERE cart_id='" . $cart_id . "' AND varient_id='" . $varientid . "' ";
                    $check = mysqli_query($conn, $sql);

                    if (!empty($data)) {
                        foreach ($data as $key => $value) {
                            $queryextra = "INSERT INTO `cart_extra` (uid,cart_id,extra_id,extra_quantity,extra_name,extra_price,product_id,varient_id) VALUES('" . $uid . "','" . $cart_id . "','" . $value["extraid"] . "','" . $value["extraquantity"] . "','" . $value["extraname"] . "','" . $value["extraprice"] . "','" . $product_id . "','" . $varientid . "')";
                            $resultinsert = mysqli_query($conn, $queryextra) or die(mysql_error());
                        }
                    }


                    $minfo = array("success" => 'true', "message" => 'Your Cart Updated Successfully ');
                    $jsondata = json_encode($minfo);
                    print_r($jsondata);
                    mysqli_close($conn);
                    exit();
                } else {


                    $sql = "UPDATE `users_cart` SET varient_quantity='" . $varientquantity . "' WHERE `product_id`='" . $product_id . "' AND varient_id='" . $varientid . "'";
                    $check = mysqli_query($conn, $sql);
                    
                    

                    $sql = "DELETE FROM `cart_extra`  WHERE cart_id='" . $cart_id . "' AND varient_id='" . $varientid . "' ";
                    $check = mysqli_query($conn, $sql);

                    if (!empty($data)) {
                        foreach ($data as $key => $value) {
                            $queryextra = "INSERT INTO `cart_extra` (uid,cart_id,extra_id,extra_quantity,extra_name,extra_price,product_id,varient_id) VALUES('" . $uid . "','" . $cart_id . "','" . $value["extraid"] . "','" . $value["extraquantity"] . "','" . $value["extraname"] . "','" . $value["extraprice"] . "','" . $product_id . "','" . $varientid . "')";
                            $resultinsert = mysqli_query($conn, $queryextra) or die(mysql_error());
                        }
                    }


                    $minfo = array("success" => 'true', "message" => 'Your Cart Updated Successfully ');
                    $jsondata = json_encode($minfo);
                    print_r($jsondata);
                    mysqli_close($conn);
                    exit();
                }
            } else {

                $query = "INSERT INTO `users_cart` (uid,cart_id,varient_id,varient_quantity,product_id,varient_name,varient_price,product_name) VALUES('" . $uid . "','" . $cart_id . "','" . $varientid . "','" . $varientquantity . "','" . $product_id . "','" . $varient_name . "','" . $varient_price . "','" . $product_name . "')";

                $resultinsert = mysqli_query($conn, $query) or die(mysql_error());


                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $queryextra = "INSERT INTO `cart_extra` (uid,cart_id,extra_id,extra_quantity,extra_name,extra_price,product_id,varient_id) VALUES('" . $uid . "','" . $cart_id . "','" . $value["extraid"] . "','" . $value["extraquantity"] . "','" . $value["extraname"] . "','" . $value["extraprice"] . "','" . $product_id . "','" . $varientid . "')";
                        $resultinsert = mysqli_query($conn, $queryextra) or die(mysql_error());
                    }
                }
                $minfo = array("success" => 'true', "message" => 'Item Added To Your Cart ');
                $jsondata = json_encode($minfo);
                print_r($jsondata);

                mysqli_close($conn);
                exit();
            }
            //add logic end here ///           
        } else {
            $minfo = array("success" => 'false', "message" => 'User Not Registered');
            $jsondata = json_encode($minfo);
            print_r($jsondata);
            mysqli_close($conn);
            exit();
        }
    } else {
        $minfo = array("success" => 'false', "message" => 'Please verify your e-mail before adding item to your cart');
        $jsondata = json_encode($minfo);
        print_r($jsondata);
        mysqli_close($conn);
        exit();
    }
} else {
    $minfo = array("success" => 'false', "message" => 'Empty fields not allowed');
    $jsondata = json_encode($minfo);
    print_r($jsondata);
    mysqli_close($conn);
    exit();
}
 