<?php
if (!defined('PRODUCT_IMAGE_DIR')) {
	exit;
}

// make sure a product id exists
if (isset($_GET['productId']) && $_GET['productId'] > 0) {
	$productId = $_GET['productId'];
} else {
	// redirect to index.php if product id is not present
	header('Location: index.php');
}

$sql = "SELECT cat_reference, pd_reference, pd_price, pd_qty, pd_image
        FROM tbl_product pd, tbl_category cat
		WHERE pd.pd_id = $productId AND pd.cat_id = cat.cat_id";
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());

$row = mysql_fetch_assoc($result);
extract($row);

if ($pd_image) {
	$pd_image = PRODUCT_IMAGE_DIR . $pd_image;
} else {
	$pd_image = PRODUCT_IMAGE_DIR . 'no-image-large.png';
}


?>
<p>&nbsp;</p>
<form action="processProduct.php?action=addProduct" method="post" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Category Ref</td>
   <td class="content"><?php echo $cat_reference; ?></td>
  </tr>
  <tr> 
   <td width="150" class="label">Product Reference</td>
   <td class="content"> <?php echo $pd_reference; ?></td>
  </tr>
  <tr> 
   <td width="150" height="36" class="label">Price</td>
   <td class="content"><?php echo number_format($pd_price, 2); ?> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Qty In Stock</td>
   <td class="content"><?php echo number_format($pd_qty); ?> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Image</td>
   <td class="content"><img src="<?php echo $pd_image; ?>"></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnModifyProduct" type="button" id="btnModifyProduct" value="Modify Product" onClick="window.location.href='index.php?view=modify&productId=<?php echo $productId; ?>';" class="box">
  &nbsp;&nbsp;
  <input name="btnBack" type="button" id="btnBack" value=" Back " onClick="window.history.back();" class="box">
 </p>
</form>
