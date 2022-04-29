<?php

include_once 'scripthead.php';

$id = $_GET['id'];
$id = base64_decode($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$sql="SELECT * FROM `app_productsmain` where id='".$id."'";
         
          $check= mysqli_query($conn, $sql);
$k=mysqli_fetch_array($check,MYSQLI_BOTH);

 $pid=$k['product_id'];

    $targetFolder = "uploads/products";
    $targetorder = "uploads/order";
   
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


                        $insertplacemain = "INSERT INTO product_images (product_id,image) VALUES('" . $pid . "','" . $targetPath . "')";
                        $successmain = mysqli_query($conn, $insertplacemain);


$_SESSION['message']='Optional Images Uploaded Successfully';

                        if ($successmain) {
                            ?>
                            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                            <script type="text/javascript">
                                swal({
                                    title: "Optional Images Added ",
                                    text: "Successfully.All Image Upload complete.",
                                    icon: "success", button: "close"
                                }).then(function () {
                            // Redirect the user
                                    window.location.href = "editproductsdetails.php?id=<?php echo base64_encode($id); ?>";
                            //console.log('The Ok Button was clicked.');
                                });
                            </script>
                            <?php

                        } else {
                            $_session['message'] = "Unable to save " . $file . " file ";
                        }
                    } else {
                       $_session['message'] = "Unable to save " . $file . " file ";
                    }
                } else {
                    $_session['message'] = "Image size is too large in " . $file;
                }
            } else {
                $_session['message'] = 'Only image file required in ' . $file . ' position';
            }
        }
    }
}
