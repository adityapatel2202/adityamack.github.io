<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$des=htmlspecialchars($_POST['editor0']);

$sql1="UPDATE `policy` SET terms='".$des."'";
$update_admin = mysqli_query($conn,$sql1);
if($update_admin){
    ?>
      
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "Terms Updated ",
  text: "Successfully",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href = "policy.php";
//console.log('The Ok Button was clicked.');
});
</script>
<?php
}
}
  ?>





<?php
$policy = "SELECT * FROM  `policy`";

$result = mysqli_query($conn, $policy);

$row = mysqli_fetch_assoc($result);
?>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Terms & Conditions</h3>
            </div>


        </div>

        <div class="clearfix"></div>
        <br>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> TERMS & Condition Details</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                       
                                   
                                            <form role="form" method="POST" enctype="multipart/form-data"  >
                                                <!-- text input -->



                                                <div class="form-group">
                                                    <center> <label>Terms & Conditions</label></center>

                                                    <textarea name="editor0" id="editor0" rows="10" cols="80">
                                                        <?php echo $row['terms']; ?>	
                                                    </textarea>
                                                    <script src="ckeditor/ckeditor.js"></script>
                                                    <script>
                                                        // Replace the <textarea id="editor1"> with a CKEditor
                                                        // instance, using default configuration.

                                                        CKEDITOR.replace('editor0');
                                                    </script>
                                                </div>

                                                <div class="box-footer">
                                                    <input type="submit" class="btn btn-primary pull-right" value="Update Terms & Conditions" name="addterm" id="postme"  title='Fill all the deatails completely'>

                                                </div>
                                           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include_once'scriptfooter.php'; ?>
