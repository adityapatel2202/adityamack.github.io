<?php 

include "config.php";

$id = $_POST['id'];


//echo $id;


$sql1="DELETE  FROM `products_extra` where id='".$id."'";
         
          $check1= mysqli_query($conn, $sql1);