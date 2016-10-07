<?php

	require_once 'php_includes/config.php';
	include './php_includes/language.php';
	require_once 'php_includes/category-functions.php';
	require_once 'php_includes/product-functions.php';
	require_once 'php_includes/cart-functions.php';
	require_once 'php_includes/checkout-functions.php';
        require_once 'php_includes/field_controle.php';
        require_once 'customer/library/customer.php';
        require_once 'customer/library/admin_customer.php';
        require_once 'customer/library/product_info.php';
	if (isset($_POST['reset_session'])&&isValidField($_POST['reset_session'])&& (int)$_POST['reset_session'] == 1) {
	        $cookieParams = session_get_cookie_params();
	        setcookie(session_name(), '', 0, $cookieParams['path'], $cookieParams['domain'], $cookieParams['secure'], $cookieParams['httponly']);
	}

	$thank_you = 0;
	$thank_you_online = 0;
	$thank_you_offline = 0;

?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	   <head>
	       <?php include './php_includes/head_store.php'; ?>

	   </head>

	   <?php
           
	   $_SESSION['shop_return_url'] = $_SERVER['REQUEST_URI'];
           
	   $catId = (isset($_GET['c'])&&isValidField($_GET['c'])&& $_GET['c'] != '1') ? $_GET['c'] : 0;
	   $pdId = (isset($_GET['p']) &&isValidField($_GET['p'])&&$_GET['p'] != '') ? $_GET['p'] : 0;

if (isset($_POST['step']) &&isValidField($_POST['step'])&& (int)$_POST['step'] > 0 && (int)$_POST['step'] <= 4) {

        $step = (int)$_POST['step'];
}
	   ?>


    <body style="background: #1F2147; " onload="onPageLoad();" onunload="onPageUnload();">

        <div id="body_content" style="background: #1F2147">
            
            <?php include './php_includes/main_menu.php'; ?>
	
	<?php
		$keys        = array_keys($_GET);
		$num	     = count($keys);
     		for ($i = 0; $i < $num; $i++) {

//             	 	if (!($_GET[$keys[$i]] == '')) {
//                       	 echo $keys[$i]; echo ':'; echo $_GET[$keys[$i]];
//                       	 echo '<br>';
//               		 }

			if ($keys[$i] == 'tx') {
	       	 		$thank_you=1;
				$thank_you_online=1;
				deleteCart();
				/*session_destroy();
	       			unset($_SESSION);*/
			}
       		}
		
	?>

            <!-- HOME MENU BANNER --> 
            <div id="Banner1" style="position: absolute; top: 10px; z-index: 0;">
               <!-- <img src="images/Banner_1_Page1.png" 
                     style="height: 58px; width: 1000px; margin-left: 12px; "  />
          
				-->
            <!-- STORE LOGO -->
            <img src="images/top-skates_grey.png" usemap="#map_home_logo"
                 style=" position: absolute;  width: 240px; margin-left: 2px; margin-top: 2px; z-index: 1;" />
            <map name="map_home_logo" id="map_home_logo"><area href="Home.php?lang=<?php print $lang; ?>" title="Home" alt="english" coords="0, 0, 240, 60" /></map>

  			</div> 
	           <!-- MAIN PANEL LEFT DIV	           

	           <div id="body_content" style=" width: 150px;  height: 122px; left:12px;  top: 74px; z-index: 1; position: absolute;">
	           	<img src="images/logo_eo_shop.png"style="height: 94px; width: 142px; margin-left: 0px; margin-top:10px; position: absolute;"/>


	           </div>
	           -->


	           <!-- BLOK DIV  Brand Overview -->
<?	           
// get all categories
$categories = fetchCategories();
?>


	           	
	           			<div id="storetopskate_hype_container" style="margin:auto;position:relative;width:998px;height:100px;overflow:hidden;left:3px;  top: 108px;" aria-live="polite">
		<script type="text/javascript" charset="utf-8" src="html5/store_top_skate/store_top_skate.hyperesources/storetopskate_hype_generated_script.js?48798"></script>
	
					
	           		
	           </div>
	           

<!-- ################ MAIN PANEL ##############################-->

	           <!-- PRODUCTS List

	           <div id="title_banner" style="left: 12px; height: 21px; z-index: 1; position: absolute; top: 110px; width: 998px; ">
	           <table>
			<tr>
				<td width="150"><a href="Store.php" style=" padding-left:10px; color:red;"><?php db_get_text($lang, 'store', 'leftnav_title'); ?></a>
				</td> 
				<td width="850">
					<marquee direction="left" scrolldelay="1" loop="infinite" scrollamount="3" style=" padding-left:10px; color:red;">
                    			<?php db_get_text($lang, 'home', 'shipping_feed_content'); ?></a>
				</td>
			</tr>
		   </table>
		   
	            </div>
	            
	         -->    
	            
	            <div id="product_menu" style=" left:12px; width: 150px; height: 450px; top: 220px; z-index: 1;position: absolute;">

	               <?php
	               require_once 'php_includes/leftNav.php';
	               ?>

	           </div>


	           <!-- PRODUCT DETAILS  -->
	           <div id="body_content" style="border: 2px solid; border-radius: 10px; overflow:auto;left:167px; width: 843px;  height: 700px; top: 220px; z-index: 1;position: absolute; ">


<?php 

if (isset($_POST['action'])) { 
	switch ($_POST['action']) {
        case 'add' :
                addToCart($lang);
                break;
        case 'update' :
                updateCart();
                break;
        case 'delete' :
                deleteFromCart();
                break;
        case 'view' :
	}
}
if(isset($_GET['my_account'])){
      require_once 'account.php';
   }
else if (isset($_POST['action']) && ($_POST['action'] == 'add')) {
                require_once 'php_includes/categoryList.php';

} else if (isset($_GET['order_transaction_number'])) {
	require_once 'php_includes/orderDisplay_inframe.php';

} else if (isset($_GET['login']) &&isValidField($_GET['login'])&& (int)$_GET['login'] >= 0 && (int)$_GET['login'] <= 1) {
        $login = (int)$_GET['login'];
	$pageTitle   = 'Customer Login';
	$errorMessage = '';
	$errorCode = '';
	require_once 'php_includes/login_inframe.php';

} else if (isCartEmpty()) {

        // the shopping cart is still empty and nobody wants to log in 
        // so let's display the PRODUCT DETAILS

                       if ($pdId) {
                                   require_once 'php_includes/productDetail.php';
                       } else if ($catId) {
                           require_once 'php_includes/productList.php';
                       } else {
                           require_once 'php_includes/categoryList.php';
                       }



} else if (isset($_POST['step']) && isValidField($_POST['step'])&&(int)$_POST['step'] >= 0 && (int)$_POST['step'] <= 4) {
        $step = (int)$_POST['step'];

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


        if ($step == 1) {

		$errorMessage = '';
		$errorCode = 0;	
                 require_once 'php_includes/shippingAndPaymentInfo_inframe.php';

                $pageTitle   = 'Checkout - Step 1 of 2';

        } else if ($step == 2) {

		$requiredField = array('first_name', 'last_name', 'address1', 'city', 'zip', 'country', 'buyer_email');
//$requiredField = array('txtShippingFirstName', 'txtShippingLastName', 'txtShippingAddress1', 'txtShippingPhone', 'txtShippingState',  'txtShippingCity', 'txtShippingPostalCode',
//                       'txtPaymentFirstName', 'txtPaymentLastName', 'txtPaymentAddress1', 'txtPaymentPhone', 'txtPaymentState', 'txtPaymentCity', 'txtPaymentPostalCode');

		if (!checkRequiredPost($requiredField)) {
			$step = 1;
		        $errorCode = -1;
		        $errorMessage = db_return_text($lang,'store','error_incomplete_input');
			require_once 'php_includes/shippingAndPaymentInfo_inframe.php';	
			$pageTitle   = 'Checkout - Step 1 of 2';
		} else { 
			if (!checkEmailAddress($_POST['buyer_email'])) {
				$step = 1;
		        	$errorCode = -2;
                        	$errorMessage = db_return_text($lang,'store','error_invalid_email');
                        	require_once 'php_includes/shippingAndPaymentInfo_inframe.php';
                        	$pageTitle   = 'Checkout - Step 1 of 2';	
			} else { 
                		require_once 'php_includes/checkoutConfirmation_inframe.php';
                		$pageTitle   = 'Checkout - Step 2 of 2';
			}
		}
        } else if ($step == 3) {

//                 require_once 'php_includes/checkoutSucceeded_inframe.php';
//                 deleteCart();

		$cartContent = getCartContent($lang);

		$cartEntry_productItemId = $_POST['i'];

		$numEntries = count($cartEntry_productItemId);
		
		for ($i = 0; $i < $numEntries; $i++) {
			extract($cartContent[$i]);
			$newProductItemId = (int)$cartEntry_productItemId[$i];
			if ($newProductItemId < 0 ) {
				// get back to previous step, as their is still at least one unspecified product flavor!
                       		$step = 2;
				$error_msg = ' - '.db_return_text($lang,'store','error_choose_flavor');	
				require_once 'php_includes/checkoutConfirmation_inframe.php';
                        	$pageTitle   = 'Checkout - Step 2 of 2';
                        	
                        	
			} else {
				// update product quantity
				$sql = "UPDATE tbl_cart
                                        SET pi_id = $newProductItemId
                                        WHERE ct_id = $ct_id";

				dbQuery($sql);
				//echo "Cart Updated Successfully";
                 		//$pageTitle   = 'Checkout succeeded - Thank You !';
     			}
		}
		if (!isSet($error_msg) || ($error_msg == '')) {
			require_once 'php_includes/checkoutConfirmation_inframe.php';
		}
        } else if ($step == 4) {
		//$thank_you = 1;
		//$thank_you_offline = 1;
		/*session_destroy();
        	unset($_SESSION);*/
		require_once 'php_includes/orderConfirmation_inframe.php';
	}



} else {

// something went wrong...
// so let's display the PRODUCT DETAILS

                       if ($pdId) {
                           require_once 'php_includes/productDetail.php';
                       } else if ($catId) {
                           require_once 'php_includes/productList.php';
                       } else {
                           require_once 'php_includes/categoryList.php';
                       }

}
?>
	           </div>
	           
	           
	           <!--BASKET-->
			
<!--
	           <div id="title_banner" style="left: 112px; height: 27px; z-index: 1; position: absolute; top: 860px; width: 998px; padding-top: 0px; ">
<table border="0" height="15" width="100%" cellspacing="0" cellpadding="5" >
<tr valign="middle">
  <td width="160" align="center"> <a style=" padding-left:10px; font-size:14px; color:white;"><?php db_get_text($lang, 'store', 'cart_title'); ?></a></td>
  <td width="260" align="center"> <a style="color:white;"> <?php echo db_return_text($lang,'store','designation'); ?></a></td>
  <td width="100" align="center"> <a style="color:white;"> <?php echo db_return_text($lang,'store','model'); ?></a></td>
  <td width="65" align="right"> <a style=" color:white;"> <?php echo db_return_text($lang,'store','price'); ?></a></td>
  <td width="60" align="center"> <a style="color:white;"> <?php echo db_return_text($lang,'store','cart_quantity'); ?></a></td>
  <td width="70" align="right"> <a style="color:white;"> <?php echo db_return_text($lang,'store','cart_amount'); ?></a></td>
  <td width="10" align="right"> <a style="color:white;"></a></td>
</tr>
</table>

	           </div>

	           <div id="body_content" style=" border: 2px solid; border-radius: 10px;left:12px; width: 998px; height: auto; top: 890px; z-index: 1;position: absolute; ">

	   

	           </div>
	       
	           
	           <!-- CART SUMMARY -->

		<!-- 
		  <div id="title_banner" style="left: 12px; height: 22px; z-index: 1; position: absolute; top: 620px; width: 150px; padding-top: 0px;  ">
<table border="0" height="15" width="100%" cellspacing="0" cellpadding="5" >
<tr valign="middle">
 <td> <a  style="padding-left:10px; color:white; font-size:14px; "> <?php db_get_text($lang, 'store', 'cart_summary'); ?> </a>
      	<img src="images/cart_logo.png"style=" width: 20px; position: absolute; margin-top: 2px; margin-left: 10px;"/> 
 </td>
</tr>
</table>

	           </div>

-->    
			
	           <div id="body_content" style="border: 2px solid; border-radius: 10px;  left:12px; width: 150px; height: 190px; top: 731px; z-index: 1;position: absolute; ">

	           
				 <?php require_once 'php_includes/cartSummary.php'; 
				 $_SESSION['Payment_Amount'] = $subTotal; ?>				
	           </div>
	           
	           <div class="copyright" style="color:#666666; width: 152px; z-index: 1; position: absolute; left: 12px; top: 830px; height: 50px; ">
	           
			<img src="images/payment_logo_new.png" style=" align:center; width: 130px; margin-top: 12px; ">
                      <br>  <a style="margin-top: 2px"><?php db_get_text($lang,'store','secure_payment'); ?></a>

	           </div>
	           

	           	

  <!-- COPYRIGHT -->
	           <div id="copyright" style="height:30px; left:100px; position: absolute; top:950px; width: 1000px; z-index: 1; " class="copyright">
	               <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
	           </div>
	      
			<!-- FACEBOOK -->
<div style="right: 100px; top: 950px; position: absolute; opacity: 1.00; height: 25px; width: 25px; z-index: 1;">
	<a target="_blank" href="http://www.facebook.com/topskates">
	<!--<img src="images/facebook_logo.png" style="height: 25px; width: 25px;" />-->
	<img src="images/facebook_logo_long.png" style="height: 32px; width: 90px;" />
	</a>

</div>
	</div>
		
	   </body>
	  
	          

	</html>

