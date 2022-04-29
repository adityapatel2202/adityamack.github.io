<?php include_once'scripthead.php';


$id = $_GET['id'];
$id = base64_decode($id);


//echo $id;


 $sql="SELECT * FROM `app_productsmain` where id='".$id."'";
         
          $check= mysqli_query($conn, $sql);

$k=mysqli_fetch_array($check,MYSQLI_BOTH);
$product_id=$k['product_id'];
$primary_image=$k['primary_image'];
 

 $sqlimage="SELECT * FROM `product_images` where product_id='".$product_id."'";
         
          $checkimg= mysqli_query($conn, $sqlimage);
          
          $imagecounter = mysqli_num_rows($checkimg);
          //echo $imagecounter;
          
          if($imagecounter>0){
          
         while( $img=mysqli_fetch_array($checkimg,MYSQLI_BOTH)){
 unlink($img['image']); }
}





 $sql1="DELETE  FROM `product_images` where product_id='".$product_id."'";
         
          $check1= mysqli_query($conn, $sql1);



  $sql1="DELETE  FROM `products_variant` where product_id='".$product_id."'";
         
          $check1= mysqli_query($conn, $sql1);


 $sql1="DELETE  FROM `products_extra` where product_id='".$product_id."'";
         
          $check1= mysqli_query($conn, $sql1);



 $sql="DELETE  FROM `app_products` where product_id='".$product_id."'";
         
          $check= mysqli_query($conn, $sql);


  $sql1="DELETE  FROM `app_productsmain` where product_id='".$product_id."'";
         
          $check1= mysqli_query($conn, $sql1);

$sql1="DELETE  FROM `app_productsrec` where product_id='".$product_id."'";
         
          $check1= mysqli_query($conn, $sql1);

//print_r($check1);

if($check1){ ?>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                                <script type="text/javascript">
                                    swal({
                                        title: "Menu Item Deleted  ",
                                        text: "Successfully.All Images Deleted.",
                                        icon: "success", button: "close"
                                    }).then(function () {
                                // Redirect the user
                                        window.location.href = "menuitem.php";
                                //console.log('The Ok Button was clicked.');
                                    });
                                </script>


<?php } ?>
