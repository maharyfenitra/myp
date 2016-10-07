<?php
	require_once 'php_includes/config.php';
	require_once 'php_includes/cart-functions.php';
	
?>

<?php

// STEP 1: Read POST data
// reading posted data from directly from $_POST causes serialization 
// issues with array data in POST
// reading raw POST data from input stream instead. 
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}

// STEP 2: Post IPN data back to paypal to validate

//$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
//$ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
$ch = curl_init(PAYPAL_URL_WEBSCR);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

// In wamp like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
// of the certificate as shown below.
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');

if( !($res = curl_exec($ch)) ) {
    //error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);

 
// STEP 3: Inspect IPN validation result and act accordingly

if (strcmp ($res, "VERIFIED") == 0) {
    // check whether the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process payment

    // assign posted variables to local variables
    
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
    
    
    $customString = explode('CUSTOM_DELIMITER',$_POST['custom']);
    $lang = $customString[2];
    $orderId = $customString[0];

    $sql_query = "SELECT od_payment_email FROM tbl_order WHERE od_id=$orderId";
    $result = dbQuery($sql_query); 
    extract(dbFetchAssoc($result));

    include './customer/library/mail_confirmation_payment.php';
    new Mail_Confirmation_Payment($od_payment_email,getShopConfig()['email'],getShopConfig()['name'],$lang,$orderId,$payment_status);
    
    if ($payment_status == 'Pending') {
	$pending_reason = $_POST['pending_reason'];
	$order_status=ORDER_STATUS_PENDING;
	$payment_status=PAYMENT_STATUS_PENDING;
	$sql = "UPDATE tbl_order SET od_last_update=NOW(), od_order_status='$order_status', od_payment_status='$payment_status', od_pending_reason='$pending_reason', od_transaction_number='$txn_id' WHERE od_id=$orderId";
    } else if ($payment_status == 'Refunded'){
	$order_status=ORDER_STATUS_CANCELLED;
	
	$sql = "UPDATE tbl_order SET od_last_update=NOW(), od_order_status='$order_status', od_payment_status='$payment_status', od_transaction_number='$txn_id'  WHERE od_id=$orderId";
    } else {
	$order_status=ORDER_STATUS_CONFIRMED;
	$sql = "UPDATE tbl_order SET od_last_update=NOW(), od_order_status='$order_status', od_payment_status='$payment_status', od_transaction_number='$txn_id'  WHERE od_id=$orderId";
    }

    $res = dbQuery($sql);

$myFile = "IPN_log.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
$stringData = "payment successfull: "; 
$stringData = " payer email: "; 
fwrite($fh, $stringData);
$stringData = $payer_email;
fwrite($fh, $stringData);
$stringData = " - od_payment_email: "; 
fwrite($fh, $stringData);
$stringData = $od_payment_email;
fwrite($fh, $stringData);
$stringData = " - receiver email: "; 
fwrite($fh, $stringData);
$stringData = $receiver_email;
fwrite($fh, $stringData);
$stringData = " - amount: "; 
fwrite($fh, $stringData);
$stringData = $payment_amount;
fwrite($fh, $stringData);
$stringData = " - tx: "; 
fwrite($fh, $stringData);
$stringData = $txn_id;
fwrite($fh, $stringData);
$stringData = " - sql: "; 
fwrite($fh, $stringData);
$stringData = $sql;
fwrite($fh, $stringData);
fwrite($fh, "\n");
fclose($fh);


} else if (strcmp ($res, "INVALID") == 0) {
$myFile = "IPN_log_error.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
$stringData = "IPN Failed ";
fwrite($fh, $stringData);
fwrite($fh, "\n");
fclose($fh);
    // log for manual investigation
}
?>
