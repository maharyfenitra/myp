<?php
require_once '../../php_includes/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'listitem' :
		$content 	= 'listitem.php';
		$pageTitle 	= 'Langage';
		break;	
	default :
		$content 	= 'listitem.php';		
		$pageTitle 	= 'Langage';
		break;
}




$script    = array('../library/product.js');

require_once '../include/template.php';
?>
