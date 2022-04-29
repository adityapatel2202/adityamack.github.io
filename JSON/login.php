<?php
include '../config.php';
        $user_email = $_POST['email'];
	//$user_email=filter_var($user_email, FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];
	$password =md5($password);
	if(!empty($username) && !empty($password)){
                
            
            $query = "SELECT * FROM `users` WHERE `email`='".$user_email."'";
        
		$result = mysqli_query($conn,$query) or die(mysql_error());
                $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
                //var_dump($query);
               //var_dump($rows);
        
                $userid=$rows['id'];

                $codecheck=$rows['com_code'];
                //var_dump($codecheck);
                if($user_email==$rows['email'] && $password==$rows['password'])
                {

                if(empty($codecheck))
                        {
            $minfo = array("success"=>'true', "message"=>'Log in successfully',"userid"=>$userid);
      $jsondata = json_encode($minfo);
            }
            
            else
            {
                if(!empty($codecheck)){
                    
                
             $minfo = array("success"=>'notactive', "message"=>'Account verification is pending. Please confirm your email.',"userid"=>$userid);
      $jsondata = json_encode($minfo);
                    } 
            }
            
                }else
                {
                if($user_email==$rows['email']){
                    $minfo = array("success"=>'false', "message"=>'Invalid email or password');
      $jsondata = json_encode($minfo); 
        }else
        {
        $minfo = array("success"=>'false', "message"=>'Account does not exist. Please signup');
      $jsondata = json_encode($minfo); 
        }
                }
        }else
        {
            echo 'empty fileds';
             $minfo = array("success"=>'false', "message"=>'Empty field either username or password');
      $jsondata = json_encode($minfo);
            
        }
 print_r($jsondata);
$conn->close();
?>