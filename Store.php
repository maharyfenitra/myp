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
        
        
         /*echo "<br>"; echo "<br>"; echo "<br>"; echo "<br>"; echo "<br>"; echo "<br>";
        print_r($_POST);
        
        echo "<br>"; echo "<br>"; echo "<br>"; echo "<br>"; echo "<br>"; echo "<br>";*/
        
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



          <!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
<script type="text/javascript">
    window.cookieconsent_options = {"message":"<?php echo db_get_text($lang, 'all', 'cookie_warning_msg_item');?>","dismiss":"<?php echo db_get_text($lang, 'all', 'cookie_warning_got_it_item');?>","learnMore":"More info","link":"","theme":"light-top"};
</script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
<!-- End Cookie Consent plugin -->

	   <head>
	       <?php include './php_includes/head_store.php'; ?>
	       
               <?php include './php_includes/global_header.php'; ?>
	   </head>

	   <?php
           
	   $_SESSION['shop_return_url'] = $_SERVER['REQUEST_URI'];
           
	   $catId = (isset($_GET['c'])&&isValidField($_GET['c'])&& $_GET['c'] != '1') ? $_GET['c'] : 0;
	   $pdId = (isset($_GET['p']) &&isValidField($_GET['p'])&&$_GET['p'] != '') ? $_GET['p'] : 0;

if (isset($_POST['step']) &&isValidField($_POST['step'])&& (int)$_POST['step'] >= 0 && (int)$_POST['step'] <= 4) {

        $step = (int)$_POST['step'];
}
if (isset($_GET['step'])) {

        $step = (int)$_GET['step'];
}
//style="background:url(images/background_contin_wide.jpg)no-repeat  top center;background-size:2000px; "

	   ?>

<body  onload="onPageLoad();" onunload="onPageUnload();"
	<?php 
		if($session_script){ ?>
	 		onclick="f()"
	<?php
		}
	?>
    
    >
    
    <?php 
    
         if($session_script){ ?>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
           <script type="text/javascript">
             window.onload=f;
             function f(){
         $(function (){
                 var session = <?php echo $session; ?>;
                 //alert(session);
                 $.post( "php_includes/save_session.php", { session : session } )
			                           .done(function( data ) {
			                            //  alert(data);
			                           
			                           });
			    }
			                           
          );
                 
          }
    
          </script>
         
	<?php
         }
	?>
    

        <div id="body_content" style=" border: 2px solid; border-radius: 10px;background:#1F2147;height:1600px;">
            
            <?php include './php_includes/main_menu.php'; ?>
	
	<?php
		$keys        = array_keys($_GET);
		$num	     = count($keys);
     		for ($i = 0; $i < $num; $i++) {

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
	<div id="Banner1" style="position: absolute; top: 12px; z-index: 0;">
 	           <!-- STORE LOGO -->
	            <img src="images/top-skates_grey.png" usemap="#map_home_logo"
       		          style=" position: absolute;  left: 20px; width: 265px; margin-left: 2px; margin-top: 2px; z-index: 1;" />
       		    <map name="map_home_logo" id="map_home_logo"><area href="Store.php?lang=<?php print $lang; ?>" title="Home" alt="english" coords="0, 0, 240, 60" /></map>

	</div> 


	<!-- BLOCK DIV  Brand Overview -->
	<div id="Brands" style="position: absolute; left: 15px; top: 2px; z-index: 0;">
           	<?php include "php_includes/top_skate_brand.php"; ?>
	</div>
<?	           
// get all categories
$categories = fetchCategories();
?>


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
	            
	            <div id="product_menu" style=" left:10px; width: 150px; height: 450px; top: 210px; z-index: 1;position: absolute;">

	               <?php
	               require_once 'php_includes/leftNav.php';
	               ?>

	           </div>


	           <!-- PRODUCT DETAILS  -->
	           <div id="body_content" class="cool_stuff"  style="border: 2px solid; border-radius: 10px; left:167px; width: 843px; min-height:800px; height:auto; top: 220px; z-index: 1;position: absolute; ">


<?php 

if (isset($_POST['custom'])) {
                echo 'custom: '; 
		echo $_POST['custom'];
}


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



} else if ((isset($_POST['step']) && isValidField($_POST['step'])&&(int)$_POST['step'] >= 0 && (int)$_POST['step'] <= 4)
||(isset($_GET['step']) && isValidField($_GET['step'])&&(int)$_GET['step'] >= 0 && (int)$_GET['step'] <= 4)) 
       {
           if(isset($_POST['step']))
                  $step = (int)$_POST['step'];
                          if(isset($_GET['step'])){
                                        $step=$_GET['step'];
        }

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


        if ($step == 0) { // display cart content

                $errorMessage = '';
                $errorCode = 0;
                $numItem=1;
?>
                   <!-- PRODUCT DETAILS  -->
                   <div id="body_content" class="cool_stuff"  style="border: 0px solid; border-radius: 10px; overflow:auto;left:0px; width: 843px;  height: 800px; top: 0px; z-index: 1;position: absolute; ">
	           <div width="100%" >
	           
	          <table width="100%">
	          <tr><td align="center" style="color:#5e5e5e; font-size:18px;font-weight: bold;"><?php echo db_return_text($lang,'all','main_menu_view_cart'); ?></td></tr>
	          </table>
			
		</div>
                   <div id="title_banner" style=" height: 27px; z-index: 1;  width: 843px; padding-top: 0px; ">
                   <table border="0" height="15" width="100%" cellspacing="0" cellpadding="5" >
                               <tr valign="middle" style="background-color:#EFEDED">
                           <td width="160" align="center"> <a style=" padding-left:10px; font-size:14px; color:black;"><?php db_get_text($lang, 'all', 'panier_title_item'); ?></a></td>
                               <td width="260" align="center"> <a style="color:black;"> <?php echo db_return_text($lang,'store','designation'); ?></a></td>
  <td width="100" align="center"> <a style="color:black;"> <?php echo db_return_text($lang,'store','model'); ?></a></td>
  <td width="65" align="right"> <a style=" color:black;"> <?php echo db_return_text($lang,'store','price'); ?></a></td>
  <td width="60" align="center"> <a style="color:black;"> <?php echo db_return_text($lang,'store','cart_quantity'); ?></a></td>
  <td width="70" align="right"> <a style="color:black;"> <?php echo db_return_text($lang,'store','cart_amount'); ?></a></td>
  <td width="10" align="right"> <a style="color:black;"></a></td>
</tr>
</table></div>

                       <?php
                       require_once 'php_includes/miniCart.php';
                       ?>

                   </div>
<?php
        $pageTitle   = 'Checkout - Step 0 of 2';

	}
        if ($step == 1) {  // ask for shipping and invoicing information

		$errorMessage = '';
		$errorCode = 0;	
                 require_once 'php_includes/shippingAndPaymentInfo_inframe.php';

                $pageTitle   = 'Checkout - Step 1 of 2';

        } else if ($step == 2) {  // display checkout confirmation 
             

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
        } else if ($step == 3) { // update missing flavors and re-display checkout confirmation for online payment

//              require_once 'php_includes/checkoutSucceeded_inframe.php';
//              deleteCart();

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
        } else if ($step == 4) { // display order confirmation for offline payment
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

	           <?php include "php_includes/top_menu.php";?>
	           
	           <?php include "php_includes/nav_left_bottom.php";?>

  <!-- COPYRIGHT 
	           <div id="copyright" style="height:30px; left:100px; position: absolute; top:950px; width: 1000px; z-index: 1; " class="copyright">
	               <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
	           </div>-->
	      
			<!-- FACEBOOK 
<div style="right: 100px; top: 950px; position: absolute; opacity: 1.00; height: 25px; width: 25px; z-index: 1;">
	<a target="_blank" href="http://www.facebook.com/topskates">
	<img src="images/facebook_logo.png" style="height: 25px; width: 25px;" />
	<img src="images/facebook_logo_long.png" style="height: 32px; width: 90px;" />
	</a>

</div>-->
	</div>
		
	   </body>
	  
	          

	</html>

