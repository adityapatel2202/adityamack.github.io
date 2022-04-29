<?php 
require_once 'config.php';

if (empty($_SESSION['id']) && empty($_SESSION['name'])){
 


if(isset($_POST['submit'])){
	$user_email = $_POST['email'];
	$user_email=filter_var($user_email, FILTER_SANITIZE_EMAIL);
	$user_pwd = $_POST['password'];
	
	if(!empty($user_email) && !empty($user_pwd)){
		$query = mysqli_query($conn,"SELECT * FROM app_admin WHERE email='".$user_email."' AND password='".$user_pwd."'");

		if(mysqli_num_rows($query) > 0 && mysqli_num_rows($query) == 1){
			while($row = mysqli_fetch_array($query)){
				$_SESSION['id'] = $row['admin_id'];
				$_SESSION['name']=$row['name'];
                                $_SESSION['img']=$row['user_img'];
                                $_SESSION['email']=$row['email'];
				header("Location: dashboard.php");
			}
		}
		else{
			$msg = 'Invalid username or password';
			
		}
	}
	else{
		$msg = "Fields cannot be empty";
	}
}

?><!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Food Ordering App Admin</title>
  <link rel="stylesheet" href="loginpage/node_modules/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="loginpage/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
  <link rel="stylesheet" href="loginpage/css/style.css" />
  <link rel="shortcut icon" href="loginpage/images/favicon.png" />
</head>

<body>
      <div class="container-scroller">
         <div class="container-fluid">
            <div class="row">
               
               <div class="content-wrapper1 full-page-wrapper d-flex align-items-center auth-pages">
                  <div class="card col-lg-4 mx-auto">
                    <center><br><a class="navbar-brand brand-logo-mini" href="index.php"><img src="logo.png" height="100" width="250" /></a>
                     <div class="card-body px-5 py-5">
                     <form method="post">
                        
                        <font color="red"><?php if(isset($_POST['submit'])){ print_r($msg);}else{ ?></p>
    <p class="login-box-msg"><?php echo ' <i class="fa fa-arrow-circle-down" ></i>'; echo " Sign in below"; echo ' <i class="fa fa-arrow-circle-down" ></i>'; } ?></font>
                        </center>
                        
                      
                           <div class="form-group"> <input type="text" class="form-control p_input" placeholder="Email" name="email"> </div>
                           <div class="form-group"> <input type="password" class="form-control p_input" placeholder="Password" name="password"> </div>
                           <br><div class="text-center"> <input type="submit" class="btn btn-primary btn-block enter-btn" name="submit"  value="Login"> </div><br>
                           
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

  <script src="loginpage/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="loginpage/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="loginpage/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="loginpage/node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <script src="loginpage/js/misc.js"></script>
</body>

</html>
<?php }else{
     header("location:dashboard.php");
} ?>
