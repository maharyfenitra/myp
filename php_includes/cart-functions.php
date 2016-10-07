<?php
//require_once 'php_includes/config.php';
require_once 'php_includes/field_controle.php';
/*********************************************************
*                 SHOPPING CART FUNCTIONS 
*********************************************************/

function addToCart($lang)

{
	// make sure the product id exist

	if (isset($_POST['p']) &&isValidField($_POST['p'])&& (int)$_POST['p'] > 0) {
		$productId = (int)$_POST['p'];
	} else {
		header('Location: index.php');
	}

	if (isset($_POST['i'])&&isValidField($_POST['i']) && (int)$_POST['i'] > 0) {
		$productItemId = (int)$_POST['i'];
	} else {
		$productItemId = -1;
	}

       if (isset($_POST['txtQty']) &&isValidField($_POST['txtQty'])&& (int)$_POST['txtQty'] > 0) {
                $productQty = (int)$_POST['txtQty'];
        } else {
                $productQty = 1;
        }

       if (isset($_POST['txtVoucher'])&&isValidField($_POST['txtVoucher'])) {
                $productVoucher = $_POST['txtVoucher'];
        } else {
		$productVoucher = "NULL";
	}

	// does the product exist ?

	$product = getProductDetail($productId,$productItemId);
	// we have $pd_name, $ta_price, $pd_description, $pd_image, $pd_qty 
	extract($product);

	

//	$sql = "SELECT pd_id, pd_qty
//	        FROM tbl_product
//			WHERE pd_id = $productId";
//	$result = dbQuery($sql);

//	if (dbNumRows($result) != 1) {
//		// the product doesn't exist
//		header('Location: cart.php');
//        if (isset($pd_qty)) {

		// how many of this product we
		// have in stock

//		$row = dbFetchAssoc($result);

//		$currentStock = $row['pd_qty'];

//		if ($currentStock == 0) {
//		if ($pd_qty == 0) {
			// we no longer have this product in stock
			// show the error message

//			setError('The product you requested is no longer in stock');

//			header('Location: cart.php');

//			exit;
//		}

//	} else {
		// this product does not exist
//	 	setError('The product you requested is no longer in stock');
//	}		

	// current session id

	$sid = session_id();

	// check if the product is already
	// in cart table for this session

	$sql = "SELECT pd_id, pi_id
	        FROM tbl_cart
			WHERE   pd_id = $productId 
				AND pi_id = $productItemId 
				AND ct_session_id = '$sid'";

	$result = dbQuery($sql);

	if (dbNumRows($result) == 0) {

		// check the voucher if applicable

		$sql = "SELECT pd_vo_group FROM tbl_product WHERE pd_id = $productId AND pd_vo_group >= 0";
		$result = dbQuery($sql);

		if (dbNumRows($result) > 0) { // product is subject to voucher discounts

			$sql = "SELECT vo_id, vo_state FROM tbl_voucher, tbl_product WHERE vo_number = '$productVoucher' and vo_group_id = pd_vo_group and pd_id = $productId";
			$result = dbQuery($sql);

                        if (($row = dbFetchAssoc($result))) {

				if ($row['vo_state'] == 0) { // put the product in cart table
					$vo_id = $row['vo_id'];
	       	                         $sql = "INSERT INTO tbl_cart (pd_id, pi_id, ct_qty, ct_session_id, ct_date, ct_orderId, ct_voucher_id)
       	                                 VALUES ($productId, $productItemId, $productQty, '$sid', NOW(), NULL, $vo_id)";
		                        $result = dbQuery($sql);

					$sql = "UPDATE tbl_voucher SET vo_state = 1 where vo_id = $vo_id";
					$result = dbQuery($sql);
				} else {
					echo "<font color='#FF0000'>";
					db_get_text($lang, 'store', 'error_msg_voucher_not_virgin');
					echo "</font>";
				}
			} else {
				echo "<font color='#FF0000'>";
				db_get_text($lang, 'store', 'error_msg_voucher_not_valid');
				echo "</font>";
			}

		} else { // no voucher group attached to this product, INSERT it in the Cart 

			$sql = "INSERT INTO tbl_cart (pd_id, pi_id, ct_qty, ct_session_id, ct_date, ct_orderId, ct_voucher_id)
				VALUES ($productId, $productItemId, $productQty, '$sid', NOW(), NULL, NULL)";
			$result = dbQuery($sql);

		} 

	} else {

                // check the voucher if applicable

                $sql = "SELECT pd_vo_group FROM tbl_product WHERE pd_id = $productId AND pd_vo_group >= 0";
                $result = dbQuery($sql);

                if (dbNumRows($result) == 0) { // product is NOT subject to voucher discounts

			// update product quantity in cart table

			$sql = "UPDATE tbl_cart 
			        SET ct_qty = ct_qty + $productQty 
				WHERE   ct_session_id = '$sid' 
					AND pd_id = $productId 
					AND pi_id = $productItemId";		

			$result = dbQuery($sql);		
		}
	}	

	// an extra job for us here is to remove abandoned carts.
	// right now the best option is to call this function here

	deleteAbandonedCart();

//	header('Location: ' . $_SESSION['shop_return_url']);				
}



/*

	Get all item in current session

	from shopping cart table

*/

function getCartContent($lang)

{
	$cartContent = array();

	$sid = session_id();

	$sql = "SELECT ct_id, ct.pd_id, ct.pi_id, ct_qty, IFNULL(ct_voucher_id, -1) ct_voucher_id, ta_price, pd_image_large, pd_thumbnail, pd.cat_id, pi_weight, pi_shipping_weight, pd_reference,pi_flavor,
			(SELECT text
                         FROM language_items
                         WHERE (lang='_en' or lang='$lang')
                                AND  item= ( select concat('product_',pd_reference,'_name') from tbl_product where pd_id = ct.pd_id)
                                AND  text <> ''
                         ORDER by lang asc limit 1) as pd_name
			FROM tbl_cart ct, tbl_product pd, tbl_product_item pi, tbl_category cat, tbl_tariff ta
			WHERE   ct_session_id = '$sid' 
				AND pd.pd_id = ta.ta_pd_id
				AND ta.ta_category = 0
				AND ct.pd_id = pd.pd_id 
				AND ct.pi_id = pi.pi_id
				AND cat.cat_id = pd.cat_id
				AND pi.pi_pd_id = pd.pd_id
				AND ct.pi_id >= 0
		UNION
		SELECT ct_id, ct.pd_id, -1, ct_qty, IFNULL(ct_voucher_id, -1) ct_voucher_id, ta_price, pd_image_large, pd_thumbnail, pd.cat_id, min(pi.pi_weight) as 'pi.pi_weight',min(pi.pi_shipping_weight) as 'pi.pi_shipping_weight',pd_reference,pi_flavor,
			(SELECT text
                         FROM language_items
                         WHERE (lang='_en' or lang='$lang')
                                AND  item= ( select concat('product_',pd_reference,'_name') from tbl_product where pd_id = ct.pd_id)
                                AND  text <> ''
                         ORDER by lang asc limit 1) as pd_name
                        FROM tbl_cart ct, tbl_product pd, tbl_category cat, tbl_product_item pi, tbl_tariff ta
                        WHERE   ct_session_id = '$sid'
				AND pd.pd_id = ta.ta_pd_id
				AND ta.ta_category = 0
                                AND ct.pd_id = pd.pd_id
                                AND cat.cat_id = pd.cat_id
                                AND ct.pi_id = -1
				AND pi.pi_pd_id = pd.pd_id
			GROUP   BY pi.pi_pd_id";

	$result = dbQuery($sql);

	while ($row = dbFetchAssoc($result)) {

		if ($row['pd_thumbnail']) {
			$row['pd_thumbnail'] = WEB_ROOT . 'images/product_small/' . $row['pd_thumbnail'];
		} else {
			$row['pd_thumbnail'] = WEB_ROOT . 'images/product_small/no-image-small.png';
		}

		if ($row['pd_image_large']) {
			$row['pd_image_large'] = WEB_ROOT . 'images/product_large/' . $row['pd_image_large'];
		} else {
			$row['pd_image_large'] = WEB_ROOT . 'images/product_large/no-image-small.png';
		}

		$cartContent[] = $row;
	}

	return $cartContent;
}

/*
	Remove an item from the cart
*/

function deleteFromCart($cartId = 0)

{

	if (!$cartId && isset($_POST['cid'])&&isValidField($_POST['cid']) && (int)$_POST['cid'] > 0) {

		$cartId = (int)$_POST['cid'];

	}

	if ($cartId) {	

		$sql = "SELECT ct_voucher_id FROM tbl_cart WHERE ct_id = $cartId";
		$result = dbQuery($sql);

                if (dbNumRows($result) > 0) { // product was added to cart using a voucher

                        $row = dbFetchAssoc($result);
			if (isSet($row['ct_voucher_id']) && ($row['ct_voucher_id'] >= 0)) { // update the voucher back to virgin 
				$voucher_id = $row['ct_voucher_id'];
				$sql = "UPDATE tbl_voucher SET vo_state=0 WHERE vo_id=$voucher_id"; 
                                $result = dbQuery($sql);
			}
		}
	 
		$sql  = "DELETE FROM tbl_cart
				 WHERE ct_id = $cartId";

		$result = dbQuery($sql);
	}

//	header('Location: cart.php');	
}


/*
	Update item quantity in shopping cart
*/

function updateCart()

{
	$cartId     = $_POST['hidCartId'];
	$productId  = $_POST['hidProductId'];
	$productItemId  = $_POST['hidProductItemId'];
	$cartEntry_productItemId = $_POST['i'];
	$entryQty    = $_POST['txtQty'];

	$numEntries    = count($entryQty);
	$numDeleted = 0;
	$notice     = '';

	for ($i = 0; $i < $numEntries; $i++) {
                         
		$newQty = (int)$entryQty[$i];
		$newProductItemId = (int)$cartEntry_productItemId[$i];
		if ($newQty < 1) {
			// remove this item from shopping cart
			deleteFromCart($cartId[$i]);	
			$numDeleted += 1;
		} else {

			// update product quantity
			$sql = "UPDATE tbl_cart
					SET ct_qty = $newQty,
					    pi_id = $newProductItemId
					WHERE ct_id = {$cartId[$i]}";

			dbQuery($sql);

		}
	}

	if ($numDeleted == $numEntries) {

		 // if all item deleted return to the last page that
		// the customer visited before going to shopping cart
               //		header("Location: $returnUrl" . $_SESSION['shop_return_url']);

	} else {

//		header('Location: cart.php');	

	}


//	exit;

}



function isCartEmpty()
{

	$isEmpty = false;

	$sid = session_id();

	$sql = "SELECT ct_id
		FROM tbl_cart ct
		WHERE ct_session_id = '$sid'";

	$result = dbQuery($sql);

	if (dbNumRows($result) == 0) {
		$isEmpty = true;
	}	

	return $isEmpty;
}

/*
	Delete all cart entries older than one day
*/

function deleteAbandonedCart()
{

	$yesterday = date('Y-m-d H:i:s', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));

	$sql = "DELETE FROM tbl_cart
	        WHERE ct_date < '$yesterday'";

	dbQuery($sql);		

}

function deleteCart()
{
        $sid = session_id();
        $sql = "DELETE FROM tbl_cart
                        WHERE ct_session_id = '$sid'";
        $result = dbQuery($sql);
}


?>
