<?php
if (!defined('WEB_ROOT')) {
	exit;
}
//$self = WEB_ROOT . 'admin/index.php';
$self = '/admin/index.php';
?>
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/admin/include/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="/php_includes/common.js"></script>
<?php
$n = count($script);
for ($i = 0; $i < $n; $i++) {
	if ($script[$i] != '') {
              //echo '<script language="JavaScript" type="text/javascript" src="' . WEB_ROOT. 'admin/library/' . $script[$i]. '"></script>';
		echo '<script language="JavaScript" type="text/javascript" src="/admin/library/' . $script[$i]. '"></script>';
	}
}
?>
</head>
<body>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="1" class="graybox">
<!--  <tr>
    <td colspan="2"><img src="<?php echo WEB_ROOT; ?>admin/include/banner-top.gif" width="750" height="75"></td>
  </tr> -->
  <tr>
    <td width="150" valign="top" class="navArea"><p>&nbsp;</p>
      <a href="/admin/" class="leftnav">Home</a> 
	  <a href="/admin/category/" class="leftnav">Category</a>
	  <a href="/admin/product/" class="leftnav">Product</a> 
	  <a href="/admin/order/?status=Completed" class="leftnav">Order</a> 
	  <a href="/admin/video/" class="leftnav">Video Center</a> 
	  <a href="/admin/config/" class="leftnav">Shop Config</a> 
	  <a href="/admin/user/" class="leftnav">User</a>
          <a href="/admin/customer/" class="leftnav">manage customer</a> 
	  <a href="/?logout" class="leftnav">Logout</a>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="600" valign="top" class="contentArea"><table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr>
          <td>
<?php
require_once $content;	 
?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center">Copyright &copy; 2008 - <?php echo date('Y'); ?> <a href="http://www.eoskates.com"> www.eoskates.com</a></p>
</body>
</html>
