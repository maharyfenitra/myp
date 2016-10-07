<?php

// start the session
session_start();

if(isset($_GET['cm'])){
	$session = $_GET['cm'];
	$session = explode('CUSTOM_DELIMITER',$session);
	$session = $session[1];
	if ($session > 0) {
		$session_script = true;
	} else {
		$session_script = false;
	}
} else {
      $session_script = false;
}

$keys = array_keys($_GET);
$num = count($keys);
for ($i = 0; $i < $num; $i++) {
	if ($keys[$i] == 'tx') {
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		}
	}
}


ini_set('display_errors', 'On');

set_include_path('.:/usr/share/php:/home/mywheelsproject/php_includes:/home/mywheelsproject');
error_reporting(E_ALL);

// setting up the web root and server root for
// this shopping cart application

$thisFile = str_replace('\\', '/', __FILE__);

$docRoot = $_SERVER['DOCUMENT_ROOT'];

$webRoot  = str_replace(array($docRoot, 'php_includes/config.php'), '', $thisFile);

$srvRoot  = str_replace('config.php', '', $thisFile);

define('WEB_ROOT', $webRoot);
define('SRV_ROOT', $srvRoot);

//database access configuration

/*define('DB_HOST','localhost');
define('DB_USER','fuba-industries');
define('DB_PASS','fuba-industries');
define('DB_NAME','fuba-industries');*/

// these are the directories where we will store all

// category and product images

define('CATEGORY_IMAGE_DIR', WEB_ROOT. 'images/category/');

define('PRODUCT_SMALL_IMAGE_DIR',  WEB_ROOT. 'images/product_small/');
define('PRODUCT_IMAGE_DIR',  WEB_ROOT. 'images/product_medium/');
define('PRODUCT_IMAGE_LARGE_DIR',  WEB_ROOT. 'images/product_large/');

define('ROWS_PER_PAGE', 20);

define('ORDER_NEW',   'New');
define('ORDER_STATUS_NEW',   'New');
define('ORDER_STATUS_PENDING',   'Pending');
define('ORDER_STATUS_CONFIRMED',   'Confirmed');
define('ORDER_STATUS_CANCELLED',   'Cancelled');
define('PAYMENT_STATUS_NULL',   '');
define('PAYMENT_STATUS_PENDING',   'Payment_Pending');
define('PAYMENT_STATUS_CONFIRMED',   'Payment_Confirmed');
define('ORDER_PAYMENT_NEW',  'New');
define('ORDER_PAYMENT_PENDING',   'Payment_Pending');
define('ORDER_PAYMENT_NOTIFIED',  'Payment_Notified');
define('ORDER_PAYMENT_PROCESSED', 'Payment_Processed');
define('ORDER_PAYMENT_COMPLETED', 'Payment_Completed');
define('ORDER_PAYMENT_CANCELLED_REVERSAL', 'Payment_Cancelled_Reversal');
define('ORDER_PAYMENT_DENIED', 'Payment_Denied');
define('ORDER_PAYMENT_EXPIRED', 'Payment_Expired');
define('ORDER_PAYMENT_FAILED', 'Payment_Failed');
define('ORDER_PAYMENT_REFUNDED', 'Payment_Refunded');
define('ORDER_PAYMENT_REVERSED', 'Payment_Reversed');
define('ORDER_PAYMENT_VOIDED', 'Payment_Voided');
define('ORDER_SHIPPED',   'Shipped');
define('ORDER_COMPLETED', 'Completed');
define('ORDER_CANCELLED', 'Cancelled');

define('ID_DEFAULT_CUSTOMER_TYPE', 3);

// ------- Paypal PRODUCTION ------
//define('PAYPAL_URL_WEBSCR', 'https://www.paypal.com/cgi-bin/webscr');
//define('PAYPAL_URL_ACQUIRINGWEB', 'https://securepayments.paypal.com/cgi-bin/acquiringweb');
//define('PAYPAL_BUSINESS_IDENTIFIER', 'JSP6KH63XPALY'); // Production

// ------- Paypal SANDBOX --------
define('PAYPAL_URL_WEBSCR', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
define('PAYPAL_URL_ACQUIRINGWEB', 'https://securepayments.sandbox.paypal.com/cgi-bin/acquiringweb');
define('PAYPAL_BUSINESS_IDENTIFIER', 'SDN7WHBXADW2L');  // Sandbox

// some size limitation for the category

// and product images

// all category image width must not 

// exceed 75 pixels

define('MAX_CATEGORY_IMAGE_WIDTH', 75);
// do we need to limit the product image width?

// setting this value to 'true' is recommended

define('LIMIT_PRODUCT_WIDTH',     true);

// maximum width for all product image

define('MAX_PRODUCT_IMAGE_WIDTH', 300);

// the width for product thumbnail

define('THUMBNAIL_WIDTH',         75);

if (!get_magic_quotes_gpc()) {
	if (isset($_POST)) {
		foreach ($_POST as $key => $value) {
                	$_POST[$key] = $value;
		}
	}

	if (isset($_GET)) {
		foreach ($_GET as $key => $value) {
			$_GET[$key] = trim(addslashes($value));
		}
	}	
}

// since all page will require a database access
// and the common library is also used by all
// it's logical to load these library here

require_once 'db.php';
require_once 'common.php';

// get the shop configuration ( name, addres, etc ), all page need it

$shopConfig = getShopConfig();

?>
