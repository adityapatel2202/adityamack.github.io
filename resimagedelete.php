<?php 
 include 'config.php';



$imageid= $_POST['post_id'];

$editimages="SELECT * FROM res_images where id='".$imageid."'";
$getproductimages=mysqli_query($conn, $editimages);
$resultofeditimage= mysqli_fetch_array($getproductimages,MYSQLI_ASSOC);

$imgpath=$resultofeditimage['image'];


$imgpath=str_replace($serverimg,'',$imgpath);
 
$query="DELETE FROM `res_images` where id='".$imageid."' ";
          $result=mysqli_query($conn,$query) or die("not Deleted". mysql_error());
          if($result==TRUE)
                                    {
              unlink($imgpath);
              ?>


         <?php }
          ?>