<?php

include 'scripthead.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //echo 'button pressed';

$oldimg=$rowadmin['user_img'];

    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
$email = $_POST['email'];

    $new = rand(99, 1000);
    $category_image = $_FILES['catimg']['name'];
    if(!empty($category_image)){
    $category_image = preg_replace('/\s/', '', $category_image);
    $target_dir = "uploads/admin/";
    $target_file = $target_dir . $new . preg_replace('/\s/', '', basename($_FILES["catimg"]["name"]));
    $target_file1 = $serverimg . $target_file;
    $uploadOk = 1;
    
    //echo'<pre>'. $target_file;
    //exit();
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
        //echo '$uploadOk';
    }
// Check if $uploadOk is set to 0 by an error
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
        //window.location.href = "category.php";
        //console.log('The Ok Button was clicked.');
            });
        </script>

        <?php

// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["catimg"]["tmp_name"], $target_file)) {
            

$adminupdate= mysqli_query($conn,"UPDATE  app_admin SET name='".$name."',address='".$address."',phone='".$phone."',user_img='".$target_file."',email='".$email."'");
unlink($oldimg);
?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Admin Details Updated",
  text: "Successfully",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href = "profile.php";
//console.log('The Ok Button was clicked.');
});
</script>
<?php
        
        //echo "The file ". basename( $_FILES["catimg"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


    }else{
    $adminupdate= mysqli_query($conn,"UPDATE  app_admin SET name='".$name."',address='".$address."',phone='".$phone."',email='".$email."'");
    
 }?>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Admin Details Updated",
  text: "Successfully",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href = "profile.php";
//console.log('The Ok Button was clicked.');
});
</script><?php
 }





            