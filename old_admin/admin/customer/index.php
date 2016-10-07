<?php
require_once '../../php_includes/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'customerlist.php';		
		$pageTitle 	= 'Shop Admin Control Panel - View Product';
		break;

	
		
	default :
		$content 	= 'customerlist.php';		
		$pageTitle 	= 'Shop Admin Control Panel - View Product';
}




$script    = array('../library/product.js');

require_once '../include/template.php';
?>
