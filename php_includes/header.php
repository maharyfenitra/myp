<?php
require_once 'php_includes/field_controle.php';
if (!defined('WEB_ROOT')) {
	exit;
}

// set the default page title
$pageTitle = 'EOSkates Online Shop';

// if a product id is set add the product name
// to the page title but if the product id is not
// present check if a category id exist in the query string
// and add the category name to the page title
if (isset($_GET['p'])&&isValidField($_GET['p']) && (int)$_GET['p'] > 0) {
	$pdId = (int)$_GET['p'];
	$sql = "SELECT pd_reference
			FROM tbl_product
			WHERE pd_id = $pdId";
	
	$result    = dbQuery($sql);
	$row       = dbFetchAssoc($result);
	$pageTitle = $row['pd_reference'];
	
} else if (isset($_GET['c'])&&isValidField($_GET['c']) && (int)$_GET['c'] > 0) {
	$catId = (int)$_GET['c'];
	$sql = "SELECT cat_reference
	        FROM tbl_category
			WHERE cat_id = $catId";

    $result    = dbQuery($sql);
	$row       = dbFetchAssoc($result);
	$pageTitle = $row['cat_reference'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="include/shop.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="library/common.js"></script>
<script type="text/javascript" src="lightbox2/js/prototype.js"></script>
<script type="text/javascript" src="lightbox2/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="lightbox2/js/lightbox.js"></script>
<link rel="stylesheet" href="lightbox2/css/lightbox.css" type="text/css" media="screen" />
</head>
<body>
