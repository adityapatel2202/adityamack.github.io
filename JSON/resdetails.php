<?php

include_once'../config.php';
$json = 0;
$images = null;




$sql = "SELECT  *  FROM `app_details` ";
$check = mysqli_query($conn, $sql);


$rowcur = mysqli_fetch_array($check, MYSQLI_BOTH);
$rescurrency = $rowcur['rescurrency'];
$restax = $rowcur['restax'];
$resminorder = $rowcur['resminorder'];
$resdelivery = $rowcur['delivery'];

$editcity = "SELECT * FROM res_city ";
$getcity = mysqli_query($conn, $editcity);
while ($city = mysqli_fetch_array($getcity)) {
    $city1[] = $city['pincode'];
}

$sql = "SELECT  *  FROM `res_details` ";
$check = mysqli_query($conn, $sql);


while ($row = mysqli_fetch_array($check, MYSQLI_BOTH)) {

    $des = $row['resdes'];
    $des = htmlspecialchars_decode(str_replace("&quot;", "\"", $des));

    $editimages = "SELECT * FROM res_images where res_id='" . $row['id'] . "'";
    $getproductimages = mysqli_query($conn, $editimages);

    while ($imagecounter = mysqli_fetch_array($getproductimages)) {


        $images[] = $serverimg . $imagecounter['image'];
    }


    $json = array("name" => $row['resname'], "address" => $row['resaddress'], "description" => $des, "phone" => $row['resphone'], "web" => $row['resweb'], "lat" => $row['reslat'], "lon" => $row['reslong'], "time" => $row['resop'], "tax" => $restax, "currency" => $rescurrency, "minorder" => $resminorder, "images" => $images, "deliverycity" => $city1);

    unset($images);
}


if ($json == 0) {


    $minfo = array("success" => 'false', "message" => 'Empty details');
    $jsondata = json_encode($minfo);
    print_r($jsondata);
    mysqli_close($conn);
    exit();
} else {

    $json1 = json_encode($json);

    print_r($json1);
}
mysqli_close($conn);
exit();
