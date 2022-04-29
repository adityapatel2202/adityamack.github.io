<?php

include '../config.php';

$userid = $_POST['user_id'];
$cartid = $_POST['cart_id'];
$paymentref = $_POST['paymentref'];
$paymentmod = $_POST['paymentmode'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$payment_status = $_POST['paystatus'];
$total = $_POST['total'];

$sqlres = "SELECT * FROM `res_details`";
$checkres = mysqli_query($conn, $sqlres);
$resdata = mysqli_fetch_array($checkres, MYSQLI_BOTH);
$resname = $resdata['resname'];
$resaddress = $resdata['resaddress'];

$sqlres1 = "SELECT * FROM `app_details`";
$checkres1 = mysqli_query($conn, $sqlres1);
$appdata = mysqli_fetch_array($checkres1, MYSQLI_BOTH);
$restax = $appdata['restax'];
$rescurrency = $appdata['rescurrency'];
$delivery = $appdata['delivery'];



if (!empty($userid) && !empty($paymentref) && !empty($cartid) && !empty($paymentmod) && !empty($address) && !empty($phone) && !empty($payment_status) && !empty($total)) {

    $sql = "SELECT * FROM `users` WHERE `id`='" . $userid . "'";
    $check = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($check);

    if ($rowcount > 0) {
        $resultcheck = mysqli_fetch_array($check, MYSQLI_BOTH);
        $uid = $resultcheck['uid'];
        $user_email = $resultcheck['email'];

        $status = $resultcheck['status'];
        $cartid = $resultcheck['cart_id'];


        $sqluser = "SELECT * FROM `users_profile` WHERE `uid`='" . $uid . "'";
        $checkuser = mysqli_query($conn, $sqluser);
        $userdata = mysqli_fetch_array($checkuser, MYSQLI_BOTH);
        $username = $userdata['name'];

        if ($status == 'ACTIVE') {
            /////if active checking for cart is empty or not ///


            $sqlwish = "SELECT * FROM `users_cart` WHERE `uid`='" . $uid . "' AND cart_id='" . $cartid . "'";
            $checkcart = mysqli_query($conn, $sqlwish);
            $rowcountcart = mysqli_num_rows($checkcart);
            $cartiteams = mysqli_fetch_array($checkcart);

            if ($rowcountcart > 0) {
                ///IF cart has any item logic goes here/////
                //echo 'cart me kuch hai ';
                $orderid = 'OD' . rand(999, 9999999999999);
                $date = date('Y-m-d H:i:s');

                $order_status = "In-Processing";

                 $sqlorder = "INSERT INTO  `users_orders`(order_id,paymentref,paymentmode,payment_status,address,order_date,order_status,phone,total,uid,delivery,tax)
VALUES('" . $orderid . "','" . $paymentref . "','" . $paymentmod . "','" . $payment_status . "','" . $address . "','" . $date . "','" . $order_status . "','" . $phone . "','" . $total . "','" . $uid . "','" . $delivery . "','" . $restax . "')";
                    $addorder = mysqli_query($conn, $sqlorder);
                    $last_id = $conn->insert_id;

                    $sql = "SELECT * FROM `users_orders` WHERE `id`='" . $last_id . "'";
                    $check = mysqli_query($conn, $sql);
                    $orderdetails = mysqli_fetch_array($check);
                    $order_id = $orderdetails['order_id'];

                    //echo 'oder id is genrated successfully:  ' . $order_id;
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
                        $qry = "SELECT * FROM app_productsmain where product_id='" . $product_id . "'";
                        $resproduct = mysqli_query($conn, $qry);


                        while ($records1 = mysqli_fetch_array($resproduct, MYSQLI_ASSOC)) {
                            $product_id = $records1['product_id'];
                            $product_des = $records1['description'];
                            $product_des = htmlspecialchars_decode(str_replace("&quot;", "\"", $product_des));
                            $product_name = $records1['product_name'];

                            $product_image_primary = $records1['primary_image'];
                            $product_limit = $records1['plimit'];
                        }
                        $sqlorder = "INSERT INTO  `ordered_varient`(order_id,product_name,product_id,product_image,varient_id,varient_name,varient_quantity,uid,varient_price) VALUES('" . $order_id . "','" . $product_name . "','" . $product_id . "','" . $product_image_primary . "','" . $variantid . "','" . $varientname . "','" . $varientquantity . "','" . $uid . "','" . $varientprice . "')";
                        $addorder = mysqli_query($conn, $sqlorder);


                        $sql = "DELETE  FROM `users_cart` WHERE `varient_id`='" . $variantid . "'  AND uid='" . $uid . "'";
                       $check = mysqli_query($conn, $sql);
                    
                     $qry_ext1 = "select * from cart_extra WHERE   uid='" . $uid . "' AND varient_id='" . $variantid . "' ";
                    $res_ext1 = mysqli_query($conn, $qry_ext1);
                   
                    
                    while ($records_ext = mysqli_fetch_array($res_ext1)) {
                    
                   
                   
                         
                        $extra_quantity = $records_ext['extra_quantity'];
                        $ext_name = $records_ext['extra_name'];
                        $ext_price = $records_ext['extra_price'];
                        $ext_id = $records_ext['extra_id'];
                        $product_id = $records_ext['product_id'];
                        $varientid = $records_ext['varient_id'];
                        $uid = $records_ext['uid'];
//if(!empty($records_ext)){ $productname[]=$records_ext['product_name']; print_r($productname);}

                        $sqlorder = "INSERT INTO  `ordered_extra`(order_id,product_name,product_id,product_image,extra_id,extra_name,extra_quantity,uid,extra_price) VALUES('" . $order_id . "','" . $product_name . "','" . $product_id . "','" . $product_image_primary . "','" . $ext_id . "','" . $ext_name . "','" . $extra_quantity . "','" . $uid . "','" . $ext_price . "')";
                        $addorder = mysqli_query($conn, $sqlorder);


                        $sql = "DELETE FROM `cart_extra`  WHERE  uid='" . $uid . "' AND varient_id='" . $variantid . "'  ";
                      $check = mysqli_query($conn, $sql);
                    }

}

                    //var_dump($table1);
                    $qrycurr = "SELECT * FROM app_details";
                    $res = mysqli_query($conn, $qrycurr);
                    $recordscurr = mysqli_fetch_array($res, MYSQLI_ASSOC);
                    $currency = $recordscurr['rescurrency'];
                    $tax = $recordscurr['restax'];
                    $shipping = $recordscurr['delivery'];

                    if ($currency == 'USD') {
                        $currency = '$';
                    } else {
                        $currency = '₹';
                    }
  
                
                
                require 'PHPMailer_5.2.0/class.phpmailer.php';

                $message = file_get_contents('invoicehead.php');
             $message .= '
  
   
  
  
  <td class="mini-block-padding" >
                          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
                            <tr>
                              <td class="mini-block">
                                <span class="header-sm">Shipping Address</span><br />
                                 ' . strip_tags($address) . '<br>Contact no :' . strip_tags($phone) . '
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                  <td class="mini-container-right">
                    <table cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                        <td class="mini-block-padding">
                          <table cellspacing="0" cellpadding="0" width="100%" style="border-collapse:separate !important;">
                            <tr>
                              <td class="mini-block">
                                <span class="header-sm">Date Ordered</span><br />
                                ' . strip_tags($date) . '
                                <br />
                                <span class="header-sm">Order</span> <br />
                               ' . strip_tags($order_id) . ' 
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
  
  <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;"  border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;">
      <center>
        <table cellpadding="0" cellspacing="0" width="600" class="w320">
            <tr>';
            
            
            
                $sql = "SELECT * FROM `ordered_varient` WHERE `order_id`='" . $order_id . "'";
                $check = mysqli_query($conn, $sql);
$varientallprice=0;
$message .= '<table cellpadding="0" cellspacing="0" width="600" class="w320" border="1">
                <tr><th> Product Name</th>
                <th colspan="5"> Image </th></tr>';
                while ($var = mysqli_fetch_array($check)) {
                    $vprice = $var['varient_price'];


                    $message .= '<tr><td> ' . strip_tags($var['product_name']) . ' (' . strip_tags($var['varient_name']) . ') ( ' . strip_tags($vprice) . ')</td>
                <td><br><img width="95" height="90" src="' . strip_tags($serverimg.$var['product_image']) . '" alt="item1"></td>
                 </tr>';
                    $varientallprice = $varientallprice+$var['varient_quantity'] * $vprice;
                }
                $message .= '</tr>';
                 $message .= '<tr>
                <td align = "center" valign = "top" width = "100%" style = "background-color: #f7f7f7;" border-top: 1px solid #e5e5e5; border-bottom: 1px solid #e5e5e5;">
                <center>
                <table cellpadding = "0" cellspacing = "0" width = "600" class = "w320" border="1">
                <tr>
                <td class = "item-table">
                <table cellspacing = "0" cellpadding = "0" width = "100%">
                <tr>
                <td class = "title-dark" width = "300">
                Product
                </td>
                <td class = "title-dark" width = "163">
                Extra
                </td>
                <td class = "title-dark" width = "97">
                Quantity
                </td>
                 <td class = "title-dark" width = "97">
                Extra Price
                </td>
                </tr>

                ';
                $sql = "SELECT * FROM `ordered_extra` WHERE `order_id`='" . $order_id . "'";
                $check = mysqli_query($conn, $sql);
                $extraprice=0;
                while ($var = mysqli_fetch_array($check)) {
                $message .= '
                  <tr>
                    <td class="item-col item">
                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          
                          <td class="product">
                            <span style="color: #4d4d4d; font-weight:bold;">' . strip_tags($var['product_name']) . '  WITH </span> <br />
                            
                          </td>
                        </tr>
                      </table>
                    </td><td class="item-col quantity">
                      ' . strip_tags($var['extra_name']) . '
                    </td>
                    <td class="item-col quantity">
                      ' . strip_tags($var['extra_quantity']) . '
                    </td>
                    <td class="item-col">
                     ' . strip_tags($currency . $var['extra_price']) . '
                    </td>
                    
                  </tr><tr>';
                    
                    $extraprice = $extraprice+$var['extra_quantity'] * $var['extra_price'];
                }
                
                $totalPrice=$extraprice+$varientallprice;
                $tax=$totalPrice * ($tax / 100);
                  $message .= ' <tr>
                    <td class="item-col item mobile-row-padding"></td>
                    <td class="item-col quantity"></td>
                    <td class="item-col price"></td>
                  </tr>

 
                  <tr>
                    <td class="item-col item">
                    </td>
                    
                    <td class="item-col item">
                    </td>
                    
                    
                    <td class="item-col quantity pull-right" style="text-align:right; padding-right: 20px; border-top: 1px solid #cccccc;">
                      
                      <span class="total-space">Subtotal</span> <br />
                      <span class="total-space">Tax(%)</span>  <br />
                      <span class="total-space">Shipping</span> <br />
                      <span class="total-space" style="font-weight: bold; color: #4d4d4d">Total</span>
                    </td>
                    <td class="item-col price" style="text-align: left; border-top: 1px solid #cccccc;">
                   
                      <span class="total-space">' . strip_tags($currency) . ' ' . strip_tags($totalPrice) . '</span>  <br />
                      <span class="total-space"> ' . strip_tags($currency) . ' ' . strip_tags(round($tax, 2)) . '</span>  <br />
                      <span class="total-space">' . strip_tags($currency) . ' ' . strip_tags($shipping) . '</span>  <br />';

                $grand = $totalPrice + $tax + $shipping;
                $message .= '
                      <span class="total-space" style="font-weight:bold; color: #4d4d4d"> ' . strip_tags($currency) . ' ' . strip_tags(round($grand, 2)) . '</span>
                    </td>
                  
                  </tr>  
                </table>
              </td>
            </tr>
        </table>
      </center>
    </td>
  </tr>
  <tr>
    <td align="center" valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">
      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          ';

                    $message .= file_get_contents('emailfoot.php');
                    
                $message .= '</tr></table>
</div>';
////////////fetching admin details for sending mails to admin on order ///////////////


$sqladmin = "SELECT * FROM `app_admin` ";
            $checkadmin = mysqli_query($conn, $sqladmin);
$records = mysqli_fetch_array($checkadmin, MYSQLI_ASSOC);
$adminmail=$records['email'];


/////////////////////////



                include 'mailconfig.php';
                $mail->Subject = "Order Confirmation Email For Food Ordering App Demo";
                $mail->AddAddress($user_email);
                $mail->AddCC($adminmail,'New order');
                if (!$mail->Send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                } else {
                    $minfo = array("success" => 'true', "message" => 'Order placed successfully');
                    $jsondata = json_encode($minfo);
                    print_r($jsondata);
                    mysqli_close($conn);
                    exit();
                }
            } else {
                $minfo = array("success" => 'false', "message" => 'Cart is empty');
                $jsondata = json_encode($minfo);
                print_r($jsondata);
                mysqli_close($conn);
                exit();
            }
        } else {
            $minfo = array("success" => 'false', "message" => 'Please verify your e-mail before adding item to your order');
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