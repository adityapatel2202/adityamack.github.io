<?php

include_once'scripthead.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//echo 'button pressed';
    //echo '<pre>';
    //print_r($_POST);

    $product_name = $_POST['name'];
    $product_des = htmlspecialchars($_POST['editor1']);
    $category = array();
    $category = $_POST['chk'];
    $product_status = $_POST['product_status'];
    $remove[] = "'";
    $remove[] = '"';
    $remove[] = "-"; // just as another example
    $product_status = str_replace($remove, "", $product_status);
    $createdate = date('Y-m-d H:i:s');
    $dat = $createdate;
    $extra = array();
    $extra = $_POST['extra'];
    $extraprice = array();
    $extraprice = $_POST['extraprice'];
    $rec = $_POST['rec'];
    $variant = array();
    $variant = $_POST['vname'];

    $variantprice = array();
    $variantprice = $_POST['vprice'];
    $product_limit=$_POST['plimit'];
/////filtering array for empty values///////////////////////////////////////
   
 $variant = array_filter($variant, function($value) {
        return $value !== '';
    });


    $variantprice = array_filter($variantprice, function($value) {
        return $value !== '';
    });




    $extra = array_filter($extra, function($value) {
        return $value !== '';
    });


    $extraprice = array_filter($extraprice, function($value) {
        return $value !== '';
    });

    


///////////////////////////////checking value in array ////////////////////////////////////////////////
//print_r($variant);
 //print_r($variantprice);
 //print_r($extra);
 //print_r($extraprice);
//////////////////////////////////////////////////////////////////////////////////
    //if (isset($extra)) {
//echo 'khsli hai ';//logic to check emty array;
   // }

  //$variantfinal = array_combine($variant, $variantprice);
        //$extrafinal = array_combine($extra, $extraprice);

//print_r($variantfinal);
//print_r($extrafinal);
//exit();
///////////////////////////////////////////////////   



    $sql = "SELECT * FROM `app_productsmain` ";

    $check = mysqli_query($conn, $sql);
    //$count = $check->num_rows;
//echo $count;

    foreach ($check as $checkcat) {
        if ($checkcat['product_name'] == $product_name) {
            $ok = 1;
        } else {
            $ok = 0;
        }
    }

    if ($ok == 1) {
        ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">
            swal({
                title: "Item Already Exist ",
                text: "Choose a different name",
                icon: "error", button: "close"
            }).then(function () {
                // Redirect the user
                window.location.href = "additem.php";
                //console.log('The Ok Button was clicked.');
            });
        </script>
        <?php

    } else {






        $new = rand(99, 1000);
        $primary_image = $_FILES['primary']['name'];
        $primary_image = preg_replace('/\s/', '', $primary_image);
        $target_dir = "uploads/primary/";
        $target_file = $target_dir . $new . preg_replace('/\s/', '', basename($_FILES["primary"]["name"]));
        $target_file1 = $serveradd . $target_file;
        $uploadOk = 1;
//var_dump($target_file);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
//var_dump($imageFileType);
//var_dump($uploadOk);
// Check if file already exists
//if (file_exists($target_file)) {
        // echo "Sorry, file already exists.";
        // $uploadOk = 0;
//}
// Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
            echo '$uploadOk';
        }
// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script type="text/javascript">
                   swal({
                       title: "OOPS ",
                       text: " primary file Not Uploded",
                       icon: "error", button: "close"
                   }).then(function () {
            // Redirect the user
            //window.location.href = "additem.php";
            //console.log('The Ok Button was clicked.');
                   });
            </script>

            <?php

// if everything is ok, try to upload file
        } else
            move_uploaded_file($_FILES["primary"]["tmp_name"], $target_file);

        $pid = rand(500, 10000);

        $insertplacemain = "INSERT INTO app_productsmain (product_id,product_name,description,product_status,date,primary_image,plimit) VALUES('" . $pid . "','" . $product_name . "','" . $product_des . "','" . $product_status . "','" . $dat . "','" . $target_file . "','".$product_limit."')";

        $success = mysqli_query($conn, $insertplacemain);

        $lastid = $conn->insert_id;

        if ($rec == 1) {
            $insertplacemain = "INSERT INTO app_productsrec (product_id,product_name,description,product_status,date,primary_image,plimit) VALUES('" . $pid . "','" . $product_name . "','" . $product_des . "','" . $product_status . "','" . $dat . "','" . $target_file . "','".$product_limit."')";

            $success = mysqli_query($conn, $insertplacemain);

            $lastid = $conn->insert_id;
        }



        foreach ($category as $cat_id) {

            $insertplace = "INSERT INTO app_products(product_id,product_name,description,product_status,date,cat_id,primary_image,plimit) VALUES('" . $pid . "','" . $product_name . "','" . $product_des . "','" . $product_status . "','" . $dat . "','" . $cat_id . "','" . $target_file . "','".$product_limit."')";
//echo'<pre>';var_dump($insertplace);
//exit();
            $success = mysqli_query($conn, $insertplace);
        }







        $variantfinal = array_combine($variant, $variantprice);
        $extrafinal = array_combine($extra, $extraprice);



        if (isset($variantfinal)) {


            foreach ($variantfinal as $key => $values) {



                $insertplace = "INSERT INTO products_variant(product_id,variant_name,variant_price) VALUES('" . $pid . "','" . $key . "','" . $values . "')";
                $success = mysqli_query($conn, $insertplace);
            }
        }



        if (isset($extrafinal)) {


            foreach ($extrafinal as $key => $values) {



                $insertplace = "INSERT INTO products_extra(product_id,extra_name,extra_price) VALUES('" . $pid . "','" . $key . "','" . $values . "')";
                $success = mysqli_query($conn, $insertplace);
            }
        }






        $targetFolder = "uploads/products";

        $errorMsg = array();
        $successMsg = array();
        foreach ($_FILES as $file => $fileArray) {

            if (!empty($fileArray['name']) && $fileArray['error'] == 0) {
                $getFileExtension = pathinfo($fileArray['name'], PATHINFO_EXTENSION);
                ;

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


                            $insertplacemain = "INSERT INTO product_images (product_id,image) VALUES('" . $pid . "','" . $targetPath . "')";
                            $successmain = mysqli_query($conn, $insertplacemain);






                            if ($success) {
                                ?>
                                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                                <script type="text/javascript">
                                swal({
                                title: "Menu Item Added  ",
                                text: "Successfully.All Image Upload complete.",
                                icon: "success", button: "close"
                                }).then(function () {
                                // Redirect the user
                                window.location.href = "additem.php";
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
            } else {
                ?>

                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                <script type="text/javascript">
                swal({
                title: "Menu Item Added  ",
                text: "Successfully.",
                icon: "success", button: "close"
                }).then(function () {
                // Redirect the user
                window.location.href = "additem.php";
                //console.log('The Ok Button was clicked.');
                });
                </script>

                <?php

            }
        }
    }
}

