<?php

include '../config.php';


$user_id = $_POST['user_id'];

$sql="SELECT  *  FROM `app_details` "; 
             $check= mysqli_query($conn, $sql);
           
            
while($row = mysqli_fetch_array($check,MYSQLI_BOTH)){
$tax=$row['restax'];
$shipping=$row['delivery'];
}
if (!empty($user_id)) {


    $sql = "SELECT * FROM `users` WHERE `id`='" . $user_id . "'";
    $check = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($check);
    if ($rowcount > 0) {
        $resultcheck = mysqli_fetch_array($check, MYSQLI_BOTH);
        $uid = $resultcheck['uid'];
        $cart_id = $resultcheck['cart_id'];
        $user_email = $resultcheck['email'];
        $status = $resultcheck['status'];
        if ($status == 'ACTIVE') {


            $sqlwish = "SELECT * FROM `users_cart` WHERE `uid`='" . $uid . "' AND cart_id='" . $cart_id . "' order by id DESC";
            $checkwish = mysqli_query($conn, $sqlwish);
            $rowcount = mysqli_num_rows($checkwish);

//echo $rowcount;
            if ($rowcount > 0) {
///something in cart then login goes here /////
                

                $sqlwish = "SELECT * FROM `users_cart` WHERE `uid`='" . $uid . "' ";
                $checkcart = mysqli_query($conn, $sqlwish);



                while ($cart = mysqli_fetch_array($checkcart)) {
                    $varient_ids[] = $cart['varient_id'];
                    $variantid = $cart['varient_id'];
                    $varientquantity = $cart['varient_quantity'];
                    $product_id = $cart['product_id'];
                    $product_name = $cart['product_name'];
                    $varientname = $cart['varient_name'];
                    $varientprice = $cart['varient_price'];
                    $jsonvar = array("varientid" => $variantid, "variantname" => $varientname, "varquantity" => $varientquantity, "varprice" => $varientprice, "product_id" => $product_id, "productname" => $product_name);

                    
$jsonext=array();

$qry_ext1 = "select * from cart_extra WHERE   uid='" . $uid . "' AND varient_id='".$variantid."'";
                $res_ext1 = mysqli_query($conn, $qry_ext1);
                while ($records_ext = mysqli_fetch_array($res_ext1)) {
                    $extra_quantity= $records_ext['extra_quantity'];
                    $ext_name = $records_ext['extra_name'];
                    $ext_price = $records_ext['extra_price'];
                    $ext_id = $records_ext['extra_id'];
                    $product_id = $records_ext['product_id'];
                    $jsonext[] = array("extraid" => $ext_id, "extraname" => $ext_name, "extraprice" => $ext_price, "extraquantity" => $extra_quantity);
                }


                       $qry = "SELECT * FROM app_productsmain where product_id='" . $product_id . "'";
                    $resproduct = mysqli_query($conn, $qry);


                    while ($records1 = mysqli_fetch_array($resproduct, MYSQLI_ASSOC)) {
                        $product_id = $records1['product_id'];
                        $product_des = $records1['description'];
                        $product_des = htmlspecialchars_decode(str_replace("&quot;", "\"", $product_des));
                        $product_name = $records1['product_name'];
                       
                        $product_image_primary = $serverimg . $records1['primary_image'];
                        $product_limit = $records1['plimit'];
                    }
                    $json1[] = array("productId" => $product_id, "productName" => $product_name, "primaryimage" => $product_image_primary, "description" => $product_des, "plimit" => $product_limit, "variants" => $jsonvar, "extra" => $jsonext);
                }


$jsonmain=array("success"=>'true', "message"=>'verified',"userid"=>$user_id,"useremail"=>$user_email,"cartid"=>$cart_id,"tax"=>$tax,"delivery"=>$shipping,"products"=>$json1);
                print_r(json_encode($jsonmain));
                unset($jsonvar);
                unset($json1);
                unset($jsonext);
                unset($jsonmain);
            } else {
                $minfo = array("success" => 'true', "message" => 'Empty cart');
                $jsondata = json_encode($minfo);
                print_r($jsondata);
                mysqli_close($conn);
                exit();
            }
        } else {
            $minfo = array("success" => 'false', "message" => 'Please verify your mail');
            $jsondata = json_encode($minfo);
            print_r($jsondata);
            mysqli_close($conn);
            exit();
        }
    } else {
        $minfo = array("success" => 'false', "message" => 'User not registered');
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