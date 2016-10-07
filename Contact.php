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
	       <?php include './php_includes/global_header.php'; ?>

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
                 style=" position: absolute;  left: 20px; width: 265px; margin-left: 2px; margin-top: 2px; z-index: 1;"/>
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


	           	
	           			<?php include "php_includes/top_skate_brand.php"; ?>
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
	           <div id="body_content" class="cool_stuff"  style="border: 2px solid; border-radius: 10px; overflow:auto;left:167px; width: 843px;  height: 800px; top: 220px; z-index: 1;position: absolute; ">


<?php 


//(1) On inclut la classe de Google Maps pour générer ensuite la carte.

                  require('GoogleMapAPI.class.php');


//(2) On crée une nouvelle carte; Ici, notre carte sera $map.

                  $map = new GoogleMapAPI('map');


//(3) On ajoute la clef de Google Maps.

                         $map->setAPIKey('<ici la clef Google Maps>');

    

//(4) On ajoute les caractéristiques que l'on désire à notre carte.

                            $map->setWidth("800px");

                             $map->setHeight("500px");

                             $map->setCenterCoords ('2', '48');

                             $map->setZoomLevel (5);


//(5) On applique la base XHTML avec les fonctions à appliquer ainsi que le onload du body.


?>


					<table border=0 width=80% cellpadding="10" >
						<tr height=20px >
						</tr>
						<tr height=30px align=center valign=top >
							<td align=center >
							<h2><?php db_get_text($lang, 'all', 'contact_location'); ?></h2>
							</td>
							<td align=center >
							<h2><?php db_get_text($lang, 'all', 'contact_opening_hours'); ?></h2>
							</td>
							<td align=center >
							<h2><?php db_get_text($lang, 'all', 'contact_service'); ?></h2>
							</td>
						<tr>
							<td align=center>
							TOP SKATES </br>
							43A route de Lyon</br>
							ILLKIRCH </br>
							France </br>
							email: <a href="mailto:contact@top-skates.com">contact@top-skates.com</a> </br>
							</td>
							<td align=center>
							<?php db_get_text($lang, 'all', 'contact_on_appointment'); ?>
							</td>
							<td align=center>
							<?php db_get_text($lang, 'all', 'contact_Service_Content'); ?>	
							</td>
						</tr>
						<tr height=20px >
						</tr>
						<tr>
							<td align=center>
							AGON - Alexis LAIEB </br>
							----- </br>
							RIXHEIM </br>
							France</br>
							email: <a href="alexis@top-skates.co">alexis@top-skates.com</a> </br>
							</td>
							<td align=center>
							<!--
							<?php db_get_text($lang, 'all', 'contact_Mon_to_Fri'); ?> 13:00 - 18:00 </br>
							<?php db_get_text($lang, 'all', 'contact_Saturday'); ?>  09:00 - 13:00 </br>
							-->
							</br>
							<?php db_get_text($lang, 'all', 'contact_on_appointment'); ?> 
							</td>
							<td align=center>
							<?php db_get_text($lang, 'all', 'contact_Service_Content'); ?>	
							</td>
						</tr>
					
					</table>

					<div style="margin-left:40px;">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2641.8615526020462!2d7.7257827!3d48.5358849!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4796ca21652ca51d%3A0x510afa07fab72e16!2s43+Route+de+Lyon%2C+67400+Illkirch-Graffenstaden%2C+France!5e0!3m2!1sfr!2s!4v1443772597812" width="780" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>

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

