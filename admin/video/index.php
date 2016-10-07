<?php
require_once '../../php_includes/config.php';
require_once '../library/functions.php';

checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	default :
		$content 	= 'main.php';		
		$pageTitle 	= ' Admin Control Panel - Video Surveillance ';
}

$script    = array('shop.js');

require_once '../include/template.php';
?>
