<?php
include_once'scripthead.php';


$id = $_GET['id'];
$id = base64_decode($id);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {




//echo $id;


    $sql = "SELECT * FROM `app_productsmain` where id='" . $id . "'";

    $check = mysqli_query($conn, $sql);
    $k = mysqli_fetch_array($check, MYSQLI_BOTH);
    $product_id = $k['product_id'];
    $primary_image = $k['primary_image'];

$sql1 = "DELETE  FROM `products_variant` where product_id='" . $product_id . "'";

    $check1 = mysqli_query($conn, $sql1); 
 



$sql = "DELETE  FROM `app_products` where product_id='" . $product_id . "'";

    $check = mysqli_query($conn, $sql);


    $sql1 = "DELETE  FROM `products_extra` where product_id='" . $product_id . "'";

    $check1 = mysqli_query($conn, $sql1); 



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
    $createdate = date('Y-m-d H:i:s');
    $dat = $createdate;
    $variant = array();
    $variant = $_POST['vname'];
    $product_limit = $_POST['plimit'];
    $variantprice = array();
    $variantprice = $_POST['vprice'];
$rec=$_POST['rec'];
/////filtering array for empty values///////////////////////////////////////
if(!empty($variant) && !empty($variantprice)){
    $variant = array_filter($variant, function($value) {
        return $value !== '';
    });


    $variantprice = array_filter($variantprice, function($value) {
        return $value !== '';
    });

}

if(!empty($extra) && !empty($extraprice)){
    $extra = array_filter($extra, function($value) {
        return $value !== '';
    });


    $extraprice = array_filter($extraprice, function($value) {
        return $value !== '';
    });

}
 
///////////////////////////////checking value in array ////////////////////////////////////////////////
//print_r($variant);
//print_r($variantprice);
//print_r($extra);
//print_r($extraprice);
//////////////////////////////////////////////////////////////////////////////////
 


    foreach ($category as $cat_id) {

         $insertplace = "INSERT INTO app_products(product_id,product_name,description,product_status,date,cat_id,primary_image,plimit) VALUES('" . $product_id . "','" . $product_name . "','" . $product_des . "','" . $product_status . "','" . $dat . "','" . $cat_id . "','" . $primary_image . "' ,'".$product_limit."')";

        $success = mysqli_query($conn, $insertplace);
    }

if(!empty($variant) && !empty($variantprice)){
    $variantfinal = array_combine($variant, $variantprice);
}


    if(!empty($extra) && !empty($extraprice)){
$extrafinal = array_combine($extra, $extraprice);
 }



    if (isset($variantfinal)) {


        foreach ($variantfinal as $key => $values) {


             $insertplace = "INSERT INTO products_variant(product_id,variant_name,variant_price) VALUES('" . $product_id . "','" . $key . "','" . $values . "') ";
            $success = mysqli_query($conn, $insertplace);
        }
    }




    if (isset($extrafinal)) {


        foreach ($extrafinal as $key => $values) {


            $insertplace = "INSERT INTO products_extra(product_id,extra_name,extra_price) VALUES('" . $product_id . "','" . $key . "','" . $values . "')";
            $success = mysqli_query($conn, $insertplace);
        }
    }

if($rec==1){ $sql1="DELETE  FROM `app_productsrec` where product_id='".$product_id."'";
         
          $check1= mysqli_query($conn, $sql1);  


$insertplacemain = "INSERT INTO app_productsrec (product_id,product_name,description,product_status,date,primary_image,plimit) VALUES('" . $product_id. "','" . $product_name . "','" . $product_des . "','" . $product_status . "','" . $dat . "','" . $primary_image . "','".$product_limit."')";

            $success = mysqli_query($conn, $insertplacemain); }

if($rec==0){ $sql1="DELETE  FROM `app_productsrec` where product_id='".$product_id."'";
         
          $check1= mysqli_query($conn, $sql1); }

   $insertplacemain = "UPDATE app_productsmain SET product_name='" . $product_name . "',description='" . $product_des . "',product_status='" . $product_status . "',date='" . $dat . "',primary_image='" . $primary_image . "',plimit='".$product_limit."' WHERE product_id='" . $product_id . "'";

    $success = mysqli_query($conn, $insertplacemain);
    $_SESSION['message'] = 'All details Updated Successfully';
    if ($success) {
        ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">
            swal({
                title: "Item Edited",
                text: "Successfully.All Details Updated Successfully.",
                icon: "success", button: "close"
            }).then(function () {
        // Redirect the user
                window.location.href = "editproductsdetails.php?id=<?php echo base64_encode($id); ?>";
        //console.log('The Ok Button was clicked.');
            });
        </script><?php
    }
}
