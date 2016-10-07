<?php
require_once '../../php_includes/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'customerlist.php';		
		$pageTitle 	= 'Shop Admin Custom Panel - View list';
		break;
        case 'detail' :
		$content 	= 'detail.php';		
		$pageTitle 	= 'Shop Admin Custom Panel - View detail';
		break;
	default :
		$content 	= 'customerlist.php';		
		$pageTitle 	= 'Shop Admin Custom Panel - View list';
}




$script    = array('../library/product.js');

require_once '../include/template.php';
?>
