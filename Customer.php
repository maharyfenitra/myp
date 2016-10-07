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
        include './customer/library/checker.php';
        include './customer/library/mail_recover_password.php';
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
	       
		<?php include './php_includes/head.php'; ?>
               <?php include './php_includes/global_header.php'; ?>
               		<link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css"/>

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


<body  onload="onPageLoad();" onunload="onPageUnload();">
    
<div id="body_content" style=" border: 2px solid; border-radius: 10px;background:#1F2147;height:1600px;">
		<script src="jquery-ui/jquery-ui.js"></script>


		<?php include './php_includes/main_menu.php'; ?>

		<!-- HOME MENU BANNER -->
		
	<div id="Banner1" style="position: absolute; top: 10px; z-index: 0;">
			    
		<!-- STORE LOGO -->
		<img src="images/top-skates_grey.png" usemap="#map_home_logo" style=" position: absolute;  width: 240px; margin-left: 2px; margin-top: 2px; z-index: 1;" />
		<map name="map_home_logo" id="map_home_logo"><area href="Store.php?lang=<?php print $lang; ?>" title="Home" alt="english" coords="0, 0, 240, 60" /></map>

	</div>  

	<div id="body_content" style="background: #1F2147">
            
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
		<div id="Banner1" style="position: absolute; top: 10px; z-index: 0;">
		<!-- <img src="images/Banner_1_Page1.png" style="height: 58px; width: 1000px; margin-left: 12px; "  /> -->

	<!-- STORE LOGO -->
		<img src="images/top-skates_grey.png" usemap="#map_home_logo"
		style=" position: absolute; left: 20px; width: 265px; margin-left: 2px; margin-top: 2px; z-index: 1;" />
                 
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
	           

<!-- ################ MAIN PANEL ##############################-->

	<div id="product_menu" style=" left:12px; width: 150px; height: 450px; top: 220px; z-index: 1;position: absolute;">

	<?php require_once 'php_includes/leftNav.php'; ?>

	</div>


	<!-- CUSTOMER LOGIN and DETAILS  -->
	<div id="body_content" class="cool_stuff"  style="border: 2px solid; border-radius: 10px; left:167px; width: 843px;  height: 800px; top: 220px; z-index: 1;position: absolute; ">

	<div style="margin-left: 80px; margin-right: -100px;  "  >
				
		<div id="body_content" style="width: 600px; height: 780px;  position: absolute; top: 50px; z-index: 1;">

			<table border=0 width=100% cellpadding="10">
			<tr>
			<table>
			    <form method="POST" action="/customer/includes/signin.php">
			          <tr><td colspan=2><h2><?php echo db_get_text($lang, 'all', 'customer_sign_in'); ?></h2></td></tr>
			          <tr>
			                <td><?php db_get_text($lang, 'all', 'customer_pseudo_or_email'); ?> :</td>
			                <td><input type="text" name="compte" value="<?php if(isset($_GET['default_mail'])) {$mail=$_GET['default_mail'];}else $mail=''; echo $mail; ?>"/></td>
			   
			           </tr>
			           
			           <tr>
					<td><?php db_get_text($lang, 'all', 'customer_password'); ?>:</td>
					<td><input type="password" name="password" /></td>
				   </tr>
			
			           <tr>
			                <td></td>
			                <td><input type="submit" value="<?php db_get_text($lang, 'all', 'go_button'); ?>" /></td>
			           </tr>
			           <?php 
			                 if(!isset($_GET['id_err'])){ ?>
			           <tr>
			                <td></td>
					<td><a href='Recover.php?forget_password=1' style='text-decoration: underline;'><?php db_get_text($lang, 'all', 'customer_i_forget_my_password'); ?></a>
					</td>
			            </tr>
			            <?php 
			            	} else {  
			                      //CHECK IF AN ERROR WAS SEND
			                      if($_GET['id_err']==2){ ?>
			            <tr>
				        <td></td>
				        <td style="color: red;">*<?php db_get_text($lang, 'all', 'compte_pas_encore_active_item'); ?>*</td>
				    </tr>
			                      <?php }?>
			                      <?php if($_GET['id_err']==1){?>
			            <tr>
				        <td></td>
				        <td style="color: red;">*<?php db_get_text($lang, 'all', 'customer_error_login'); ?>*</td>
				    </tr>
			                      <?php }?>
			                      <?php if($_GET['id_err']==10){
			                      
						$check=new Checker(); 
						$compte="null@compte.set";
						if(isset($_POST['compte']))
						$compte=$_POST['compte'];
						if($check->isMail($compte)){
							$m=new ForgetPassword($compte,getShopConfig()['email'],getShopConfig()['name'],$lang);		
						} else {
							$customer=new Customer($compte,null,null,null);
							$m=new ForgetPassword($compte,getShopConfig()['email'],getShopConfig()['name'],$lang);
						}
			                      ?>
			            <tr>
					<td></td>
					<td style="color: red;">*<?php echo db_get_text($lang, 'all', 'message_confirmation_mail'); ?>*</td>
				    </tr>
			                     <?php } ?>
			                     <?php if($_GET['id_err']==3){
			                     ?>
			            <tr>
					<td></td>
					<td style="color: red;">*<?php echo db_get_text($lang, 'all', 'compte_n_exixte_pas_item'); ?>*</td>
				    </tr> 
			                    
			            <?php }
			                       }
			            ?>
			</form>
			
			</table>
			
			</tr>
			
		
			<tr>
				<td><?php require_once 'customer/includes/newcompte.php';?>
				</td>

			</tr>
		</table>

		</div>

		</div>
					
	 </div>

	</div>
	           
	           
  <!--TOP MENU-->
			
	<?php include "php_includes/top_menu.php";?>	
	           
	<div class="copyright" style="color:#666666; width: 152px; z-index: 1; position: absolute; left: 12px; top: 730px; height: 50px; ">
	           
		<ul>
			<li><h1><a title="" href="Store.php"><?php db_get_text($lang, 'all', 'main_menu_store'); ?></a><br/><br/><br/></h1></li>
			   
			<!-- <li><h1><a title="" href="Account.php"><?php db_get_text($lang, 'all', 'customer_account');?></a><br/><br/><br/></h1></li> -->
			    
			<li><h1><a title="" href="Contact.php"><?php db_get_text($lang, 'all', 'main_menu_contact');?></a><br/><br/><br/></h1></li>
		<ul>

	</div>

	           	

  <!-- COPYRIGHT 
	<div id="copyright" style="height:30px; left:100px; position: absolute; top:950px; width: 1000px; z-index: 1; " class="copyright">
	<p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
        </div>
  -->
	      
  <!-- FACEBOOK 
	<div style="right: 100px; top: 950px; position: absolute; opacity: 1.00; height: 25px; width: 25px; z-index: 1;">
		<a target="_blank" href="http://www.facebook.com/topskates">
		<img src="images/facebook_logo.png" style="height: 25px; width: 25px;" />
		<img src="images/facebook_logo_long.png" style="height: 32px; width: 90px;" />
		</a>
	</div>
-->
	</div>
		
</body>
	  
</html>

