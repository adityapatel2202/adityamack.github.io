<?php include_once 'scripthead.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'tophead.php'; ?>
<?php include_once 'widget.php'; ?>



<?php
$query = "SELECT * FROM users_orders order by id DESC limit 0,10";
$result = mysqli_query($conn, $query);
$chart_data = '';

while ($row = mysqli_fetch_array($result)) {

    $day=date("d",strtotime($row['order_date'])); 
$month = date("F",strtotime($row['order_date']));
    $chart_data .= "{ DAY:'" . $month . "', OrderAmount:" . $row["total"] . "}, ";
}





$chart_data = substr($chart_data, 0, -2);
//print_r( $chart_data);


$queryfood = "SELECT * FROM app_productsmain order by id DESC limit 0,5";
$resultfood = mysqli_query($conn, $queryfood);



?>




<div class="row">
    <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Sale graph of Last 10 Orders</h2>



                <div class="clearfix"></div>
            </div>
            <div class="x_content">
<?php if(empty($chart_data)){ ?>
<div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron">
                      <h1>No order yet</h1>
                      <p>Best of Luck for your first order</p>
                    </div>
                  </div>
<?php }else{ ?>

                <div id="chart">      </div>
<?php } ?>
            </div>



        </div>
    </div>  

<div class="col-md-3 col-sm-12 col-xs-12">
                      <div>
                        <div class="x_title">
                          <h2>Latest Menu Item</h2>
                          
                            
                           
                        
                          <div class="clearfix"></div>
                        </div>
                        <ul class="list-unstyled top_profiles scroll-view">
                          
                          <?php while($productdata=mysqli_fetch_array($resultfood)){ $id=base64_encode($productdata['id']);?>
                          <li class="media event">
                            
                              <img  class="pull-left border-aero profile_thumb" src="<?php echo $productdata['primary_image'];?>" alt="item" height="50">
                            </a>
                            <div class="media-body">
                              <a class="title" href="viewproductsdetails.php?id=<?php echo $id;?>"><?php echo $productdata['product_name'];?></a>
                              <p><strong><?php echo $productdata['product_status'];?>. </strong> </p>
                              
                              </p>
                            </div>
                          </li>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>

</div>


</div>  
</div>
</div>        
</div>
</div>  






<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script>
    Morris.Bar({
        element: 'chart',
        data: [<?php echo $chart_data; ?>],
        labels: ['Payment status'],
        xkey: 'DAY',
        ykeys: ['OrderAmount'],
        labels: ['Order Amount'],
        hideHover: 'auto',
        stacked: true,

    });
</script>


<?php include_once 'scriptfooter.php'; ?>