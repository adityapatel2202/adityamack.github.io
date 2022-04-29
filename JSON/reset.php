<?php
include'../config.php';
$passkey = $_GET['passkey'];
$user_email=$_GET['email'];
//var_dump($user_email);
//var_dump($passkey);

if(!empty($passkey) && !empty($user_email)){
                
  $query = "SELECT `email`,`forgot` FROM `users` WHERE `email`='".$user_email."' AND `forgot`='".$passkey."'";
		$result = mysqli_query($conn,$query) or die(mysql_error());
                 $rowcount=mysqli_num_rows($result);
                 //var_dump($rowcount);
                 
                 if($rowcount > 0)
                 {
                $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
//                var_dump($rows);
                $emaildb=$rows['email'];
                $passkeydb=$rows['forgot'];
//                var_dump($passkeydb);
//                var_dump($emaildb);

if($passkey==$passkeydb && $emaildb==$user_email)
{
               ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
   
    <title>change password </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	.separator {
    border-right: 1px solid #dfdfe0; 
}
.icon-btn-save {
    padding-top: 0;
    padding-bottom: 0;
}
.input-group {
    margin-bottom:10px; 
}
.btn-save-label {
    position: relative;
    left: -12px;
    display: inline-block;
    padding: 6px 12px;
    background: rgba(0,0,0,0.15);
    border-radius: 3px 0 0 3px;
}
    </style>
</head>
<body>


<br>
<br>
<br>
<br>
<br>

  <center> 
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-th"></span>
                        Change your password   
                    </h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="<?php echo 'updatepass.php?passkey='.$passkey.'&email='.$user_email;?>">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 separator social-login-box"> <br>
                           <img alt="" class="img-thumbnail" src="../logo.png">                        
                        </div>
                         <h3 class="panel-title">
                        <span class="glyphicon glyphicon-th"></span>
                        Change your password   
                    </h3>
                        <div style="margin-top:80px;" class="col-xs-6 col-sm-6 col-md-6 login-box">
                         <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                              <input class="form-control" type="password" placeholder="New Password" name="password">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></div>
                              <input class="form-control" type="password" placeholder="Retype Password" name="newpass">
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6"></div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <button class="btn icon-btn-save btn-info" type="submit" name="submitbtn" value="submitbtn">
                            <span class="btn-save-label">Save Password</span><i class="	glyphicon glyphicon-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </form>
    <tr>
                                            <td valign="top" id="m_4647391242289122330footerContent" style="border-top:2px solid #f2f2f2;color:#484848;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;line-height:24px;padding-top:40px;padding-bottom:20px;text-align:center">
                                                <p style="color:#484848;font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:12px;font-weight:400;line-height:24px;padding:0;margin:0;text-align:center">© Abhi Demo, All Rights Reserved.<br> | F-352 Mohali Phase 8B Industrial Area</p>
                                                <a href="http://abhiandroid.com/contactus">Contact Us</a><span class="m_4647391242289122330mobileHide"> &nbsp; • &nbsp; </span><a href="http://abhiandroid.com/terms">Terms of Use</a><span class="m_4647391242289122330mobileHide"> &nbsp; • &nbsp; </span><a href="http://abhiandroid.com/privacy">Privacy Policy</a>
                                            </td>
                                        </tr>
    
    </div>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

</body>
</html>
    <?php } else {
               
            $minfo = array("Success"=>'false', "Message"=>'Invalid Code or E-Mail');
      $jsondata = json_encode($minfo);
      header("Location: resetfail.html");
      
    }
                 } else {
                     
                 $minfo = array("Success"=>'false', "Message"=>'Invalid Code or E-mail');
      $jsondata = json_encode($minfo);
              header("Location: resetfail.html");       
                 }
}else
{
    $minfo = array("Success"=>'false', "Message"=>'Empty field found ');
      $jsondata = json_encode($minfo);
      header("Location: resetfail.html");
}
print_r($jsondata);
$conn->close();
?> 
 
    
    