<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php_includes/config.php';

/*********************************************************
*                 PRODUCT FUNCTIONS 
**********************************************************/

/*
	Get detail information of a product
*/

function getProductDetail($pdId, $lang)

{
	$_SESSION['shoppingReturnUrl'] = $_SERVER['REQUEST_URI'];

	// get the product information from database

	$sql = "SELECT (SELECT text
                         FROM language_items
                         WHERE (lang='_en' or lang='$lang')
                                AND  item= ( select concat('product_',pd_reference,'_name') from tbl_product where pd_id = $pdId)
                                AND  text <> ''
                         ORDER by lang asc limit 1) as pd_name, 
			(SELECT text 
			 FROM language_items 
			 WHERE (lang='_en' or lang='$lang') 
			 	AND  item= ( select concat('product_',pd_reference,'_desc') from tbl_product where pd_id = $pdId)
			 	AND  text <> '' 
			 ORDER by lang asc limit 1) as pd_description, 
			(SELECT text 
			 FROM language_items 
			 WHERE (lang='_en' or lang='$lang') 
				AND item=(select concat('product_',pd_reference,'_desc2') from tbl_product where pd_id = $pdId) 
				AND text <> ''
		 	 ORDER by lang asc limit 1) as pd_description2,
			ta_price, pd_image, pd_image_large, sum(pi_stock_qty) as pd_qty, count(pi_flavor) as nof_stock, pi_weight, pi_shipping_weight, pd_default_order_qty, pd_active, pd_vo_group
			FROM tbl_product, tbl_product_item, tbl_tariff 
			WHERE pd_id = $pdId
			AND pd_id = ta_pd_id
			AND ta_category = 0
			AND pi_pd_id = pd_id
			AND pd_active = 1
			GROUP BY pd_id";

	$result = dbQuery($sql);

	$row    = dbFetchAssoc($result);

	extract($row);

	$row['pd_description'] = nl2br($row['pd_description']);
	$row['pd_description2'] = nl2br($row['pd_description2']);

	if ($row['pd_image']) {
		$row['pd_image'] = PRODUCT_IMAGE_DIR .  $row['pd_image'];
	} else {
		$row['pd_image'] = PRODUCT_IMAGE_DIR  . 'no-image-large.png';
	}

	if ($row['pd_image_large']) {
		$row['pd_image_large'] = PRODUCT_IMAGE_LARGE_DIR .  $row['pd_image_large'];
	} else {
		$row['pd_image_large'] = PRODUCT_IMAGE_LARGE_DIR  . 'no-image-large.png';
	}

	$row['cart_url'] = "miniCart.php?action=add&p=$pdId";

	return $row;

}

function getProductItemDetail($pdId,$pditemId)

{
        $_SESSION['shoppingReturnUrl'] = $_SERVER['REQUEST_URI'];

        // get the product information from database

        $sql = "SELECT (SELECT text
                         FROM language_items
                         WHERE (lang='_en' or lang='$lang')
                                AND  item= ( select concat('product_',pd_reference,'_name') from tbl_product where pd_id = $pdId)
                                AND  text <> ''
                         ORDER by lang asc limit 1) as pd_name,
                        (SELECT text
                         FROM language_items
                         WHERE (lang='_en' or lang='$lang')
                                AND  item= ( select concat('product_',pd_reference,'_desc') from tbl_product where pd_id = $pdId)
                                AND  text <> ''
                         ORDER by lang asc limit 1) as pd_description,
                        (SELECT text
                         FROM language_items
                         WHERE (lang='_en' or lang='$lang')
                                AND item=(select concat('product_',pd_reference,'_desc2') from tbl_product where pd_id = $pdId)
                                AND text <> ''
                         ORDER by lang asc limit 1) as pd_description2, 
			 ta_price, pd_image, pd_image_large, pi_stock_qty, pi_weight, pi_shipping_weight, pi_flavor
                        FROM tbl_product, tbl_product_item, tbl_tariff
                        WHERE pd_id = $pdId
			AND pd_id = ta_pd_id
			AND ta_category = 0
                        AND pi_pd_id = pd_id
                        AND pi_pd_id = $pditemId";

        $result = dbQuery($sql);

        $row    = dbFetchAssoc($result);

        extract($row);

        $row['pd_description'] = nl2br($row['pd_description']);
        $row['pd_description2'] = nl2br($row['pd_description2']);

        if ($row['pd_image']) {
                $row['pd_image'] = PRODUCT_IMAGE_DIR .  $row['pd_image'];
        } else {
                $row['pd_image'] = PRODUCT_IMAGE_DIR  . 'no-image-large.png';
        }

        if ($row['pd_image_large']) {
                $row['pd_image_large'] = PRODUCT_IMAGE_LARGE_DIR .  $row['pd_image_large'];
        } else {
                $row['pd_image_large'] = PRODUCT_IMAGE_LARGE_DIR  . 'no-image-large.png';
        }

        $row['cart_url'] = "miniCart.php?action=add&p=$pdId";

        return $row;

}
function getProductItemImageDetail($pdId){
       $sql="select pd_image FROM  tbl_product_image where pd_id='".$pdId."'";
        $result = dbQuery($sql);
        return $result; 
}
function getProductNumberImage($pdId){
       $sql="select pd_image FROM  tbl_product_image where pd_id='".$pdId."'";
        $result = dbQuery($sql);

        $i=0;
        while ($rang=mysql_fetch_array($result)){
         $i=$i+1;
}
        return $i; 
}
function getProductItemFlavor($pditemId)

{
        // get the product item information from database

        $sql = "SELECT if(pi_flavor='','-',pi_flavor) as pi_flavor
                        FROM tbl_product_item
                        WHERE pi_id = $pditemId";

        $result = dbQuery($sql);

        $row    = dbFetchAssoc($result);

        //extract($row);

        return $row["pi_flavor"];
        //return $pi_flavor;

}
?>
