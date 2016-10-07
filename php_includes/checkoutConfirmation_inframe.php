<head>
        <?php include './php_includes/head.php'; ?>
</head>

<body  onload="onPageLoad();" onunload="onPageUnload();">

<?php

$errorMessage = '&nbsp;';

/*
 Make sure all the required field exist is $_POST and the value is not empty
 Note: txtShippingAddress2 and txtPaymentAddress2 are optional
*/

$requiredField = array('first_name', 'last_name', 'address1', 'city', 'zip', 'country');
//$requiredField = array('txtShippingFirstName', 'txtShippingLastName', 'txtShippingAddress1', 'txtShippingPhone', 'txtShippingState',  'txtShippingCity', 'txtShippingPostalCode',
//                       'txtPaymentFirstName', 'txtPaymentLastName', 'txtPaymentAddress1', 'txtPaymentPhone', 'txtPaymentState', 'txtPaymentCity', 'txtPaymentPostalCode');

if (!checkRequiredPost($requiredField)) {
	$errorMessage = 'Input not complete';
}

$cartContent = getCartContent($lang);

if (!(isSet($_POST['same_invoice_address'])) && (isSet($_POST['h_same_invoice_address']))) { $_POST['same_invoice_address']=$_POST['h_same_invoice_address']; }
if (!(isSet($_POST['first_name'])) && (isSet($_POST['h_first_name']))) { $_POST['first_name']=$_POST['h_first_name']; }
if (!(isSet($_POST['last_name'])) && (isSet($_POST['h_last_name']))) { $_POST['last_name']=$_POST['h_last_name']; }
if (!(isSet($_POST['address1'])) && (isSet($_POST['h_address1']))) { $_POST['address1']=$_POST['h_address1']; }
if (!(isSet($_POST['city'])) && (isSet($_POST['h_city']))) { $_POST['city']=$_POST['h_city']; }
if (!(isSet($_POST['zip'])) && (isSet($_POST['h_zip']))) { $_POST['zip']=$_POST['h_zip']; }
if (!(isSet($_POST['country'])) && (isSet($_POST['h_country']))) { $_POST['country']=$_POST['h_country']; }
if (!(isSet($_POST['buyer_email'])) && (isSet($_POST['h_buyer_email']))) { $_POST['buyer_email']=$_POST['h_buyer_email']; }
if (!(isSet($_POST['phone'])) && (isSet($_POST['h_phone']))) { $_POST['phone']=$_POST['h_phone']; }
if (!(isSet($_POST['billing_first_name'])) && (isSet($_POST['h_billing_first_name']))) { $_POST['billing_first_name']=$_POST['h_billing_first_name']; }
if (!(isSet($_POST['billing_last_name'])) && (isSet($_POST['h_billing_last_name']))) { $_POST['billing_last_name']=$_POST['h_billing_last_name']; }
if (!(isSet($_POST['billing_address1'])) && (isSet($_POST['h_billing_address1']))) { $_POST['billing_address1']=$_POST['h_billing_address1']; }
if (!(isSet($_POST['billing_city'])) && (isSet($_POST['h_billing_city']))) { $_POST['billing_city']=$_POST['h_billing_city']; }
if (!(isSet($_POST['billing_zip'])) && (isSet($_POST['h_billing_zip']))) { $_POST['billing_zip']=$_POST['h_billing_zip']; }
if (!(isSet($_POST['billing_country'])) && (isSet($_POST['h_billing_country']))) { $_POST['billing_country']=$_POST['h_billing_country']; }
if (!(isSet($_POST['billing_email'])) && (isSet($_POST['h_billing_email']))) { $_POST['billing_email']=$_POST['h_billing_email']; }
if (!(isSet($_POST['optPayment'])) && (isSet($_POST['h_optPayment']))) { $_POST['optPayment']=$_POST['h_optPayment']; }

$local_same_invoice_address= $_POST['same_invoice_address'];
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
//$local_billing_city = $_POST['city'];
$local_billing_zip = $_POST['billing_zip'];
//$local_billing_zip = $_POST['zip'];
$local_billing_country = $_POST['billing_country'];
$local_billing_email = $_POST['billing_email'];
$local_optPayment = $_POST['optPayment'];
require_once "./customer/library/mail_confirmation_compte.php";
if(!isset($_SESSION['session_name'])&&!existCompte($_POST['buyer_email'])){
// echo "<h1>"."  mail :".$mail."</h1>";
$customer=new Customer("AUTO",$_POST['buyer_email'],"XXXX","");

       $customer->setAdress($_POST['address1']);
       $customer->setCountry($_POST['country']);
       $customer->setFirstName($_POST['first_name']);
       $customer->setLastName($_POST['last_name']);
      
       //$customer->setClub($_POST['club']);

       $customer->setZip($_POST['zip']);
       $customer->setCity($_POST['city']); 
       $customer->setPhone($_POST['phone']);
       

       new Mail_Confirmation_Compte($_POST['buyer_email'],getShopConfig()['email'],getShopConfig()['name'],$lang);

}
require_once "productItemList.php";
$numItem  = count($cartContent);
$subTotal = 0;
$vatTotal = 0;
$totalWeight = 0;
$shippingCost = 0;
$expressShipping = 0;
$table_content = '';

$customer_form_content = '';		
$customer_form_content .= '<input name="same_invoice_address" type="hidden" id="hidShippingSameInvoiceAddress" value="';
$customer_form_content .= $local_same_invoice_address;
$customer_form_content .= '">';
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
$customer_form_content .= '<input name="optPayment" type="hidden" id="hidPaymentMethod" value="';
$customer_form_content .= $local_optPayment;
$customer_form_content .= '">';

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

	/* --    Command  -- */
	$payment_online_form_content .= '<input type="hidden" name="cmd" value="_hosted-payment">';
	$payment_online_form_content .= '<input type="hidden"  name="paymentaction" value="sale">';

	/* -- Business -- */
	$payment_online_form_content .= '<input type="hidden" name="business" value="'.PAYPAL_BUSINESS_IDENTIFIER.'">';
//	$payment_online_form_content .= '<input type="hidden" name="business" value="JSP6KH63XPALY">';  -- Production
//	$payment_online_form_content .= '<input type="hidden" name="business" value="SDN7WHBXADW2L">';  -- Sandbox 
//	$payment_online_form_content .= '<input type="hidden" name="business" value="booboo_1358640646_biz@eoskates.com">'; -- old test 


/* -- Return URL -- */
//$payment_online_form_content .= '<input type="hidden"  name="return" value="http://';
//$payment_online_form_content .= $_SERVER['HTTP_HOST']; 
//$payment_online_form_content .= '/Store.php">';
//$payment_online_form_content .= '<input type="hidden"  name="notify_url" value="http://www.mywheelsproject.org/Store_paypal_notify_handler.php">';

/* -- Return URL -- */
$payment_online_form_content .= '<input type="hidden"  name="return" value="http://'.$_SERVER['SERVER_NAME'].'/Store.php">';
$payment_online_form_content .= '<input type="hidden"  name="notify_url" value="http://'.$_SERVER['SERVER_NAME'].'/Store_paypal_notify_handler.php">';


$payment_offline_form_content .= '<form action="';
$payment_offline_form_content .= $_SERVER['PHP_SELF'];
$payment_offline_form_content .= '" method="post" name="frmCheckout" id="frmCheckout">';
$payment_offline_form_content .= '<input name="step" type="hidden" value="4">';
$payment_offline_form_content .= '<input name="reset_session" type="hidden" value="1">';


if(isset($_SESSION['session_name'])){
        	$session_=$_SESSION['session_name'];	
        }else{
        	$session_=0;
        }




$payment_offline_form_content .= $customer_form_content;

if ("payment_online" == $local_optPayment) {
	$payment_form_content = $payment_online_form_content;
} else {
	$payment_form_content = $payment_offline_form_content;
}

/* -- Currency -- */
$payment_form_content .= '<input type="hidden" name="currency_code" value="EUR">';

$cart_ok = 1;

$payment_form_content_detail = '';

$_session =false;
$_customer_c=null;
$pri=new ProductInfo();

if(isset($_SESSION["session_name"])) {
	$_session=true;
	$_customer_c=new Customer($_SESSION["session_name"],null,null,null);
}

for ($i = 0; $i < $numItem; $i++) {
	extract($cartContent[$i]);

	$pri->setPdid($pd_id);

	$totalWeight += $pi_shipping_weight * $ct_qty;
	$table_content .= "<tr class='content' valign='middle'>";
	$table_content .= "<td align='left'><font size='2'>";

	$item_price = $pri->getPrice(ID_DEFAULT_CUSTOMER_TYPE);

	if($_session){
		$customerprice=$pri->getPrice($_customer_c->getType());
		if ($customerprice!='') {
			$item_price=$customerprice;
		}
	}
	$subTotal += $item_price * $ct_qty;

	if ((isSet($error_msg)) && ($pi_id < 0)) {
		$table_content .= "<font color='red'>";
	}

	$table_content .= "$ct_qty x $pd_name";

	$payment_form_content_detail .= '<input type="hidden" name="item_name_';
	$payment_form_content_detail .= $i+1;
	$payment_form_content_detail .= '" value="'; 
	$payment_form_content_detail .= $pd_name; 
	$payment_form_content_detail .= '">';
	$payment_form_content_detail .= '<input type="hidden" name="item_number_';
	$payment_form_content_detail .= $i+1;
	$payment_form_content_detail .= '" value="';
	$payment_form_content_detail .= $i+1;
	$payment_form_content_detail .= '">';
	$payment_form_content_detail .= '<input type="hidden" name="amount_';
	$payment_form_content_detail .= $i+1;
	$payment_form_content_detail .= '" value="';
	$payment_form_content_detail .= $item_price;
	$payment_form_content_detail .= '">';

	if ((isSet($error_msg)) && ($pi_id < 0)) {
		$table_content .= "</font>";
	}

	$table_content .= "</td><td align='center' ><font size='2'>";

	if ($pi_id >= 0) {
		$table_content .= getProductItemFlavor($pi_id);
		$table_content .= "<input name='i[]' type='hidden' value='$pi_id'>";

	} 
	else {
		$cart_ok = 0;
		if (isSet($error_msg)) {
			$table_content .= getCartProductItemList($cat_id,$pd_id,$lang,$i);
		} else {
			$table_content .= getCartProductItemList($cat_id,$pd_id,$lang,$i);
		}
	}
	$table_content .= "</font></td>";
	$table_content .= " <td align='right'><font size='2'>";
	$table_content .= displayAmount($item_price);
	$table_content .= "&nbsp;</font></td>";

        $table_content .= "<td align='right'><font size='2'>";
	$table_content .= displayAmount($ct_qty * $item_price); 
	$table_content .= "&nbsp;</font></td>";
        $table_content .= "</tr>";
}

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

	$orderId = saveOrder($_POST['same_invoice_address'],displayPaypalAmount($subTotal+$shippingCost),displayPaypalAmount($shippingCost),$shippingMode,$totalWeight,$lang,ORDER_STATUS_NEW,ORDER_PAYMENT_NEW);

	$payment_form_content .= '<input type="hidden" name="custom" value="';
        $payment_form_content .= $orderId;
        $payment_form_content .= "CUSTOM_DELIMITER";
        if(isset($_SESSION['session_name'])){
        	$session_=$_SESSION['session_name'];	
        }else{
        	$session_=0;
        }
        $payment_form_content .= $session_;
        $payment_form_content .= "CUSTOM_DELIMITER";
        $payment_form_content .= $lang;
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
		
		

		
		<input class="box" name="btnBack" type="submit" id="btnBack" value="<?php echo db_return_text($lang,'store','checkout_back'); ?>" style=" background:url(images/button_previous.png);background-size:120px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width: 120px; margin-top: 5px;" alt=<?php echo db_return_text($lang,'store','checkout_modify_shipping_info'); ?>></input>
		
		
		
		</form>
	</td>

	<td align="center" height="40"><font color="black" size="4"><?php db_get_text($lang, 'store', 'checkout_step2_title'); ?></font><font color="red" size="2"><?php if (isSet($error_msg)) echo $error_msg; ?></td>
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
                $payment_form_content .= '" style="background:url(images/button_confirm.png);background-size:150px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width:150px; margin-top: 5px;" alt="';
                
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
			if ("1"==$local_same_invoice_address) {
				db_get_text($lang, 'store', 'checkout_same_invoice_address');
			} else {
				db_get_text($lang, 'store', 'checkout_billing_address');
			} 
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
                          echo '" class="box" style=" background:url(images/button_update.png);background-size:150px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width: 150px; " >';
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
                if (1==$cart_ok) {
			$diff = $shippingCostExpress - $shippingCostStandard;
                        if (1==$expressShipping) {
                          echo '<input name="shipping_mode" type="hidden" value="standard">';
                          echo '<input name="METHOD" type="submit" id="btnConfirm" value="';
                          echo db_return_text($lang,'store','switch_shipping_mode_to_standard');
                          echo ': -'; echo $diff; echo ' Euro " class="box" style=" background:url(images/button_express_truck.png);background-size:300px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width: 300px; " >';
                          echo '&nbsp;&nbsp;</form>';
                        } else {
                          echo '<input name="shipping_mode" type="hidden" value="express">';
                          echo '<input name="METHOD" type="submit" id="btnConfirm" value="';
                          echo db_return_text($lang,'store','switch_shipping_mode_to_express');
                          echo ': +'; echo $diff; echo ' Euro " class="box" style=" background:url(images/button_express_plane.png);background-size:300px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width: 300px; ">';
                          echo '&nbsp;&nbsp;</form>';

                        }
		 } 
               ?>
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
            <td align="right"> <?php echo displayAmount($shippingCost); ?>&nbsp;</td>
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
 
 		switch ($_POST['optPayment']) {
		    case 'payment_online':
		        echo db_return_text($lang,'store','checkout_payment_method_online');
		        break;
		    case 'payment_offline':
		        echo db_return_text($lang,'store','checkout_payment_method_offline');
		        break;
		}
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

