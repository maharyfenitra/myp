<head>
        <?php include './php_includes/head.php';
          require_once 'php_includes/field_controle.php';
 ?>
</head>

<body style="background-image:url(images/background3.png)" onload="onPageLoad();" onunload="onPageUnload();">

<?php

$errorMessage = '&nbsp;';

/*
 Make sure all the required field exist is $_POST and the value is not empty
 Note: txtShippingAddress2 and txtPaymentAddress2 are optional
*/

$requiredField = array('order_transaction_number');

if (!checkRequiredPost($requiredField)) {
	$errorMessage = 'Input not complete';
}

$order_transaction_number = $_GET['order_transaction_number'];

// get ordered items
$sql = "SELECT oi_pd_reference, oi_pi_id, oi_pi_flavor, oi_price, oi_qty
            FROM tbl_order_item oi, tbl_order od 
                WHERE oi.od_id = od.od_id
		AND od.od_transaction_number = '$order_transaction_number'
                ORDER BY od.od_id ASC";

$result = dbQuery($sql);
$orderedItem = array();
while ($row = dbFetchAssoc($result)) {
        $orderedItem[] = $row;
}


$sql = "SELECT od_date, od_last_update, od_payment_status, od_shipping_first_name, od_shipping_last_name, od_shipping_address1,
               od_shipping_phone, od_shipping_email, od_shipping_state, od_shipping_city, od_shipping_zip, od_shipping_country, 
	       od_shipping_cost, od_shipping_mode,od_shipping_weight,
               od_payment_first_name, od_payment_last_name, od_payment_address1,
               od_payment_state, od_payment_city , od_payment_zip, od_payment_country,
               od_payment_email, od_memo
       FROM tbl_order 
       WHERE od_transaction_number = '$order_transaction_number'";

$result = dbQuery($sql);
extract(dbFetchAssoc($result));

if (!(isSet($_POST['same_invoice_address'])) && (isSet($_POST['h_same_invoice_address'])&&isValidField($_POST['h_same_invoice_address']))) { $_POST['same_invoice_address']=$_POST['h_same_invoice_address']; }
if (!(isSet($_POST['first_name'])) && (isSet($_POST['h_first_name'])&&isValidField($_POST['h_first_name']))) { $_POST['first_name']=$_POST['h_first_name']; }
if (!(isSet($_POST['last_name'])) && (isSet($_POST['h_last_name'])&&isValidField($_POST['h_last_name']))) { $_POST['last_name']=$_POST['h_last_name']; }
if (!(isSet($_POST['address1'])) && (isSet($_POST['h_address1'])&&isValidField($_POST['h_address1']))) { $_POST['address1']=$_POST['h_address1']; }
if (!(isSet($_POST['city'])) && (isSet($_POST['h_city'])&&isValidField($_POST['h_city']))) { $_POST['city']=$_POST['h_city']; }
if (!(isSet($_POST['zip'])) && (isSet($_POST['h_zip'])&&isValidField($_POST['h_zip']))) { $_POST['zip']=$_POST['h_zip']; }
if (!(isSet($_POST['country'])) && (isSet($_POST['h_country'])&&isValidField($_POST['h_country']))) { $_POST['country']=$_POST['h_country']; }
if (!(isSet($_POST['buyer_email'])) && (isSet($_POST['h_buyer_email'])&&isValidField($_POST['h_buyer_email']))) { $_POST['buyer_email']=$_POST['h_buyer_email']; }
if (!(isSet($_POST['phone'])) && (isSet($_POST['h_phone'])&&isValidField($_POST['h_phone']))) { $_POST['phone']=$_POST['h_phone']; }
if (!(isSet($_POST['billing_first_name'])) && (isSet($_POST['h_billing_first_name'])&&isValidField($_POST['h_billing_first_name']))) { $_POST['billing_first_name']=$_POST['h_billing_first_name']; }
if (!(isSet($_POST['billing_last_name'])) && (isSet($_POST['h_billing_last_name'])&&isValidField($_POST['h_billing_last_name']))) { $_POST['billing_last_name']=$_POST['h_billing_last_name']; }
if (!(isSet($_POST['billing_address1'])) && (isSet($_POST['h_billing_address1'])&&isValidField($_POST['h_billing_address1']))) { $_POST['billing_address1']=$_POST['h_billing_address1']; }
if (!(isSet($_POST['billing_city'])) && (isSet($_POST['h_billing_city'])&&isValidField($_POST['h_billing_city']))) { $_POST['billing_city']=$_POST['h_billing_city']; }
if (!(isSet($_POST['billing_zip'])) && (isSet($_POST['h_billing_zip'])&&isValidField($_POST['h_billing_zip']))) { $_POST['billing_zip']=$_POST['h_billing_zip']; }
if (!(isSet($_POST['billing_country'])) && (isSet($_POST['h_billing_country'])&&isValidField($_POST['h_billing_country']))) { $_POST['billing_country']=$_POST['h_billing_country']; }
if (!(isSet($_POST['billing_email'])) && (isSet($_POST['h_billing_email'])&&isValidField($_POST['h_billing_email']))) { $_POST['billing_email']=$_POST['h_billing_email']; }
if (!(isSet($_POST['optPayment'])) && (isSet($_POST['h_optPayment'])&&isValidField($_POST['h_optPayment']))) { $_POST['optPayment']=$_POST['h_optPayment']; }

/* $local_same_invoice_address= $_POST['same_invoice_address'];
$local_first_name = $_POST['first_name'];
$local_last_name = $_POST['last_name'];
$local_address1 = $_POST['address1'];
$local_city = $_POST['city'];
$local_zip = $_POST['zip'];
$local_country = $_POST['country'];
$local_buyer_email = $_POST['buyer_email'];
$local_phone = $_POST['phone'];
$local_billing_first_name = $_POST['billing_first_name'];
$local_billing_last_name = $_POST['billing_last_name'];
$local_billing_address1 = $_POST['billing_address1'];
$local_billing_city = $_POST['billing_city'];
$local_billing_zip = $_POST['billing_zip'];
$local_billing_country = $_POST['billing_country'];
$local_billing_email = $_POST['billing_email'];
$local_optPayment = $_POST['optPayment'];

$local_same_invoice_address= $_POST['same_invoice_address'];
*/

$local_first_name = $od_shipping_first_name;
$local_last_name = $od_shipping_last_name;
$local_address1 = $od_shipping_address1;
$local_city = $od_shipping_city;
$local_zip = $od_shipping_zip;
$local_country = $od_shipping_country;
$local_buyer_email = $od_shipping_email;
$local_phone = $od_shipping_phone;
$local_billing_first_name = $od_payment_first_name;
$local_billing_last_name = $od_payment_last_name;
$local_billing_address1 = $od_payment_address1;
$local_billing_city = $od_payment_city;
$local_billing_zip = $od_payment_zip;
$local_billing_country = $od_payment_country;
$local_billing_email = $od_payment_email;
//$local_optPayment = $_POST['optPayment'];



require_once "productItemList.php";

$numItem  = count($orderedItem);
$subTotal = 0;
/*
for ($i = 0; $i < $numItem; $i++) {
        extract($orderedItem[$i]);
        $subTotal += $oi_price * $oi_qty;
?>
    <tr class="content"> 
        <td><?php echo "$oi_qty x $oi_pd_reference"; ?></td>
        <td><?php echo "$oi_pi_flavor"; ?></td>
        <td align="right"><?php echo displayAmount($oi_price); ?></td>
        <td align="right"><?php echo displayAmount($oi_qty * $oi_price); ?></td>
    </tr>
 <?php
}
*/

//$numItem  = count($cartContent);
$subTotal = 0;
$vatTotal = 0;
$totalWeight = 0;
$shippingCost = 0;
$expressShipping = 0;
$table_content = '';

$customer_form_content = '';		
//$customer_form_content .= '<input name="same_invoice_address" type="hidden" id="hidShippingSameInvoiceAddress" value="';
//$customer_form_content .= $local_same_invoice_address;
//$customer_form_content .= '">';
$customer_form_content .= '<input name="first_name" type="hidden" id="hidShippingFirstName" value="';
$customer_form_content .= $local_first_name;
$customer_form_content .= '">';
$customer_form_content .= '<input name="last_name" type="hidden" id="hidShippingLastName" value="';
$customer_form_content .= $local_last_name;
$customer_form_content .= '">';
$customer_form_content .= '<input name="address1" type="hidden" id="hidShippingAddress1" value="';
$customer_form_content .= $local_address1;
$customer_form_content .= '">';
$customer_form_content .= '<input name="city" type="hidden" id="hidShippingCity" value="';
$customer_form_content .= $local_city;
$customer_form_content .= '">';
$customer_form_content .= '<input name="zip" type="hidden" id="hidShippingZip" value="';
$customer_form_content .= $local_zip;
$customer_form_content .= '">';
$customer_form_content .= '<input name="country" type="hidden" id="hidShippingCountry" value="';
$customer_form_content .= $local_country;
$customer_form_content .= '">';
$customer_form_content .= '<input name="buyer_email" type="hidden" id="hidShippingBuyerEmail" value="';
$customer_form_content .= $local_buyer_email;
$customer_form_content .= '">';
$customer_form_content .= '<input name="phone" type="hidden" id="hidShippingPhone" value="';
$customer_form_content .= $local_phone;
$customer_form_content .= '">';
$customer_form_content .= '<input name="billing_first_name" type="hidden" id="hidShippingBillingFirstName" value="';
$customer_form_content .= $local_billing_first_name;
$customer_form_content .= '">';
$customer_form_content .= '<input name="billing_last_name" type="hidden" id="hidShippingBillingLastName" value="';
$customer_form_content .= $local_billing_last_name;
$customer_form_content .= '">';
$customer_form_content .= '<input name="billing_address1" type="hidden" id="hidShippingAddress1" value="';
$customer_form_content .= $local_billing_address1;
$customer_form_content .= '">';
$customer_form_content .= '<input name="billing_city" type="hidden" id="hidShippingCity" value="';
$customer_form_content .= $local_billing_city;
$customer_form_content .= '">';
$customer_form_content .= '<input name="billing_zip" type="hidden" id="hidShippingZip" value="';
$customer_form_content .= $local_billing_zip;
$customer_form_content .= '">';
$customer_form_content .= '<input name="billing_country" type="hidden" id="hidShippingCountry" value="';
$customer_form_content .= $local_billing_country;
$customer_form_content .= '">';
$customer_form_content .= '<input name="billing_email" type="hidden" id="hidShippingBillingEmail" value="';
$customer_form_content .= $local_billing_email;
$customer_form_content .= '">';
//$customer_form_content .= '<input name="optPayment" type="hidden" id="hidPaymentMethod" value="';
//$customer_form_content .= $local_optPayment;
//$customer_form_content .= '">';

$payment_form_content = '';
$payment_online_form_content = '';
$payment_offline_form_content = '';

/* --    Standard Paypal        -- */
	/* --    URL               -- */
		/* --    Real URL               -- */
//		$payment_online_form_content .= '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">';
		/* -- Sandbox URL               -- */
//		$payment_online_form_content .= '<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">';

	/* --    Command  -- */
//	$payment_online_form_content .= '<input type="hidden" name="upload" value="1">';
		/* --    Standard Cart  -- */
//		$payment_online_form_content .= '<input type="hidden" name="cmd" value="_cart">';
		/* --    Extended Cart  -- */
//		$payment_online_form_content .= '<input type="hidden" name="cmd" value="_ext_enter">';
//		$payment_online_form_content .= '<input type="hidden" name="redirect_cmd" value="_cart">';

/* -- Paypal Integral Evolution -- */
	/* --    URL               -- */
		$payment_online_form_content .= '<form name="frmPaypal" action="'.PAYPAL_URL_ACQUIRINGWEB.'" method="post">';
//		$payment_online_form_content .= '<form name="frmPaypal" action="https://securepayments.paypal.com/cgi-bin/acquiringweb" method="post">'; // Production
//		$payment_online_form_content .= '<form name="frmPaypal" action="https://securepayments.sandbox.paypal.com/cgi-bin/acquiringweb" method="post">'; // Sandbox

	/* --    Command  -- */
	$payment_online_form_content .= '<input type="hidden" name="cmd" value="_hosted-payment">';
	$payment_online_form_content .= '<input type="hidden"  name="paymentaction" value="sale">';

/* -- Business -- */
	$payment_online_form_content .= '<input type="hidden" name="business" value="'.PAYPAL_BUSINESS_IDENTIFIER.'">'; // Production
//	$payment_online_form_content .= '<input type="hidden" name="business" value="JSP6KH63XPALY">'; // Production
//	$payment_online_form_content .= '<input type="hidden" name="business" value="SDN7WHBXADW2L">'; // Sandbox 
//	$payment_online_form_content .= '<input type="hidden" name="business" value="booboo_1358640646_biz@eoskates.com">';  // old test


/* -- Return URL -- */
$payment_online_form_content .= '<input type="hidden"  name="return" value="http://'.$_SERVER['SERVER_NAME'].'/Store.php">';
$payment_online_form_content .= '<input type="hidden"  name="notify_url" value="http://'.$_SERVER['SERVER_NAME'].'/Store_paypal_notify_handler.php">';

$payment_offline_form_content .= '<form action="';
$payment_offline_form_content .= $_SERVER['PHP_SELF'];
$payment_offline_form_content .= '" method="post" name="frmCheckout" id="frmCheckout">';
$payment_offline_form_content .= '<input name="step" type="hidden" value="4">';
$payment_offline_form_content .= '<input name="reset_session" type="hidden" value="1">';
$payment_offline_form_content .= $customer_form_content;

//if ("payment_online" == $local_optPayment) {
	$payment_form_content = $payment_online_form_content;
//} else {
//	$payment_form_content = $payment_offline_form_content;
//}

/* -- Currency -- */
$payment_form_content .= '<input type="hidden" name="currency_code" value="EUR">';

$cart_ok = 1;

$payment_form_content_detail = '';

for ($i = 0; $i < $numItem; $i++) {
        extract($orderedItem[$i]);
        $subTotal += $oi_price * $oi_qty;
	//$totalWeight += $pi_shipping_weight * $oi_qty;
	$table_content .= "<tr class='content' valign='middle'>";
	$table_content .= "<td align='left'><font size='2'>";
	if ((isSet($error_msg)) && ($pi_id < 0)) {
		$table_content .= "<font color='red'>";
	}
	$table_content .= "$oi_qty x $oi_pd_reference";
	$payment_form_content_detail .= '<input type="hidden" name="item_name_';
	$payment_form_content_detail .= $i+1;
	$payment_form_content_detail .= '" value="'; 
	$payment_form_content_detail .= $oi_pd_reference; 
        $payment_form_content_detail .= '">';
	$payment_form_content_detail .= '<input type="hidden" name="item_number_';
	$payment_form_content_detail .= $i+1;
	$payment_form_content_detail .= '" value="';
	$payment_form_content_detail .= $i+1;
	$payment_form_content_detail .= '">';
	$payment_form_content_detail .= '<input type="hidden" name="amount_';
	$payment_form_content_detail .= $i+1;
	$payment_form_content_detail .= '" value="';
	$payment_form_content_detail .= $oi_price;
	$payment_form_content_detail .= '">';

	if ((isSet($error_msg)) && ($pi_id < 0)) {
                $table_content .= "</font>";
        }

	$table_content .= "</td><td align='center' ><font size='2'>";

	if (isSet($oi_pi_flavor)) {
		$table_content .= $oi_pi_flavor;
	} 
	$table_content .= "</font></td>";
	$table_content .= " <td align='right'><font size='2'>";
	$table_content .= displayAmount($oi_price);
	$table_content .= "&nbsp;</font></td>";

        $table_content .= "<td align='right'><font size='2'>";
	$table_content .= displayAmount($oi_qty * $oi_price); 
	$table_content .= "&nbsp;</font></td>";
        $table_content .= "</tr>";
}

/*
$shippingCostExpress = db_get_shipping_express_cost('EUR', $_POST['country'], $totalWeight, $subTotal);
$shippingCostStandard = db_get_shipping_standard_cost('EUR', $_POST['country'], $totalWeight, $subTotal);

$shippingMode = "Standard";

if (isSet($_POST['shipping_mode']) && ('express' == $_POST['shipping_mode'])) {
	$expressShipping = 1;
	$shippingCost = $shippingCostExpress;
	$shippingMode = "Express";
} else { 
	$expressShipping = 0;
	$shippingCost = $shippingCostStandard;
}
*/
//echo "same address: ";
//echo $_POST['same_invoice_address'];  
//echo "-";

if (1==$cart_ok) {
	/* -- Standard Paypal           -- */
//	$payment_form_content .= $payment_form_content_detail;

	/* -- Paypal Integral Evolution -- */
	$payment_form_content .= '<input type="hidden" name="subtotal" value="';
	$payment_form_content .= displayPaypalAmount($subTotal+$shippingCost);
	$payment_form_content .= '">';

	$payment_form_content .= '<input type="hidden" name="shipping_cost" value="';
	$payment_form_content .= displayPaypalAmount($shippingCost);
	$payment_form_content .= '">';

//	$orderId = saveOrder($_POST['same_invoice_address'],displayPaypalAmount($subTotal+$shippingCost),displayPaypalAmount($shippingCost),$shippingMode,$totalWeight);

	$payment_form_content .= '<input type="hidden" name="custom" value="';
//        $payment_form_content .= $orderId;
        $payment_form_content .= '">';

}
?>

<table width="842" border="0" cellpadding="10" cellspacing="0">
    <tr> 
	<td align="left">
      		<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="POST" name="frmCheckout" id="frmCheckout">
          	<?php
		echo $customer_form_content;
		?>
		<input name="step" type="hidden" value="1">
		
		

		
		<input class="box" name="btnBack" type="submit" id="btnBack" value="<?php echo db_return_text($lang,'store','checkout_back'); ?>" style=" background:url(images/button_previous.png);background-size:100px 20px; background-repeat:no-repeat; background-position:center; color:#dddddd; font-size:11px; border:0; align:center; width: 100px; margin-top: 5px;" alt=<?php echo db_return_text($lang,'store','checkout_modify_shipping_info'); ?>></input>
		
		
		
		</form>
	</td>

	<td align="center" height="40"><font color="black" size="4"><?php db_get_text($lang, 'store', 'order_view_title'); echo ': '; echo $order_transaction_number; ?></font><font color="red" size="2"><?php if (isSet($error_msg)) echo $error_msg; ?></td>
        <td align="center">
<?php
        if (1==$cart_ok) {

                if (1==$expressShipping) {
                          $payment_form_content .= '<input name="shipping_mode" type="hidden" value="express">';
		} else {
                          $payment_form_content .= '<input name="shipping_mode" type="hidden" value="standard">';
		}

                $payment_form_content .= '<input name="METHOD" type="submit" id="btnConfirm" value="';
				$payment_form_content .= db_return_text($lang, 'store', 'checkout_confirm_and_pay'); 
                $payment_form_content .= '" style="background:url(images/Button_Confirm.png);background-size:150px 20px; background-repeat:no-repeat; background-position:center; color:#dddddd; font-size:11px; border:0; align:center; width:150px; margin-top: 5px;" alt="';
                
                $payment_form_content .= db_return_text($lang,'store','checkout_confirm_and_pay');
               
                $payment_form_content .= '&nbsp;" class="box"></form>';
               
                echo $payment_form_content;
	}
?>
	</td>
    </tr>
</table>

<?php
//	if (0==$cart_ok) { 
		echo '<form action="';
		echo $_SERVER['PHP_SELF']; 
		echo '" method="post" name="frmCheckout" id="frmCheckout" onSubmit="return checkShippingAndPaymentInfo();">';
                echo '<input name="step" type="hidden" value="3">';
//	} 
?>

<table width="650" >
 <tr>
  <td valign="top">
    <table width="200" border="0" align="right" cellpadding="0" cellspacing="1" class="infoTable">
        <tr class="infoTableHeader">
            <td colspan="2"><font color="black" size="2"><?php db_get_text($lang, 'store', 'checkout_shipping_address'); ?><br> </font> </td>
            <?php echo $customer_form_content; ?>
        </tr>

        <tr>
            <td style="padding-left:10px;" class="content">
		<?php 
		echo $local_first_name; echo "&nbsp;"; 
		echo $local_last_name; 
		?>
	    </td>
        </tr>

        <tr>
            <td style="padding-left:10px;" class="content">
                <?php
		echo $local_address1; 
	        ?>
	    </td>
        </tr>

        <tr>
            <td style="padding-left:10px;" class="content">
                <?php 
		echo $local_city; echo "&nbsp;"; 
		echo $local_zip; 
                ?>
	    </td>
        </tr>
        <tr>
            <td style="padding-left:10px;" class="content">
		<?php 
		echo $local_country;
                ?>
            </td>
        </tr>
        <tr>
            <td style="padding-left:10px;" class="content">
		<?php 
		echo $local_buyer_email;
		?>
           </td>
        </tr>
        <tr>
            <td style="padding-left:10px;" class="content">
		<?php 
		echo $local_phone;
                ?>
           </td>
        </tr>

        <tr class="infoTableHeader">
            <td colspan="2">&nbsp; </td>
        </tr>
        <tr class="infoTableHeader">
            <td colspan="2"><font color="black" size="2">
		<?php 
//			if ("1"==$local_same_invoice_address) {
//				db_get_text($lang, 'store', 'checkout_same_invoice_address');
//			} else {
				db_get_text($lang, 'store', 'checkout_billing_address');
//			} 
		?>
		<br> </font> 
	    </td>
        </tr>

        <tr>
            <td style="padding-left:10px;" class="content">
                <?php
		echo $local_billing_first_name; echo "&nbsp;";
		echo $local_billing_last_name;
                ?>
            </td>
        </tr>


        <tr>
            <td style="padding-left:10px;" class="content">
                <?php
		echo $local_billing_address1;
                ?>
            </td>
        </tr>

        <tr>
            <td style="padding-left:10px;" class="content">
                <?php
		echo $local_billing_city; echo "&nbsp;";
		echo $local_billing_zip;
                ?>
            </td>
        </tr>
        <tr>
            <td style="padding-left:10px;" class="content">
                <?php
		echo $local_billing_country;
                ?>
            </td>
        </tr>
        <tr>
            <td style="padding-left:10px;" class="content">
                <?php
		echo $local_billing_email;
                ?>
           </td>
        </tr>

      </td></tr>
    </table>

  <td valign="top">
    <table width="600" border="1" bordercolor="#aaaaaa" align="left" cellpadding="2" cellspacing="0" >
        <tr class="label">
            <td align="center"><font color="black" size="2"><?php echo db_return_text($lang,'store','designation'); ?><br></font></td>
            <td align="center" width="100"><font color="black" size="2"><?php echo db_return_text($lang,'store','model'); ?><br></font></td>
            <td align="center" width="80"><font color="black" size="2"><?php echo db_return_text($lang,'store','price'); ?><br></font></td>
            <td align="center" width="100"><font color="black" size="2"><?php echo db_return_text($lang,'store','total'); ?><br></font></td>
        </tr>

<?php echo $table_content; ?>

        <tr class="content" cellpadding="5">
            <td colspan="3" align="right">
		<table border="0" width="100%">
		<tr><td width="340" align="right">
		<br>
		<?php 
			if (0==$cart_ok) {
                          echo '<input name="METHOD" type="submit" id="btnConfirm" value="';
                          echo db_return_text($lang,'store','cart_update');
                          echo '" class="box" style=" background:url(images/Button_Update.png);background-size:150px 20px; background-repeat:no-repeat; background-position:center; color:#dddddd; font-size:11px; border:0; align:center; width: 150px; " >';
                          echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</form>';
                	 }
		?>
		</td><td width="80" align="right">
		<br>
		<?php	 
			echo db_return_text($lang,'store','cart_sub_total'); 
		?> &nbsp;
		</td></tr>
		</table>
  	  </td>
            <td align="right"><br><?php echo displayAmount($subTotal); ?>&nbsp;</td>
        </tr>

        <tr class="content">
            <td colspan="3" align="right">
		<table width="100%" border="0">
		<tr><td align="center">&nbsp;
		<?php
/*                if (1==$cart_ok) {
			$diff = $shippingCostExpress - $shippingCostStandard;
                        if (1==$expressShipping) {
                          echo '<input name="shipping_mode" type="hidden" value="standard">';
                          echo '<input name="METHOD" type="submit" id="btnConfirm" value="';
                          echo db_return_text($lang,'store','switch_shipping_mode_to_standard');
                          echo ': -'; echo $diff; echo ' Euro " class="box" style=" background:url(images/Button_Express_Truck.png);background-size:300px 20px; background-repeat:no-repeat; background-position:center; color:#dddddd; font-size:11px; border:0; align:center; width: 300px; " >';
                          echo '&nbsp;&nbsp;</form>';
                        } else {
                          echo '<input name="shipping_mode" type="hidden" value="express">';
                          echo '<input name="METHOD" type="submit" id="btnConfirm" value="';
                          echo db_return_text($lang,'store','switch_shipping_mode_to_express');
                          echo ': +'; echo $diff; echo ' Euro " class="box" style=" background:url(images/Button_Express_Plane.png);background-size:300px 20px; background-repeat:no-repeat; background-position:center; color:#dddddd; font-size:11px; border:0; align:center; width: 300px; ">';
                          echo '&nbsp;&nbsp;</form>';

                        }
		 } 
*/               ?>
		 </td><td align="right">
		<?php
			if (isSet($_POST['shipping_mode']) && ('express' == $_POST['shipping_mode'])) {
				echo db_return_text($lang,'store','shipping_express'); 
			} else {
				echo db_return_text($lang,'store','shipping'); 
			}
		?>

		 </td>
		 </tr></table>
	    </td>
            <td align="right"><?php echo displayAmount($shippingCost); ?>&nbsp;</td>
        </tr>

        <tr class="content">

            <td colspan="3" align="left"><font color="black" size="3">
            	<br>
	<table border="0" width="100%">
	<tr>
        <td width="120" class="infoTableHeader" align="left"><font color="black" size="2"><?php db_get_text($lang, 'store', 'checkout_payment_method'); ?>&nbsp;:&nbsp; </font> </td>
        <td class="content">
	  <?php
                echo '<input name="optPayment" type="hidden" id="hidShippingOptPayment" value="';
                echo $local_optPayment;
                echo '">';
 
// 		switch ($_POST['optPayment']) {
//		    case 'payment_online':
		        echo db_return_text($lang,'store','checkout_payment_method_online');
//		        break;
//		    case 'payment_offline':
//		        echo db_return_text($lang,'store','checkout_payment_method_offline');
//		        break;
//		}
	   ?>
	</td>
	<td class="content" align="right"><font color="black" size="3">
		<?php 
			echo db_return_text($lang,'store','total_amount'); 
			echo "&nbsp;</font>";
			if ('France' == $local_country) {
				echo "<br>"; 
				echo db_return_text($lang,'store','total_vat'); 
				echo "&nbsp;";
			}
		?>	
	</td>	
	</tr>
	</table>
            	<td align="right"><font color="black" size="3">
		<br>
		<?php 
			echo displayAmount($shippingCost + $subTotal); 
			echo "&nbsp;</font>";
			if ('France' == $local_country) {
				echo "<br>"; 
				echo displayAmount(($shippingCost + $subTotal)-($shippingCost + $subTotal)/1.2); 
				echo "&nbsp;";
			}
		?>
		</td>
        </tr>

    </table>
   </td>
 </tr>
</table>  

</body>

