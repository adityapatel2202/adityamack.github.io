<?php

include '../config.php';
///////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////GET POST DATA///////////////////////////////



$user_id = $_POST['user_id'];

$product_id = $_POST['product_id'];

if (!empty($user_id) && !empty($product_id)) {


    $sql = "SELECT * FROM `users` WHERE `id`='" . $user_id . "'";
    $check = mysqli_query($conn, $sql);
    $rowcountuser = mysqli_num_rows($check);
    $resultcheck = mysqli_fetch_array($check, MYSQLI_BOTH);
    $uid = $resultcheck['uid'];
    $user_email = $resultcheck['email'];
    $status = $resultcheck['status'];
    if ($rowcountuser > 0) {
        if ($status == 'ACTIVE') {



            $sql = "SELECT * FROM `users_wishlist` WHERE `product_id`='" . $product_id . "' AND uid='" . $uid . "' order by id DESC";
            $check = mysqli_query($conn, $sql);
            $rowcount = mysqli_num_rows($check);
//echo $rowcount;
            if ($rowcount > 0) {

                $minfo = array("success" => 'true', "message" => 'item already exist in wishlist');
                $jsondata = json_encode($minfo);
                print_r($jsondata);
                mysqli_close($conn);
                exit();
            } else {
                $minfo = array("success" => 'false', "message" => 'iteam not added to wishlist yet');
                $jsondata = json_encode($minfo);
                print_r($jsondata);
                mysqli_close($conn);
                exit();
            }
        } else {
            $minfo = array("success" => 'false', "message" => 'please verify your mail before using wishlist feature');
            $jsondata = json_encode($minfo);
            print_r($jsondata);
            mysqli_close($conn);
            exit();
        }
    } else {
        $minfo = array("success" => 'false', "message" => 'user not registerd');
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
 