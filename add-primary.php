<?php 
include_once 'scripthead.php';

$id = $_GET['id'];
$id = base64_decode($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//print_r($_POST);

$sql = "SELECT * FROM `app_productsmain` where id='".$id."'";

    $check = mysqli_query($conn, $sql);
    $pdata=mysqli_fetch_array($check,MYSQLI_ASSOC);
    $product_id=$pdata['product_id'];
    $old=$pdata['primary_image'];
    
    
    
    
$new=rand(99,1000);
$primary_image = $_FILES['primary']['name'];

$primary_image=preg_replace('/\s/', '',$primary_image);
$target_dir = "uploads/primary/";
$target_file = $target_dir . $new.preg_replace('/\s/', '',basename($_FILES["primary"]["name"]));
$target_file1= $serveradd.$target_file;
$uploadOk = 1;
//var_dump($target_file);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//var_dump($imageFileType);
//var_dump($uploadOk);

// Check if file already exists
//if (file_exists($target_file)) {
   // echo "Sorry, file already exists.";
   // $uploadOk = 0;
//}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    //echo $uploadOk;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   ?>
         <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "OOPS ",
  text: " primary file Not Uploded",
  icon: "error",button: "close"
}).then(function() {
// Redirect the user
//window.location.href = "additem.php";
//console.log('The Ok Button was clicked.');
});
</script>
        
        <?php
// if everything is ok, try to upload file
} else{ 
    move_uploaded_file($_FILES["primary"]["tmp_name"], $target_file);
        
         

         $insertplacemain = "UPDATE app_productsmain Set primary_image='".$target_file."' where id='".$id."'";

        $success = mysqli_query($conn, $insertplacemain);

        
 $insertplacemain = "UPDATE app_products Set primary_image='".$target_file."' where product_id='".$product_id."'";

        $success = mysqli_query($conn, $insertplacemain);

unset($_SESSION['message']);
$_SESSION['message']='Primary Image Updated Successfully';

unlink($old);
        
        }?>
        
        
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">
            swal({
                title: "Primary Image Updated",
                text: "Successfully",
                icon: "success", button: "close"
            }).then(function () {
        // Redirect the user
                window.location.href = "editproductsdetails.php?id=<?php echo base64_encode($id);?>";
        //console.log('The Ok Button was clicked.');
            });
        </script>
        
        
        
        
        
        <?php
        }
