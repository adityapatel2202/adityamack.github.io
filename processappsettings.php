<?php
include_once'scripthead.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    // print_r($_POST);
    $resimage = $_POST['imagehandel'];
    $restax = $_POST['restax'];
    $rescurrency = $_POST['currency'];
    $resminorder = $_POST['resminorder'];
    $resdelivery = $_POST['delivery'];
    $pin = array();
    $pin = $_POST['pin'];
    //print_r($pin);

//exit();
$sql = "DELETE  FROM `res_city` ";

        $check = mysqli_query($conn, $sql);

    foreach ($pin as $pincode) {
        

        $insertplace = "INSERT INTO res_city(pincode) VALUES('" . $pincode . "')";

        $success = mysqli_query($conn, $insertplace);
    }

    $insertplacemain = "UPDATE app_details SET imagehandel='" . $resimage . "',restax='" . $restax . "',rescurrency='" . $rescurrency . "',resminorder='" . $resminorder . "',delivery='" . $resdelivery . "'";
    $successmain = mysqli_query($conn, $insertplacemain);

    if ($successmain == TRUE) {
        ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">
            swal({
                title: "Main Settings Updated ",
                text: "Successfully.",
                icon: "success", button: "close"
            }).then(function () {
        // Redirect the user
                window.location.href = "appsettings.php";
        //console.log('The Ok Button was clicked.');
            });
        </script>
        <?php

    }
}
?>