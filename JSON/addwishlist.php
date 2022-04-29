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
    if ($status == 'ACTIVE') {
        if ($rowcountuser > 0) {


            $sql = "SELECT * FROM `users_wishlist` WHERE `product_id`='" . $product_id . "' AND uid='" . $uid . "'";
            $check = mysqli_query($conn, $sql);
            $rowcount = mysqli_num_rows($check);
//echo $rowcount;
            if ($rowcount > 0) {
                $sql = "DELETE  FROM `users_wishlist` WHERE `product_id`='" . $product_id . "' AND uid='" . $uid . "'";
                $check = mysqli_query($conn, $sql);
                $minfo = array("success" => 'true', "message" => 'Item removed to your favorite list successfully');
                $jsondata = json_encode($minfo);
                print_r($jsondata);
                mysqli_close($conn);
                exit();
            } else {

                $query = "INSERT INTO `users_wishlist` (uid,email,product_id) VALUES('" . $uid . "','" . $user_email . "','" . $product_id . "')";
                //var_dump($query);
                $resultinsert = mysqli_query($conn, $query) or die(mysql_error());
                if ($resultinsert) {

                    $minfo = array("success" => 'true', "message" => 'Item added to your favorite list successfully ');
                    $jsondata = json_encode($minfo);
                    print_r($jsondata);
                    mysqli_close($conn);
                    exit();
                } else {

                    $minfo = array("success" => 'false', "message" => 'Item not added to your favorite list. Please try again later');
                    $jsondata = json_encode($minfo);
                    print_r($jsondata);
                    mysqli_close($conn);
                    exit();
                }
            }
        } else {
            $minfo = array("success" => 'false', "message" => 'User not registered');
            $jsondata = json_encode($minfo);
            print_r($jsondata);
            mysqli_close($conn);
            exit();
        }
    } else {
        $minfo = array("success" => 'false', "message" => 'Please verify your e-mail before adding item to your favorite list.');
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