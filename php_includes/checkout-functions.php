<?php
require_once 'php_includes/config.php';
/*********************************************************
*                 CHECKOUT FUNCTIONS
*********************************************************/
function saveOrder($same_shipping_address,$order_amount_total, $shipping_amount, $shipping_mode, $shipping_weight, $lang, $order_status, $payment_status)
{
	$orderId       = 0;
	$order_amount_vat = 0;

	$requiredField = array('first_name', 'last_name', 'address1', 'city', 'zip','buyer_email','country');
						   
	if (checkRequiredPost($requiredField)) {
	    extract($_POST);
		
		// make sure the first character in the 
		// customer and city name are properly upper cased
		//$hidShippingFirstName = ucwords($hidShippingFirstName);
		//$hidShippingLastName  = ucwords($hidShippingLastName);
		//$hidPaymentFirstName  = ucwords($hidPaymentFirstName);
		//$hidPaymentLastName   = ucwords($hidPaymentLastName);
		//$hidShippingCity      = ucwords($hidShippingCity);
		//$hidPaymentCity       = ucwords($hidPaymentCity);
		
		if (1==$same_shipping_address){
			$billing_first_name  = $first_name;
			$billing_last_name = $last_name;
			$billing_address1 = $address1;
			$billing_city = $city;
			$billing_zip = $zip;
			$billing_country = $country;
			$billing_email = $buyer_email; 
		}
	
		$cartContent = getCartContent('_en');
		$numItem     = count($cartContent);

		if ($billing_country == 'France') {
			$order_amount_vat = $order_amount_total - ($order_amount_total/1.2);
		}

		// save order & get order id

		$sid = session_id();

		$sql = "SELECT od_id 
			FROM tbl_order 
			WHERE od_session_id='$sid'"; 

		$result = dbQuery($sql);

        	if ($row = dbFetchAssoc($result)) {

	                $cartContent[] = $row;
			$sql = "UPDATE tbl_order SET
                                        od_date = od_date, 
					od_last_update = NOW(), 
					od_shipping_email = '$buyer_email', 
					od_shipping_first_name = '$first_name', 
					od_shipping_last_name = '$last_name', 
					od_shipping_address1 = '$address1',
					od_shipping_phone = '$phone', 
					od_shipping_city = '$city', 
					od_shipping_zip = '$zip', 
					od_shipping_country = '$country',
                                        od_amount_total = '$order_amount_total', 
					od_amount_vat = '$order_amount_vat', 
					od_shipping_mode = '$shipping_mode',
					od_shipping_cost = '$shipping_amount',
                                        od_payment_first_name = '$billing_first_name', 
					od_payment_last_name = '$billing_last_name', 
					od_payment_address1 = '$billing_address1', 
                                        od_payment_email = '$billing_email', 
					od_payment_city = '$billing_city', 
					od_payment_zip = '$billing_zip', 
					od_payment_country = '$billing_country' ,
					od_shipping_weight = '$shipping_weight',
					od_lang = '$lang',
					od_order_status = '$order_status',
					od_payment_status = '$payment_status'
				WHERE od_session_id = '$sid'";
                        $result = dbQuery($sql);

			$orderId = $row['od_id'];

                        if ($orderId) {
                        // update order items

				// delete all items
                                $sql = "DELETE FROM tbl_order_item WHERE od_id = $orderId";
                                $result = dbQuery($sql);

				// insert new items
                                for ($i = 0; $i < $numItem; $i++) {
                                $pri=new ProductInfo();
                                //print_r($cartContent[$i]);
                               // echo "<br>";
                                $pri->setPdid($cartContent[$i]['pd_id']);
                               // echo $cartContent[$i]['pi_id']." 1<br>";
                                  if(isset($_SESSION["session_name"])) {
                                          //$_session=true;

                                          $_customer_c=new Customer($_SESSION["session_name"],null,null,null);
                                          $customerprice=$pri->getPrice($_customer_c->getType());
                                          if($customerprice==''){
                                             $customerprice=$pri->getPrice(ID_DEFAULT_CUSTOMER_TYPE);
                                          }
                                          
                                         }else{
                                         
                                              $customerprice=$pri->getPrice(ID_DEFAULT_CUSTOMER_TYPE);
                                         }
                                         
                                     /*   $sql = "INSERT INTO tbl_order_item(od_id, oi_pi_id, oi_price, oi_qty, oi_amount, oi_pd_reference, oi_pi_flavor, oi_voucher_id)
                                                VALUES ($orderId, {$cartContent[$i]['pi_id']}, {$cartContent[$i]['ta_price']}, {$cartContent[$i]['ct_qty']},
                                                        {$cartContent[$i]['ta_price']}*{$cartContent[$i]['ct_qty']}, '{$cartContent[$i]['pd_reference']}', '{$cartContent[$i]['pi_flavor']}', {$cartContent[$i]['ct_voucher_id']})";*/
                                                        $sql = "INSERT INTO tbl_order_item(od_id, oi_pi_id, oi_price, oi_qty, oi_amount, oi_pd_reference, oi_pi_flavor, oi_voucher_id)
                                                VALUES ($orderId, {$cartContent[$i]['pi_id']}, $customerprice, {$cartContent[$i]['ct_qty']},
                                                        $customerprice*{$cartContent[$i]['ct_qty']}, '{$cartContent[$i]['pd_reference']}', '{$cartContent[$i]['pi_flavor']}', {$cartContent[$i]['ct_voucher_id']})";
                                                       // echo $sql;
//         echo $sql;
	                               $result = dbQuery($sql);
                                }

                        }

	        } else {

			$sql = "INSERT INTO tbl_order(
					od_date, od_last_update, od_shipping_email, 
					od_shipping_first_name, od_shipping_last_name, od_shipping_address1, 
					od_shipping_phone, od_shipping_city, od_shipping_zip, od_shipping_country, 
					od_amount_total, od_amount_vat, od_shipping_cost, od_shipping_mode, od_shipping_weight,
					od_payment_first_name, od_payment_last_name, od_payment_address1,  
					od_payment_email, od_payment_city, od_payment_zip, od_payment_country, od_session_id, 
					od_reference, od_lang, od_order_status, od_payment_status)
				VALUES (
					NOW(), NOW(), '$buyer_email', '$first_name', '$last_name', '$address1',  
					'$phone', '$city', '$zip', '$country', '$order_amount_total','$order_amount_vat','$shipping_amount','$shipping_mode','$shipping_weight',
					'$billing_first_name', '$billing_last_name', '$billing_address1', 
					'$billing_email', '$billing_city', '$billing_zip','$billing_country', '$sid',
					Concat(UPPER(LEFT('$first_name',1)),UPPER(LEFT(MONTHNAME(NOW()),2)),CAST(ROUND(RAND()*100000) as CHAR)), '$lang', '$order_status', '$payment_status')";
			$result = dbQuery($sql);

			// get the order id
			$orderId = dbInsertId();
		
			if ($orderId) {
			// save order items
				for ($i = 0; $i < $numItem; $i++) {
				
				 $pri=new ProductInfo();
                                $pri->setPdid($cartContent[$i]['pd_id']);
                                
                                  if(isset($_SESSION["session_name"])) {
                                          //$_session=true;

                                          $_customer_c=new Customer($_SESSION["session_name"],null,null,null);
                                          $customerprice=$pri->getPrice($_customer_c->getType());
                                         }else{
                                         
                                              $customerprice=$pri->getPrice(ID_DEFAULT_CUSTOMER_TYPE);
                                         }
                                         
				
					/*$sql = "INSERT INTO tbl_order_item(od_id, oi_pi_id, oi_price, oi_qty, oi_amount, oi_pd_reference, oi_pi_flavor, oi_voucher_id)
						VALUES ($orderId, {$cartContent[$i]['pi_id']}, {$cartContent[$i]['ta_price']}, {$cartContent[$i]['ct_qty']},
							{$cartContent[$i]['ta_price']}*{$cartContent[$i]['ct_qty']}, '{$cartContent[$i]['pd_reference']}', '{$cartContent[$i]['pi_flavor']}', {$cartContent[$i]['ct_voucher_id']})";*/
				        $sql = "INSERT INTO tbl_order_item(od_id, oi_pi_id, oi_price, oi_qty, oi_amount, oi_pd_reference, oi_pi_flavor, oi_voucher_id)
						VALUES ($orderId, {$cartContent[$i]['pi_id']}, $customerprice, {$cartContent[$i]['ct_qty']},
							$customerprice*{$cartContent[$i]['ct_qty']}, '{$cartContent[$i]['pd_reference']}', '{$cartContent[$i]['pi_flavor']}', {$cartContent[$i]['ct_voucher_id']})";                   //echo $sql;
					$result = dbQuery($sql);
				}
		
			}		
			
			// update the cart with the orderId, to be able to delete it when the order is paid
			//$sql = "UPDATE tbl_cart
			//	SET ct_orderId = $orderId
			//	WHERE ct_id = xxx"; 
			// update product stock
			//for ($i = 0; $i < $numItem; $i++) {
			//	$sql = "UPDATE tbl_product 
			//	        SET pd_qty = pd_qty - {$cartContent[$i]['ct_qty']}
			//			WHERE pd_id = {$cartContent[$i]['pd_id']}";
			//	$result = dbQuery($sql);
			//}
			
		
			// then remove the ordered items from cart
			//for ($i = 0; $i < $numItem; $i++) {
			//	$sql = "DELETE FROM tbl_cart
			//	        WHERE ct_id = {$cartContent[$i]['ct_id']}";
			//	$result = dbQuery($sql);
			//}
		}
	} else {
		$orderId = -1;
	}
	
	return $orderId;
}

function useUpAllVouchers($orderId) {

	$error=0;
        $sql = "SELECT oi_voucher_id, vo_state FROM tbl_order_item, tbl_voucher WHERE oi_voucher_id = vo_id AND od_id=$orderId ORDER BY vo_state DESC";
        $result = dbQuery($sql);

        if (dbNumRows($result) > 0) {
		while (($row = dbFetchAssoc($result)) && ($error == 0)) {
                	if ($row['vo_state'] != 2) {
      				$sql = "UPDATE tbl_voucher SET vo_last_update=NOW(), vo_state=2 WHERE vo_id=";
				$sql .= $row['oi_voucher_id'];
				$result2 = dbQuery($sql);
                	} else {
				$error=1;	
       	        	}
		}
	}	
	return $error;

}

function updateOrder($orderId, $order_status, $payment_status) {

	$sql = "UPDATE tbl_order SET od_last_update=NOW(), od_order_status='$order_status', od_payment_status='$payment_status' WHERE od_id=$orderId"; 
	$result = dbQuery($sql);
}

/*
	Get order total amount ( total purchase + shipping cost )
*/
function getOrderAmount($orderId)
{
	$orderAmount = 0;
	
	$sql = "SELECT SUM(ta_price * od_qty)
	        FROM tbl_order_item oi, tbl_product p, tbl_tariff ta 
		WHERE oi.pd_id = p.pd_id 
	        AND oi.od_id = $orderId
		AND p.pd_id = ta.ta_pd_id
		AND ta.ta_category = 0   
			
		UNION
	
		SELECT od_shipping_cost 
		FROM tbl_order
		WHERE od_id = $orderId";
	$result = dbQuery($sql);

	if (dbNumRows($result) == 2) {
		$row = dbFetchRow($result);
		$totalPurchase = $row[0];
		
		$row = dbFetchRow($result);
		$shippingCost = $row[0];
		
		$orderAmount = $totalPurchase + $shippingCost;
	}	
	
	return $orderAmount;
}

/*
        Get all order details 
*/
function getOrderDetails($orderId, $lang)
{

	$orderDetails = array();

        $sql = "SELECT  od_date, od_last_update, od_order_status, od_payment_status,
                        od_shipping_first_name, od_shipping_last_name, od_shipping_address1,
                        od_shipping_phone, od_shipping_city, od_shipping_zip, od_shipping_country,
                        od_amount_total, od_amount_vat, od_shipping_cost,
                        od_payment_first_name, od_payment_last_name, od_payment_address1,
                        od_payment_email, od_payment_city, od_payment_zip, od_payment_country, od_session_id,
			od_reference,
			oi_pi_id, oi_price, oi_qty, oi_amount, oi_pd_reference, oi_pi_flavor,
			pd_thumbnail, pd_image_large,
			(SELECT text
                         FROM language_items
                         WHERE (lang='_en' or lang='$lang')
                                AND  item= ( select concat('product_',pd_reference,'_name') from tbl_product, tbl_product_item where pi_pd_id = pd_id and pi_id = oi.oi_pi_id)
                                AND  text <> ''
                         ORDER by lang asc limit 1) as pd_name
                FROM    tbl_order od, tbl_order_item oi, tbl_product_item pi, tbl_product pd
                WHERE   od.od_id = '$orderId'
		AND     od.od_id = oi.od_id
                AND     oi.oi_pi_id = pi.pi_id
		AND	pd.pd_id = pi.pi_pd_id";
                        

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

        	$orderDetails[] = $row;;
        } 

	return $orderDetails;

}

?>
