<?php

function getSingleProductItemList($catId,$pdId,$lang)

{

//$productList    = getProductList($catId);
 $children = array_merge(array($catId), getChildCategories(NULL, $catId));
 $children = ' (' . implode(', ', $children) . ')';

 $sql = "SELECT pi_id, pi_flavor, pi_stock_qty, pi_weight
                FROM tbl_product_item pi
                WHERE pi.pi_pd_id = $pdId
                ORDER BY pi.pi_flavor_display_order asc";

 $result     = dbQuery($sql);
 $numProductItem = dbNumRows($result);

// echo '<table valign="middle" width="100%" border="0" cellspacing="0" cellpadding="8">';

 if ($numProductItem > 1 ) {
        $i = 0;
        echo "<select name='i'>";
        echo "<option value='-1'>"; echo db_get_text($lang,'store','choose_flavor'); echo "</option>";
        while ($row = dbFetchAssoc($result)) {

                extract($row);

                // if the product is no longer in stock, tell the customer
//                if ($pi_stock_qty <= 0) {
//                        echo "<option value='$pi_id'> $pi_flavor - "; echo db_get_text($lang,'store','out_of_stock'); echo "</option>";
//                } else {
//                        echo "<option value='$pi_id'> $pi_flavor - "; echo db_get_text($lang,'store','stock'); echo ": $pi_stock_qty</option>";
//                }
		// don't show any stock value at all as long as the back-office system is not ready for it
                echo "<option value='$pi_id'> $pi_flavor"; echo "</option>";
        }
        echo "</select>";
 } else {
        if ($row = dbFetchAssoc($result)) {
                extract($row);
                echo "<input type='hidden' name='i' value='$pi_id'>";
        }
 }
}


function getCartProductItemList($catId,$pdId,$lang,$index)
{
 $html = '';
//$productList    = getProductList($catId);
 $children = array_merge(array($catId), getChildCategories(NULL, $catId));
 $children = ' (' . implode(', ', $children) . ')';

 $sql = "SELECT pi_id, pi_flavor, pi_stock_qty, pi_weight
		FROM tbl_product_item pi 
		WHERE pi.pi_pd_id = $pdId
		ORDER BY pi.pi_flavor_display_order asc"; 

 $result     = dbQuery($sql);
 $numProductItem = dbNumRows($result);

// echo '<table valign="middle" width="100%" border="0" cellspacing="0" cellpadding="8">';

 if ($numProductItem > 1 ) {
	$i = 0;
	$html .= "<select name='i[$index]'>";
	$html .= "<option value='-1'>"; 
	$html .= db_return_text($lang,'store','choose_flavor'); 
	$html .= "</option>";
	while ($row = dbFetchAssoc($result)) {

		extract($row);

		// if the product is no longer in stock, tell the customer
//		if ($pi_stock_qty <= 0) {
//			$html .= "<option value='$pi_id'> $pi_flavor - "; 
//			$html .= db_return_text($lang,'store','out_of_stock'); 
//			$html .= "</option>";
//		} else {
//			$html .= "<option value='$pi_id'> $pi_flavor - "; 
//			$html .= db_return_text($lang,'store','stock'); 
//			$html .= ": $pi_stock_qty</option>";
//		}
		// don't show any stock value at all as long as the back-office system is not ready for it
	        $html .= "<option value='$pi_id'> $pi_flavor";
                $html .= "</option>";	
	}
	$html .= "</select>";
 } else {
	if ($row = dbFetchAssoc($result)) {
		extract($row);
		$html .= "<input type='hidden' name='i[]' value='$pi_id'>";
	}
 }

return $html; 
}
?>

