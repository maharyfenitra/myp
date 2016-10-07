<?php
require_once 'php_includes/product-functions.php';
if (!defined('PRODUCT_IMAGE_DIR')) {
	exit;
}


if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
	$catId = (int)$_GET['catId'];
	$sql2 = " AND p.cat_id = $catId";
	$queryString = "catId=$catId";
} else {
	$catId = 0;
	$sql2  = '';
	$queryString = '';
}

// for paging
// how many rows to show per page
if (!defined('ROWS_PER_PAGE')) {
	$rowsPerPage = 20;
} else {
	$rowsPerPage = ROWS_PER_PAGE;
}


$sql = "SELECT pd_id, c.cat_id, cat_reference, pd_reference, pd_thumbnail, pd_active, ta_price, pd_display_order
        FROM tbl_product p, tbl_category c, tbl_tariff ta
		WHERE p.cat_id = c.cat_id $sql2
		AND p.pd_id = ta.ta_pd_id
		AND ta.ta_category = 0
		ORDER BY pd_display_order";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

$categoryList = buildCategoryOptions($catId);

?> 


<p>&nbsp;</p>
<form action="processProduct.php?action=addProduct" method="post"  name="frmListProduct" id="frmListProduct">
 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
  <tr>
   <td align="left"><input name="btnAddProduct" type="button" id="btnAddProduct" value="Add Product" class="box" onClick="addProduct(<?php echo $catId; ?>)"></td>
   <td align="right">View products in : 
    <select name="cboCategory" class="box" id="cboCategory" onChange="viewProduct();">
     <option selected>All Category</option>
	<?php echo $categoryList; ?>
   </select>
 </td>
 </tr>
</table>
<br>
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td width="75">Category</td>
   <td>Product Reference</td>
   <td width="75">Thumbnail</td>
   <td width="70">Clone</td>
   <td width="70">Modify</td>
   <td width="70">Display Order</td>
   <td width="70">Delete</td>
   <td width="70">Price</td>
   <td width="70">Price Retail</td>
   <td width="70">Active</td>
   <td width="70">Add Image</td>
   <td width="70">Number</td>
  </tr>
  <?php
$parentId = 0;
if (dbNumRows($result) > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
		extract($row);
		
		if ($pd_thumbnail) {
			$pd_thumbnail = "/".PRODUCT_SMALL_IMAGE_DIR . $pd_thumbnail;
		} else {
			$pd_thumbnail = "/".PRODUCT_SMALL_IMAGE_DIR . '/no-image-small.png';
		}	
		
		
		
		if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		
		$i += 1;
?>
  <tr class="<?php echo $class; ?>"> 
   <td width="75" align="center"><a href="?c=<?php echo $cat_id; ?>"><?php echo $cat_reference; ?></a></td>
   <td><a href="index.php?view=detail&productId=<?php echo $pd_id; ?>"><?php echo $pd_reference; ?></a></td>
   <td width="75" align="center"><img src="<?php echo $pd_thumbnail; ?>"></td>
   <td width="70" align="center"><a href="javascript:cloneProduct(<?php echo $pd_id; ?>);">Clone</a></td>
   <td width="70" align="center"><a href="javascript:modifyProduct(<?php echo $pd_id; ?>);">Modify</a></td>
   <td width="70" align="center"><?php echo $pd_display_order; ?></td>
   <td width="70" align="center"><a href="javascript:deleteProduct(<?php echo $pd_id; ?>,<?php echo $catId; ?>);">Delete</a></td>
   <td width="70" align="center"><?php echo $ta_price; ?></td>
   <td width="70" align="center"><?php echo "nc" ?></td>
   <td width="70" align="center"><?php echo $pd_active; ?></td>
   <td width="70"><a href="index.php?view=addImage&&pd_id=<?php echo $pd_id; ?>">Add Image</a></td>
   <td width="70" align="center"><?php echo getProductNumberImage($pd_id); ?></td>
  </tr>
  <?php
	} // end while
?>
  <tr> 
   <td colspan="5" align="center">
   <?php 
echo $pagingLink;
   ?></td>
  </tr>
<?php	
} else {
?>
  <tr> 
   <td colspan="5" align="center">No Products Yet</td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"><input name="btnAddProduct" type="button" id="btnAddProduct" value="Add Product" class="box" onClick="addProduct(<?php echo $catId; ?>)"></td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>
