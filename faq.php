<?php include_once 'scripthead.php';?>
<?php include_once 'sidebar.php';?>
<?php include_once 'tophead.php';?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$title=$_POST['name'];
        $remove[] = "'";
        $remove[] = '"';
        $remove[] = "-"; // just as another example
        $title = str_replace( $remove, "", $title ); 


$des=htmlspecialchars($_POST['editor1']);

$sql1="UPDATE `faq` SET title='".$title."', description='".$des."'";
$update_admin = mysqli_query($conn,$sql1);
if($update_admin){
    ?>
      
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
    swal({
  title: "FAQ Updated ",
  text: "Successfully",
  icon: "success",button: "close"
}).then(function() {
// Redirect the user
window.location.href = "faq.php";
//console.log('The Ok Button was clicked.');
});
</script>

<?php
               } else {
                            
                     echo 'query fail';
echo 'window.location.href = "faq.php"';

                        
                        }
   //exit();
}else{ 

?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Offers</h3>
              </div>

              
            </div>

            <div class="clearfix"></div>
<br>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2> Offer Details</h2>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                     <?php $faq="SELECT *  FROM faq";
$faqquery=mysqli_query($conn, $faq);
$resultfaq=mysqli_fetch_array($faqquery,MYSQLI_ASSOC);?>

<form role="form" method="POST" enctype="multipart/form-data"  >
                <!-- text input -->
                <div class="form-group">
                  <label>Title:</label>
                  <input type="text" class="form-control" placeholder="Enter Title" name="name" required value="<?php echo $resultfaq['title']; ?>">
                </div>
                
                
                <div class="form-group">
                  <label>Description:</label>
                   
								<textarea name="editor1" id="editor1" rows="10" cols="80">
								<?php echo $resultfaq['description']; ?>	
								</textarea>
								<script src="ckeditor/ckeditor.js"></script>
								<script>
									// Replace the <textarea id="editor1"> with a CKEditor
									// instance, using default configuration.
									
									CKEDITOR.replace( 'editor1' );
								</script>
							</div>

<div class="box-footer">
                   <input type="submit" class="btn btn-primary pull-right" value="Update FAQ" name="addfaq" id="postme"  title='Fill all the deatails completely'>

              </div>
              </form>
            </div>
            </div>
            </div>

<?php include'scriptfooter.php';?><?php }?>