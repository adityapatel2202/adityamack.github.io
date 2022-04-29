<?php

include'../config.php';


 $faq="SELECT *   FROM policy";
$faqquery=mysqli_query($conn, $faq);
while($resultfaq=mysqli_fetch_array($faqquery,MYSQLI_ASSOC)){


$faqdata=$resultfaq['terms'];
$faqdata=htmlspecialchars_decode(str_replace("&quot;", "\"", $faqdata));


}



$faqdata=json_encode(array("terms"=>$faqdata));
print_r($faqdata);
mysqli_close($conn);



?>