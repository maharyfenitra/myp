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
if (isset($_GET['step'])) {

        $step = (int)$_GET['step'];
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
            <map name="map_home_logo" id="map_home_logo"><area href="Store.php?lang=<?php print $lang; ?>" title="Home" alt="english" coords="0, 0, 240, 60" /></map>

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
	            
	            
	            <div id="product_menu" style=" left:12px; width: 150px; height: 450px; top: 220px; z-index: 1;position: absolute;">

	               <?php
	               require_once 'php_includes/leftNav.php';
	               ?>

	           </div>


	           <!-- PRODUCT DETAILS  -->
	           <div id="body_content" class="cool_stuff"  style="border: 2px solid; border-radius: 10px; overflow:auto;left:167px; width: 843px;  height: 800px; top: 220px; z-index: 1;position: absolute; ">                 <div width="100%" align="center"><h3><?php echo db_return_text($lang,'store','model'); ?></h3></div>
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
	           
	          	
	           <div id="body_content" style="border: 2px solid; border-radius: 10px;  left:312px; width: 450px; height: 95px; top: 7px; z-index: 1;position: absolute; " align="center">

	           
				 <?php require_once 'php_includes/cartSummary.php'; 
				 $_SESSION['Payment_Amount'] = $subTotal; ?>				
	           </div>
	           
	           <div class="copyright" style="color:#666666; width: 152px; z-index: 1; position: absolute; left: 312px; top: 7px; height: 50px; ">
	           
			<img src="images/payment_logo_new.png" style=" align:center; width: 130px; margin-top: 12px; ">
                      <br>  <a style="margin-top: 2px"><?php db_get_text($lang,'store','secure_payment'); ?></a>

	           </div>
	           
	            <div class="copyright" style="color:#666666; width: 152px; z-index: 1; position: absolute; left: 600px; top: 7px; height: 100px; ">
	           
			<a href="panier.php"><img src="gallery_icons/panier.png" width="100" height="100"/></a>

	           </div>
	           <div class="copyright" style="color:#666666; width: 152px; z-index: 1; position: absolute; left: 12px; top: 730px; height: 50px; ">
	           
			<ul>
			   <li><h1><a title="" href="Contact.php"><?php db_get_text($lang, 'all', 'main_menu_contact');?></a><br/><br/><br/></h1></li>
			   <?php if(isset($_SESSION['session_name'])){?>
			    <li><h1><a title="" href="Account.php"><?php db_get_text($lang, 'all', 'customer_account');?></a><br/><br/><br/></h1></li>
			    <?php }?>
			    <li><h1><a title="" href="Store.php"><?php db_get_text($lang, 'all', 'main_menu_store'); ?></a><br/><br/><br/></h1></li>
			<ul>

	           </div>

	</div>
		
	   </body>
	  
	          

	</html>

