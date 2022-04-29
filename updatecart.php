<?php 

include '../config.php';


$cartquantity=$_POST['cartquantity'];
$iteam_id=$_POST['iteamid'];




if( !empty($iteam_id)){
                
            
            
                        
                         $querycart = "SELECT * FROM `users_cart` WHERE `id`='".$iteam_id."'";
        
		$resultcart = mysqli_query($conn,$querycart);
		$rowcount=mysqli_num_rows($resultcart);
		//echo $rowcount;
		//exit();
		if($rowcount!=0){
                    while($catrows=mysqli_fetch_array($resultcart,MYSQLI_ASSOC)){
                    //var_dump($catrows); 
                    //exit();
                  if($cartquantity==0){ $sql="DELETE  FROM `users_cart` WHERE `id`='".$iteam_id."'";
$check= mysqli_query($conn, $sql);
$minfo = array("success"=>'true', "message"=>'Product removed from your cart successfully');
      $jsondata = json_encode($minfo);  print_r($jsondata);  mysqli_close($conn); exit();  }
                       
                       
                       
                       
                        if($iteam_id==$catrows['id']  ) { 
                        
                        
                         $query="UPDATE `users_cart` SET quantity='".$cartquantity."' where id='".$iteam_id."'";
                        $result = mysqli_query($conn,$query); 
                        $minfo = array("success"=>'true', "message"=>'Product quantity successfully updated',"cartid"=>$catrows['cart_id']);
      $jsondata = json_encode($minfo);  print_r($jsondata);  mysqli_close($conn); exit();
            
                        }
                        
                      
                               
                      
            
                } }else{ $minfo = array("success"=>'notactive', "message"=>'Empty cart.');
      $jsondata = json_encode($minfo); print_r($jsondata);  mysqli_close($conn); exit();}
            
                
}else
        {$minfo = array("success"=>'false', "message"=>'Empty field either userid or product');
      $jsondata = json_encode($minfo); print_r($jsondata);  mysqli_close($conn); exit();
        }
 print_r($jsondata);
$conn->close();