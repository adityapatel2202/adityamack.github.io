<?php

include 'scripthead.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo '<script> alert("button pressed")</script>';



    $offeramount = $_POST['offer_amount'];
     $offertpercentage = $_POST['percentage'];
     $offerdes = htmlspecialchars($_POST['editor1']);
    $new = rand(99, 1000);
   $category_image = $_FILES['catimg']['name'];
//echo 'image is empty';
    $sql = "SELECT * FROM `app_offer` order by id DESC ";

    $check = mysqli_query($conn, $sql);


    $k = mysqli_fetch_array($check, MYSQLI_BOTH);

    $oldimage = $k['offer_image'];

    if (empty($category_image)) {



        $adminupdate = mysqli_query($conn, "UPDATE  app_offer SET offer_ini_amount='" . $offeramount . "',percentage='" . $offertpercentage . "',offer_image='" . $oldimage . "',terms='" . $offerdes . "'");
    ?>
    
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Offer Details Updated",
  text: "Successfully",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href = "addoffers.php";
//console.log('The Ok Button was clicked.');
});
</script>
    <?php } else {


        unlink($oldimage);



        $category_image = preg_replace('/\s/', '', $category_image);
        $target_dir = "uploads/offers/";
        $target_file = $target_dir . $new . preg_replace('/\s/', '', basename($_FILES["catimg"]["name"]));
        
        $uploadOk = 1;



        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
            //echo '$uploadOk';
        }

        if ($uploadOk == 0) {
            ?>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script type="text/javascript">
                swal({
                    title: "OOPS ",
                    text: "file Not Uploded",
                    icon: "error", button: "close"
                }).then(function () {
            // Redirect the user
            window.location.href = "addoffers.php";
            //console.log('The Ok Button was clicked.');
                });
            </script>

            <?php

// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["catimg"]["tmp_name"], $target_file)) {
                
                $adminupdate = mysqli_query($conn, "UPDATE  app_offer SET offer_ini_amount='" . $offeramount . "',percentage='" . $offertpercentage . "',offer_image='" . $target_file . "',terms='" . $offerdes . "'");
           ?>
            
            
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Offer Details & Image Updated",
  text: "Successfully",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href = "addoffers.php";
//console.log('The Ok Button was clicked.');
});
</script>
<?php
                } else {
               
                    echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}    