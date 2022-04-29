<?php

include_once 'scripthead.php';

$res_name = $_POST['resname'];
$remove[] = "'";
$remove[] = '"';
$remove[] = "-"; // just as another example
$res_name = str_replace($remove, "", $res_name);
$res_address = $_POST['resaddress'];
$remove[] = "'";
$remove[] = '"';
$remove[] = "`"; // just as another example
$res_address = str_replace($remove, "", $res_address);
$res_des = htmlspecialchars($_POST['editor1']);
$res_phone = $_POST['resphone'];
$remove[] = "'";
$remove[] = '"';
$remove[] = "-"; // just as another example
$res_phone = str_replace($remove, "", $res_phone);
$res_lat = $_POST['reslat'];
$res_long = $_POST['reslong'];
$res_web = $_POST['resweb'];
$res_op = $_POST['resop'];




///now image upload and other queries////


$insertplacemain = "INSERT INTO res_details (resname,resaddress,resdes,resphone,reslat,reslong,resweb,resop) VALUES('" . $res_name . "','" . $res_address . "','" . $res_des . "','" . $res_phone . "','" . $res_lat . "','" . $res_long . "','" . $res_web . "','" . $res_op . "')";

$successmain = mysqli_query($conn, $insertplacemain);

$lastid = $conn->insert_id;






$targetFolder = "uploads/respic";




$errorMsg = array();
$successMsg = array();
foreach ($_FILES as $file => $fileArray) {

    if (!empty($fileArray['name']) && $fileArray['error'] == 0) {
        $getFileExtension = pathinfo($fileArray['name'], PATHINFO_EXTENSION);


        if (($getFileExtension == 'jpg') || ($getFileExtension == 'jpeg') || ($getFileExtension == 'png') || ($getFileExtension == 'gif')) {
            if ($fileArray["size"] <= 500000) {
                $breakImgName = explode(".", $fileArray['name']);
                $imageOldNameWithOutExt = $breakImgName[0];
                $imageOldExt = $breakImgName[1];

                $newFileName = strtotime("now") . "-" . str_replace(" ", "-", strtolower($imageOldNameWithOutExt)) . "." . $imageOldExt;


                $targetPath = $targetFolder . "/" . $newFileName;
                $targetorders = $targetorder . "/" . $newFileName;
                //$path=$serverimg.$targetFolder."/".$newFileName;

                if (move_uploaded_file($fileArray["tmp_name"], $targetPath)) {


                    $insertplacemain = "INSERT INTO res_images (res_id,image) VALUES('" . $last_id . "','" . $targetPath . "')";
                    $successmain = mysqli_query($conn, $insertplacemain);




                    if ($successmain) {
                        ?>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                        <script type="text/javascript">
                            swal({
                                title: "Restaurant Details filled ",
                                text: "Successfully.All Images Uploaded Successfully",
                                icon: "success", button: "close"
                            }).then(function () {
                        // Redirect the user
                                window.location.href = "viewresdetails.php";
                        //console.log('The Ok Button was clicked.');
                            });
                        </script>
                        <?php

                    } else {
                        $errorMsg[$file] = "Unable to save " . $file . " file ";
                    }
                } else {
                    $errorMsg[$file] = "Unable to save " . $file . " file ";
                }
            } else {
                $errorMsg[$file] = "Image size is too large in " . $file;
            }
        } else {
            $errorMsg[$file] = 'Only image file required in ' . $file . ' position';
        }
    }
}
?>

