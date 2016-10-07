<?php

if (!defined('WEB_ROOT')) {
	exit;
}

//echo "<h1>XXXXXXXXXXXXXXXXXX</h1>";
$productsPerRow = 3;
// better 3forPage?

$productsPerPage = 10000; 

//$productList    = getProductList($catId);
$children = array_merge(array($catId), getChildCategories(NULL, $catId));
$children = ' (' . implode(', ', $children) . ')';

$sql = "SELECT pd_id, 
		(SELECT text
                         FROM language_items
                         WHERE (lang='_en' or lang='$lang')
                                AND  item= ( select concat('product_',pd_reference,'_name') from tbl_product where pd_id = pd.pd_id)
                                AND  text <> ''
                         ORDER by lang asc limit 1) as pd_name,
		ta_price, pd_thumbnail, sum(pi_stock_qty) as pd_qty, c.cat_id, pd_active
		FROM tbl_product pd, tbl_category c, tbl_product_item pi, tbl_tariff ta 
		WHERE pd.cat_id = c.cat_id
		  AND pd.pd_id = ta.ta_pd_id 
		  AND ta.ta_category = 0 
		  AND pd.cat_id IN $children 
		  AND pd.pd_id = pi.pi_pd_id
		  AND pd.pd_active = 1
		GROUP BY pi.pi_pd_id
		ORDER BY pd_display_order";

$result     = dbQuery(getPagingQuery($sql, $productsPerPage));
$pagingLink = getPagingLink($sql, $productsPerPage, "c=$catId");
$numProduct = dbNumRows($result);
$rowHeight = 140 ;

if ( $numProduct <= $productsPerRow ) {
	$rowHeight = 280 ;
}

// the product images are arranged in a table. to make sure
// each image gets equal space set the cell width here

$columnWidth = (int)(100 / $productsPerRow);

?>

<table valign="middle" width="100%" border="0" cellspacing="0" cellpadding="8">

<?php 
$_session =false;
$_customer_c=null;
$pri=new ProductInfo();
if(isset($_SESSION['session_name'])){
   $_customer_c=new Customer($_SESSION["session_name"],null,null,null);
   $_session=true;
   }
if ($numProduct > 0 ) {
	$i = 0;
	while ($row = dbFetchAssoc($result)) {

		extract($row);
               // print_r($row);
		if ($pd_thumbnail) {
			$pd_thumbnail = PRODUCT_SMALL_IMAGE_DIR . $pd_thumbnail;
		} else {
			$pd_thumbnail = PRODUCT_SMALL_IMAGE_DIR . 'no-image-small.png';
		}

		if ($i % $productsPerRow == 0) {
			echo '<tr>';
		}

		// format how we display the price
                $ta_price = displayAmount($ta_price);
                if($_session){
                 $pri->setPdid($pd_id);
                 $customerprice=$pri->getPrice($_customer_c->getType());
                 if($customerprice==0||$customerprice==''){
                 
                 $customerprice=$pri->getPrice(ID_DEFAULT_CUSTOMER_TYPE);
                 }
                 $ta_price = displayAmount($customerprice);
                }
		else{
		 $pri->setPdid($pd_id);
                 $customerprice=$pri->getPrice(ID_DEFAULT_CUSTOMER_TYPE);
                 $ta_price = displayAmount($customerprice);
		}

		echo "<td height=\"".$rowHeight."\" width=\"$columnWidth%\" align=\"center\"><a href=\"" . $_SERVER['PHP_SELF'] . "?c=$catId&p=$pd_id" . "\"><img src=\"" . $pd_thumbnail . "\"" .SetThumbnailDimensions ($pd_thumbnail,250,110). " border=\"0\" alt=\"" . htmlspecialchars ($pd_name) . "\"><br><font style=\"color:#4D4D4D\">$pd_name</a></font><br>";
		if ($ta_price > 0) echo db_return_text($lang,'store','price')." : ".$ta_price;

		// if the product is no longer in stock, tell the customer
		if ($pd_qty <= 0) {
//			echo "&nbsp;-&nbsp;Out Of Stock";
		}

		echo "</td>\r\n";

		if ($i % $productsPerRow == $productsPerRow - 1) {
			echo '</tr>';
		}

		$i += 1;
	}

	if ($i % $productsPerRow > 0) {

		echo '<td colspan="' . ($productsPerRow - ($i % $productsPerRow)) . '">&nbsp;</td>';

	}

} else {

?>
	<tr><td width="100%" align="center" valign="center">No products in this category</td></tr>
<?php	

}	

?>

</table>
<table valign="middle" width="100%" border="0" cellspacing="0" cellpadding="8">
<tr>
<td align="center" height="25">
<a align="center" style="color:black"><?php echo $pagingLink; ?></a>
</td>
</tr>
</table>


