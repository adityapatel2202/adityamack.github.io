<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
include_once 'scripthead.php';

$id = $_GET['type'];
$id = base64_decode($id);
if($id=='simple')
{

unset($_SESSION['result']);

$title=$_POST['title'];
$msg=$_POST['msg'];
$place_id=$_POST['place'];

 $sql="SELECT * FROM `product_images` where product_id='".$place_id."' ";
         
          $check= mysqli_query($conn, $sql);
          $resultcheck= mysqli_fetch_array($check,MYSQLI_ASSOC);

$image=$resultcheck['image'];
$image=$serverimg.$image;
//echo $image;

$random=rand(0,999);
$data=array("title"=>$title,"message"=>$msg,"image"=>$image,"product_id"=>$place_id,"random_id"=>$random);
//echo '<font color="white">'; var_dump($data);
////////////////////////////////GETTING DEVICE DATA///////////////////////////////////


$sql="SELECT * FROM `devices`";
         
          $checkdevices= mysqli_query($conn, $sql);
         
$DeviceIdsArr= array();
//Prepare device ids array
while($rowData = mysqli_fetch_array($checkdevices,MYSQLI_ASSOC)) {
    $DeviceIdsArr[] = $rowData['token'];
}

///////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////SENDING CNOTIFICATION//////////////////////////////////////////


require_once("fcm.php");
 
$fcm = new Fcm();//Create Fcm class object
 
$dataArr = array();
$dataArr['device_id'] = $DeviceIdsArr;//fcm device ids array which is created previously
$dataArr['message'] = $data['message'];//Message which you want to send
$dataArr['image'] = $data['image']; 
$dataArr['title'] = $data['title'];
$dataArr['product_id'] = $data['product_id'];
$dataArr['random_id']=$data['random_id'];
//Send Notification
//var_dump($dataArr);
$fcm->sendNotification($dataArr);
//var_dump($_SESSION['result']);
//var_dump($_SESSION['resulttry']);
$results[]=json_decode($_SESSION['result']);
//var_dump($success=$results[0]->success);
 
if($success!='' || $success=='' || $success==0){?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script type="text/javascript">
   swal({
 title: "Notification sent",
  text: "successfully ",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href = "notification.php";
//console.log('The Ok Button was clicked.');
});
   </script>
<?php }


}



if($id=='custom')

{

$title=$_POST['title'];
$msg=$_POST['msg'];
$product_id=$_POST['place'];
$random=rand(0,999);
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["catimg"]["name"]);

$image=$serverimg.$target_dir.basename($_FILES["catimg"]["name"]);

if (move_uploaded_file($_FILES["catimg"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded."; 
    } else {
        //echo "Sorry, there was an error uploading your file."; 
    }

$data=array("title"=>$title,"message"=>$msg,"image"=>$image,"product_id"=>$product_id,"random_id"=>$random);
//echo '<font color="white">'; var_dump($data);


$sql="SELECT * FROM `devices`";
         
          $checkdevices= mysqli_query($conn, $sql);
         
$DeviceIdsArr= array();
//Prepare device ids array
while($rowData = mysqli_fetch_array($checkdevices,MYSQLI_ASSOC)) {
    $DeviceIdsArr[] = $rowData['token'];
}

///////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////SENDING CNOTIFICATION//////////////////////////////////////////


require_once("fcm1.php");
 
$fcm = new Fcm();//Create Fcm class object
 
$dataArr = array();
$dataArr['device_id'] = $DeviceIdsArr;//fcm device ids array which is created previously
$dataArr['message'] = $data['message'];//Message which you want to send
$dataArr['image'] = $data['image']; 
$dataArr['title'] = $data['title'];
$dataArr['product_id'] = $data['product_id'];
$dataArr['random_id']=$data['random_id'];
//Send Notification
$fcm->sendNotification($dataArr);
//var_dump($_SESSION['result']);
$results[]=json_decode($_SESSION['result']);
//var_dump($success=$results[0]->success);
 
if($success!='' || $success=='' || $success==0){?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script type="text/javascript">
   swal({
 title: "Notification sent",
  text: "successfully ",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href = "notification.php";
//console.log('The Ok Button was clicked.');
});
   </script>
<?php }
}
}
?>