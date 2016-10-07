<?php
require_once '../../php_includes/config.php';
require_once '../library/functions.php';
require_once '../../customer/library/product_info.php';
$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'Shop Admin Control Panel - View Type';
		break;

	
		
	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'Shop Admin Control Panel - View Type';
}



$script    = array('../library/product.js');

require_once '../include/template.php';
?>
