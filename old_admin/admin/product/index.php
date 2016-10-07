<?php
require_once '../../php_includes/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'Shop Admin Control Panel - View Product';
		break;

	case 'add' :
		$content 	= 'add.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Add Product';
		break;

	case 'modify' :
		$content 	= 'modify.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Modify Product';
		break;

	case 'clone' :
		$content 	= 'clone.php';		
		$pageTitle 	= 'Shop Admin Control Panel - Clone Product';
		break;

	case 'detail' :
		$content    = 'detail.php';
		$pageTitle  = 'Shop Admin Control Panel - View Product Detail';
		break;
        case 'addImage' :
		$content    = 'addImage.php';
		$pageTitle  = 'Shop Admin Control Panel - add Image';
		break;
		
	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'Shop Admin Control Panel - View Product';
}




$script    = array('../library/product.js');

require_once '../include/template.php';
?>
