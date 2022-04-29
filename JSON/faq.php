<?php

include'../config.php';


 $faq="SELECT *   FROM faq";
$faqquery=mysqli_query($conn, $faq);
while($resultfaq=mysqli_fetch_array($faqquery,MYSQLI_ASSOC)){

$faqtitle=$resultfaq['title'];
$faqdes=$resultfaq['description'];
$faqdes=htmlspecialchars_decode(str_replace("&quot;", "\"", $faqdes));


$faqdata=array("title"=>$faqtitle,"description"=>$faqdes);
}



echo json_encode($faqdata);
unset($faqdata);
mysqli_close($conn);



?>