  <?php

//include_once '../config.php';

require_once('stripe-php-master/init.php');


$amount = round($_REQUEST['amount'] * 100);
$currency = $_REQUEST['currency'];
$publishable = 'pk_test_lAH1SPKJiLVB7y5rmQMuZDIz0020DtMorS';

\Stripe\Stripe::setApiKey('sk_test_Uk7NjCuw8o23rWYjwIsFFkCA00d5RNBDik');

$intent = \Stripe\PaymentIntent::create([
  'amount' => $amount,
  'currency' => $currency,
]);
$client_secret = $intent->client_secret;


if($client_secret)
{
   $minfo = array("success" => 'true', "message" => 'Client Secret token','token' => $client_secret,'publishable_key' => $publishable);
            $jsondata = json_encode($minfo);
            print_r($jsondata);
            exit(); 
}
else{
   $minfo = array("success" => 'false', "message" => 'Client Secret token','token' => '','publishable_key' => '');
            $jsondata = json_encode($minfo);
            print_r($jsondata);
            exit();  
}

