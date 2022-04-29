<?php

include '../config.php';


$user_id = $_POST['user_id'];

$sql="SELECT  *  FROM `app_details` "; 
             $check= mysqli_query($conn, $sql);
           
            
while($row = mysqli_fetch_array($check,MYSQLI_BOTH)){
$tax=$row['restax'];
$rescurrency=$row['rescurrency'];
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


            $sqlwish = "SELECT * FROM `users_orders` WHERE `uid`='" . $uid . "' order by id DESC";
            $checkorder = mysqli_query($conn, $sqlwish);
            $rowcount = mysqli_num_rows($checkorder);


//echo $rowcount;
            if ($rowcount > 0) {
///something in cart then login goes here /////
                while ($cart1 = mysqli_fetch_array($checkorder)) {
print_r($cart);


		
		 $order_id=$cart1['order_id'];
		 $order_date=$cart1['order_date'];
		 $totalamount=$cart1['total'];
		 $paymentref=$cart1['paymentref'];
		 $paymode=$cart1['paymentmode'];
		 $paymentstatus=$cart1['payment_status'];
		 $address=$cart1['address'];
		$total=$cart1['total'];
		$status=$cart1['order_status'];
		$delivery=$cart1['delivery'];
		$tax=$cart1['tax'];
		$qry_ext1 = "select * from ordered_extra WHERE   uid='" . $uid . "' AND order_id='" . $order_id . "'";
                    $res_ext1 = mysqli_query($conn, $qry_ext1);
                    while ($records_ext = mysqli_fetch_array($res_ext1)) {
                        $extra_quantity = $records_ext['extra_quantity'];
                        $ext_name = $records_ext['extra_name'];
                        $ext_price = $records_ext['extra_price'];
                        $ext_id = $records_ext['extra_id'];
                        $product_id = $records_ext['product_id'];
                        $jsonext[] = array("extraid" => $ext_id, "extraname" => $ext_name, "extraprice" => $ext_price, "extraquantity" => $extra_quantity);
                    }
		
		
                    $sql = "SELECT * FROM `ordered_varient` WHERE `order_id`='" . $order_id . "'";
                    $check = mysqli_query($conn, $sql);
                    while ($cart = mysqli_fetch_array($check)) {
                        $variantid = $cart['varient_id'];
                        $varient_ids[] = $cart['varient_id'];
                        $variantid = $cart['varient_id'];
                        $varientquantity = $cart['varient_quantity'];
                        $product_id = $cart['product_id'];
                        $product_name = $cart['product_name'];
                        $product_image = $serverimg.$cart['product_image'];
                        $varientname = $cart['varient_name'];
                        $varientprice = $cart['varient_price'];
                        $jsonvar[] = array("varientid" => $variantid, "variantname" => $varientname, "varquantity" => $varientquantity, "varprice" => $varientprice, "product_id" => $product_id, "productname" => $product_name,"image"=>$product_image,"extra"=>$jsonext);
                    }
                    
if($status=='In-Processing'){ $statuscode=1;}elseif($status=='Dispatch'){$statuscode=2;}elseif($status=='Complete'){$statuscode=3; }elseif($status=='Cancel'){$statuscode=0; }
		$jsonorder[]=array("orderid"=>$order_id,"orderdate"=>$order_date,"paymode"=>$paymode,"paymentstatus"=>$paymentstatus,"address"=>$address,"total"=>$total,"status"=>$status,"statuscode"=>$statuscode,"delivery"=>$delivery,"tax"=>$tax,"currency"=>$rescurrency,"varients"=>$jsonvar);
		
                   unset($jsonvar);
                   unset($jsonext);
                   }
                   $jsonmain=array("success" => 'true',"orderdata"=>$jsonorder);
                   print_r(json_encode($jsonmain));
                   unset($jsonmain);
                    
            } else {
                $minfo = array("success" => 'true', "message" => 'No order histroy start shopping now ');
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