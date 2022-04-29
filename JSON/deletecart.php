<?php

include'../config.php';

$userid = $_POST['user_id'];
$product_id = $_POST['product_id'];
$varientid = $_POST['varient_id'];

if (!empty($userid) && !empty($varientid) && !empty($product_id) ) {

$sql = "SELECT * FROM `users` WHERE `id`='" . $userid . "'";
    $check = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($check);

    if ($rowcount > 0) {
        $resultcheck = mysqli_fetch_array($check, MYSQLI_BOTH);
        $uid = $resultcheck['uid'];
        $user_email = $resultcheck['email'];

        $status = $resultcheck['status'];
        $cart_id = $resultcheck['cart_id'];


        $sqluser = "SELECT * FROM `users_profile` WHERE `uid`='" . $uid . "'";
        $checkuser = mysqli_query($conn, $sqluser);
        $userdata = mysqli_fetch_array($checkuser, MYSQLI_BOTH);
        $username = $userdata['name'];

        if ($status == 'ACTIVE') {



$sql = "DELETE FROM `cart_extra`  WHERE cart_id='" . $cart_id . "' AND varient_id='" . $varientid . "' ";
                    $check = mysqli_query($conn, $sql);

 $sql = "DELETE FROM `users_cart`  WHERE cart_id='" . $cart_id . "' AND varient_id='" . $varientid . "' AND product_id='".$product_id."' ";
                    $check = mysqli_query($conn, $sql);

$minfo = array("success" => 'true', "message" => 'Item removed from your cart');
                    $jsondata = json_encode($minfo);
                    print_r($jsondata);
                    mysqli_close($conn);
                    exit();



} else {
                $minfo = array("success" => 'false', "message" => 'Please verify your e-mail before adding item to your cart');
                $jsondata = json_encode($minfo);
                print_r($jsondata);
                mysqli_close($conn);
                exit();
            }
        } else {
            $minfo = array("success" => 'false', "message" => 'User not registered ');
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
 
