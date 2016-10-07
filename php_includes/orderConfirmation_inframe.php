<head>
        <?php include './php_includes/head.php'; ?>
        <?php include './php_includes/print.php'; ?>
        <?php require_once 'php_includes/field_controle.php';?>
</head>



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

//$cartContent = getCartContent($lang);

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
if (!(isSet($_POST['custom'])) && (isSet($_POST['h_custom']))) { $_POST['custom']=$_POST['h_custom']; }
if (!(isSet($_POST['shipping_cost'])) && (isSet($_POST['h_shipping_cost']))) { $_POST['shipping_cost']=$_POST['h_shipping_cost']; }
if (!(isSet($_POST['shipping_mode'])) && (isSet($_POST['h_shipping_mode']))) { $_POST['shipping_mode']=$_POST['h_shipping_mode']; }

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
$local_billing_zip = $_POST['billing_zip'];
$local_billing_country = $_POST['billing_country'];
$local_billing_email = $_POST['billing_email'];
$local_optPayment = $_POST['optPayment'];
$local_custom = $_POST['custom'];
$local_shipping_cost = $_POST['shipping_cost'];
$local_shipping_mode = $_POST['shipping_mode'];

if (isSet($_POST['shipping_mode']) && ('express' == $_POST['shipping_mode'])) {
        $expressShipping = 1;
} else {
        $expressShipping = 0;
}

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


//$numItem  = count($cartContent);
$numItem  = 0;
$subTotal = 0;
$totalWeight = 0;


$orderDetails = getOrderDetails($local_custom, $lang);

extract($orderDetails[0]);

//$subTotal = $ta_price * $ct_qty;
//$totalWeight += $pi_shipping_weight * $ct_qty;


$payment_form_content = '';
$payment_online_form_content = '';

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
	$payment_online_form_content .= '<input type="hidden" name="business" value="'.PAYPAL_BUSINESS_IDENTIFIER.'">';
//	$payment_online_form_content .= '<input type="hidden" name="business" value="JSP6KH63XPALY">'; // Production
//	$payment_online_form_content .= '<input type="hidden" name="business" value="SDN7WHBXADW2L">'; // Sandbox 
//	$payment_online_form_content .= '<input type="hidden" name="business" value="booboo_1361882178_biz@eoskates.com">'; // old test


/* -- Return URL -- */

if(isset($_SESSION['session_name'])){
      
      $s=$_SESSION['session_name'];

}


/* -- Return URL -- */
$payment_online_form_content .= '<input type="hidden"  name="return" value="http://'.$_SERVER['SERVER_NAME'].'/Store.php">';
$payment_online_form_content .= '<input type="hidden"  name="notify_url" value="http://'.$_SERVER['SERVER_NAME'].'/Store_paypal_notify_handler.php">';

//$payment_online_form_content .= '<input type="hidden"  name="return" value="http://www.mywheelsproject.com/Store.php">';
//$payment_online_form_content .= '<input type="hidden"  name="notify_url" value="http://www.mywheelsproject.com/Store_paypal_notify_handler.php">';

$payment_form_content = $payment_online_form_content;

/* -- Currency -- */

$payment_form_content .= '<input type="hidden" name="currency_code" value="EUR">';

//$payment_form_content .= '<input type="hidden" name="currency_code" value="DOLLAR">';

	/* -- Standard Paypal           -- */
//	$payment_form_content .= $payment_form_content_detail;

	/* -- Paypal Integral Evolution -- */
	$payment_form_content .= '<input type="hidden" name="subtotal" value="';
	$payment_form_content .= $od_amount_total;
	$payment_form_content .= '">';

//	$payment_form_content .= '<input type="hidden" name="shipping" value="';
//	$payment_form_content .= $od_shipping_cost;
//	$payment_form_content .= '">';

 	if (0 == useUpAllVouchers($local_custom)) {
 		updateOrder($local_custom,ORDER_STATUS_CONFIRMED,PAYMENT_STATUS_PENDING);
 		deleteCart();
 	} else {
 		echo db_return_text($lang, 'store', 'error_msg_voucher_not_virgin');
 	} 

//	session_destroy();	
//      $cookieParams = session_get_cookie_params();
//      setcookie(session_name(), '', 0, $cookieParams['path'], $cookieParams['domain'], $cookieParams['secure'], $cookieParams['httponly']);
//      unset($_SESSION);
        

	$payment_form_content .= '<input type="hidden" name="custom" value="';
        $payment_form_content .= $local_custom;
        $payment_form_content .= '">';

?>

<table width="842" border="0" cellpadding="10" cellspacing="0">
    <tr> 
	<td align="left">
      		<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="POST" name="frmCheckout" id="frmCheckout">
          	<?php
		echo $customer_form_content;
		?>
<!--		<input name="step" type="hidden" value="1"> -->
		<input name="btnBack" type="submit" id="btnBack" onClick="printSpecial()" value=" <?php echo db_return_text($lang,'store','checkout_print_order_confirmation'); ?>" class="box" id="btnBack" value="<?php echo db_return_text($lang,'store','checkout_back'); ?>" style=" background:url(images/button_print.png);background-size:250px 20px; background-repeat:no-repeat; background-position:center; color:#dddddd; font-size:11px; border:0; align:center; width: 250px; margin-top: 5px;" alt=<?php echo db_return_text($lang,'store','checkout_print_order_confirmation'); ?>> 
<!--		<a href="javascript:void(printSpecial())">Print this Page</a> -->
		</form>
	</td>

	<td align="center" height="40"><font color="black" size="4"><?php db_get_text($lang, 'store', 'checkout_step3_title'); ?></font><font color="red" size="2"><?php if (isSet($error_msg)) echo $error_msg; ?></td>
        <td align="center">

	</td>
    </tr>
</table>

<div id="printReadyHidden" style="display: none"> 
<table border="1" width="810" bordercolor="#aaaaaa" align="left" cellpadding="15" cellspacing="0" >
<tr><td colspan="4" align="center"><H2>getShopConfig()['name']</H2><H3>- <?php db_get_text($lang, 'store', 'checkout_order_summary'); ?> -</H3></td></tr>
<tr><th><?php db_get_text($lang, 'store', 'designation'); ?></th><th><?php db_get_text($lang, 'store', 'price'); ?></th><th><?php db_get_text($lang, 'store', 'cart_quantity'); ?></th><th><?php db_get_text($lang, 'store', 'cart_amount'); ?></th>
<?php

$_session =false;
$_customer_c=null;
$pri=new ProductInfo();
if(isset($_SESSION["session_name"])) {$_session=true;

$_customer_c=new Customer($_SESSION["session_name"],null,null,null);

}
	$numItem  = count($orderDetails);

	for ($i = 0; $i < $numItem; $i++) {
        	extract($orderDetails[$i]);
                
                // print_r($oi_pd_reference);
                  $sql = "SELECT pd_id FROM tbl_product WHERE pd_reference='".$oi_pd_reference."'"; 
                  $rang=mysql_fetch_array(dbQuery_($sql));
                 // $rang=dbquery($sql);
                  $pd_id=$rang['pd_id'];
                  
                  $pri->setPdid($pd_id);

                 $customerprice=$pri->getPrice($_customer_c->getType());
		echo "<tr>";
		echo "<td>";
		echo $pd_name;
		echo "</td>";
		echo "<td align='right'>";
                if($_session&&$customerprice>0){echo displayAmount($customerprice);}else{
		echo displayAmount($oi_price);}
		echo "</td>";
		echo "<td align='center'>";
		echo $oi_qty;
		echo "</td>";
		echo "<td align='right'>";
                 if($_session&&$customerprice>0){echo displayAmount($customerprice*$oi_qty);}else{
		echo displayAmount($oi_amount);}
		echo "</td>";
		echo "</tr>";
	}

if ($local_shipping_cost > 0) {
                echo "<tr>";
                echo "<td>";
                if (1==$expressShipping) { 
			echo db_return_text($lang,'store','shipping_express');
		} else {
			echo db_return_text($lang,'store','shipping');
		}	
                echo "</td>";
                echo "<td align='right'>";
                echo displayAmount($local_shipping_cost);
                echo "</td>";
                echo "<td align='center'>";
                echo "1";
                echo "</td>";
                echo "<td align='right'>";
                echo displayAmount($local_shipping_cost);
                echo "</td>";
                echo "</tr>";
}
?>

</table>
<br>
</div>

<div id="printReady"> 

<table border="0" width="800" >
 <tr>
  <td valign="top">
    <table width="200" border="0" align="right" cellpadding="0" cellspacing="1" class="infoTable">
        <tr class="infoTableHeader">
            <td colspan="2"><font color="black" size="2"><?php db_get_text($lang, 'store', 'checkout_shipping_address'); ?> <br> </font> 
	    </td>
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
		$local_address1 = $_POST['address1']; echo $local_address1; 
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

        <tr >
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

    </table>

  <td valign="top">
    <table width="600" border="1" bordercolor="#aaaaaa" align="left" cellpadding="15" cellspacing="0" >
        <tr class="label">
            <td align="center" width="100"><font color="black" size="2"><?php echo db_return_text($lang,'store','order_total'); ?><br></font></td>
            <td align="center" width="200"><font color="black" size="2"><?php echo displayAmount($od_amount_total); ?><br></font></td>
        </tr>

	<tr>
            <td align="right"><?php echo db_return_text($lang,'store','order_bank_information'); ?></td>
            <td align="left"><?php echo $shopConfig['bank_account_intl_html']; ?></td>
        </tr>

        <tr class="content">
            <td align="right"><?php echo db_return_text($lang,'store','order_payment_address'); ?> </td>
            <td align="left"><?php echo $shopConfig['address_html']; ?></td>
        </tr>

        <tr class="content">
            <td align="right"><?php echo db_return_text($lang,'store','checkout_order_reference'); ?> </td>
            <td align="left"><strong><?php echo $od_reference; ?></strong></td>
        </tr>

        </tr>

    </table>
   </td>
 </tr>
</table>  

</div>

<?php
// send notification email to shop admin
if ($shopConfig['sendOrderEmail'] == 'y') {
        $subject = "[New Order] ";
        $subject .= $od_reference;
        $email   = $shopConfig['email'];
        $message = "You have a new order. Check the order detail here \n http://" . $_SERVER['HTTP_HOST'] . WEB_ROOT . '/admin/order/index.php?view=detail&od_reference=';
        $message .= $od_reference;
        mail($email, $subject, $message, "From: ".getShopConfig()['email']."\r\nReturn-path: ".getShopConfig()['email']);
}

// send notification email to customer
if ($shopConfig['sendOrderEmail'] == 'y') {
      //  include "/customer/library/mail_theme.php";
        
        
        $title=db_return_text($lang, 'all', 'activation_title');

        $hello=db_return_text($lang, 'all', 'hello_item');
	$hello= $hello.' '.$local_first_name;

        $message=db_return_text($lang,'store','order_email_message');

        $message_2='';

        $link='';

         $button=db_return_text($lang,'store','order_email_thanks');
        
        
        
        $subject = db_return_text($lang,'store','order_email_subject');
        $email_sender   = $shopConfig['email'];
        $email   = $local_buyer_email;
        $message = db_return_text($lang,'store','order_email_greetings');
        $message .= " " .$local_first_name . " " .$local_last_name;
        $message .= "\n\n".db_return_text($lang,'store','order_email_thanks');
        $message .= "\n".db_return_text($lang,'store','order_email_message');
//        $message .= "\n You can retrieve all details of it on http://" . $_SERVER['HTTP_HOST'] . WEB_ROOT . '/admin/order/index.php?view=detail&oid=';
//        $message .= $od_reference;
        $message .= "\n\n".db_return_text($lang,'store','order_email_regards');
        
        //$message_html
        mail($email, $subject, $message, "From: $email_sender\r\nReturn-path: $email_sender");
 }



?>

<table width="842" border="0" cellpadding="10" cellspacing="0">
    <tr>
        <td align="left">
                <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="POST" name="frmCheckout" id="frmCheckout">
          	<?php
		echo $customer_form_content;
                ?>
<!--            <input name="step" type="hidden" value="1"> -->
                <input name="btnBack" type="submit" id="btnBack" class="box" value="<?php echo db_return_text($lang,'store','checkout_return_to_shop'); ?>" style="background:url(images/button_previous_xl.png);background-size:180px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width: 200px; margin-top: 5px;" alt="<?php echo db_return_text($lang,'store','checkout_return_to_shop'); ?>">
                </form>
        </td>

        <td align="right" height="40"><font color="black" size="2">
	<?php 
		echo "<H4>"; 
		db_get_text($lang, 'store', 'checkout_order_reference'); 
		echo " : "; 
		echo $od_reference; 
		echo "</H4>";
	?>
	</td><td>
	<?php
		db_get_text($lang, 'store', 'checkout_choose_online_payment'); 
	?>
	</font><font color="red" size="2"><?php if (isSet($error_msg)) echo $error_msg; ?></td>
        <td align="center">
<?php
        $payment_form_content .= '<input name="METHOD" type="submit" id="btnConfirm" value="';
        $payment_form_content .= db_return_text($lang, 'store', 'checkout_pay_online');
	$payment_form_content .= '" style="background:url(images/button_confirm.png);background-size:150px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width:150px; margin-top: 5px;" alt="';
                
        $payment_form_content .= db_return_text($lang,'store','checkout_pay_online');
               
        $payment_form_content .= '&nbsp;" class="box"></form>';

        echo $payment_form_content;
?>
        <?php $session= $_SESSION["session_name"] ;?>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script>f();
      function f(){
         $(function (){
                 var session = <?php echo $session; ?>;
                 //alert(session);
                 $.post( "php_includes/save_session.php", { session : session } )
			                           .done(function( data ) {
			                              //alert(data);
			                           
			                           });
			    }
			                           
          );
                 
          }
      </script>
      </td>
    </tr>
</table>



