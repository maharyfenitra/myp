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
	include './customer/library/history.php';
	
	

        
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
        <meta name="viewport" content="user-scalable=yes, width=636" />
        <link href="jquery-ui/jquery-ui.css" rel="stylesheet">
        <style type="text/css">
        .matable {
	margin:0px;padding:0px;
	width:100%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:8px;
	-webkit-border-bottom-left-radius:8px;
	border-bottom-left-radius:8px;
	
	-moz-border-radius-bottomright:8px;
	-webkit-border-bottom-right-radius:8px;
	border-bottom-right-radius:8px;
	
	-moz-border-radius-topright:8px;
	-webkit-border-top-right-radius:8px;
	border-top-right-radius:8px;
	
	-moz-border-radius-topleft:8px;
	-webkit-border-top-left-radius:8px;
	border-top-left-radius:8px;
}.matable table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:auto;
	margin:0px;padding:0px;
}.matable tr:last-child td:last-child {
	-moz-border-radius-bottomright:8px;
	-webkit-border-bottom-right-radius:8px;
	border-bottom-right-radius:8px;
}
.matable table tr:first-child td:first-child {
	-moz-border-radius-topleft:8px;
	-webkit-border-top-left-radius:8px;
	border-top-left-radius:8px;
}
.matable table tr:first-child td:last-child {
	-moz-border-radius-topright:8px;
	-webkit-border-top-right-radius:8px;
	border-top-right-radius:8px;
}.matable tr:last-child td:first-child{
	-moz-border-radius-bottomleft:8px;
	-webkit-border-bottom-left-radius:8px;
	border-bottom-left-radius:8px;
}.matable tr:hover td{
	
}
.matable tr:nth-child(odd){ background-color:#e5e5e5; }
.matable tr:nth-child(even)    { background-color:#ffffff; }.matable td{
	vertical-align:middle;
	
	
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:3px;
	font-size:10px;
	font-family:Arial;
	font-weight:normal;
	color:#000000;
}.matable tr:last-child td{
	border-width:0px 1px 0px 0px;
}.matable tr td:last-child{
	border-width:0px 0px 1px 0px;
}.matable tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.matable tr:first-child td{
		background:-o-linear-gradient(bottom, #cccccc 5%, #b2b2b2 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #b2b2b2) );
	background:-moz-linear-gradient( center top, #cccccc 5%, #b2b2b2 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#b2b2b2");	background: -o-linear-gradient(top,#cccccc,b2b2b2);

	background-color:#cccccc;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
	color:#000000;
}
.matable tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #cccccc 5%, #b2b2b2 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #b2b2b2) );
	background:-moz-linear-gradient( center top, #cccccc 5%, #b2b2b2 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#b2b2b2");	background: -o-linear-gradient(top,#cccccc,b2b2b2);

	background-color:#cccccc;
}
.matable tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.matable tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
.bori{
            border:0px solid black;
            -moz-border-radius:7px;
            -webkit-border-radius:12px;
            border-radius:12px;

}
       label
       {
           color: rgb(15, 12, 12);
           font-size: 12px;
           font-weight:bold;
         /*  background-color: rgb(120, 120, 120);*/
        /*   text-shadow: rgb(3, 3, 3) -1px 0px 2px;*/
       }
        .myInput{
 border-width:2px;
 border-color:#cccccc; 
 border-style:solid; 
 padding:4px; 
 font-size:14px; 
 text-shadow:0px 0px 0px rgba(42,42,42,.75);
 
    border:0px solid black;
            -moz-border-radius:7px;
            -webkit-border-radius:12px;
            border-radius:12px;
 }
	.myButton {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9));
	background:-moz-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
	background:-webkit-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
	background:-o-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
	background:-ms-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
	background:linear-gradient(to bottom, #f9f9f9 5%, #e9e9e9 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9',GradientType=0);
	background-color:#f9f9f9;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	cursor:pointer;
	color:#666666;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #ffffff;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #e9e9e9), color-stop(1, #f9f9f9));
	background:-moz-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
	background:-webkit-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
	background:-o-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
	background:-ms-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
	background:linear-gradient(to bottom, #e9e9e9 5%, #f9f9f9 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e9e9e9', endColorstr='#f9f9f9',GradientType=0);
	background-color:#e9e9e9;
}
.myButton:active {
	position:relative;
	top:1px;
}



        .matable {
	margin:0px;padding:0px;
	width:100%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:8px;
	-webkit-border-bottom-left-radius:8px;
	border-bottom-left-radius:8px;
	
	-moz-border-radius-bottomright:8px;
	-webkit-border-bottom-right-radius:8px;
	border-bottom-right-radius:8px;
	
	-moz-border-radius-topright:8px;
	-webkit-border-top-right-radius:8px;
	border-top-right-radius:8px;
	
	-moz-border-radius-topleft:8px;
	-webkit-border-top-left-radius:8px;
	border-top-left-radius:8px;
}.matable table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.matable tr:last-child td:last-child {
	-moz-border-radius-bottomright:8px;
	-webkit-border-bottom-right-radius:8px;
	border-bottom-right-radius:8px;
}
.matable table tr:first-child td:first-child {
	-moz-border-radius-topleft:8px;
	-webkit-border-top-left-radius:8px;
	border-top-left-radius:8px;
}
.matable table tr:first-child td:last-child {
	-moz-border-radius-topright:8px;
	-webkit-border-top-right-radius:8px;
	border-top-right-radius:8px;
}.matable tr:last-child td:first-child{
	-moz-border-radius-bottomleft:8px;
	-webkit-border-bottom-left-radius:8px;
	border-bottom-left-radius:8px;
}.matable tr:hover td{
	
}
.matable tr:nth-child(odd){ background-color:#e5e5e5; }
.matable tr:nth-child(even)    { background-color:#ffffff; }.matable td{
	vertical-align:middle;
	
	
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:3px;
	font-size:10px;
	font-family:Arial;
	font-weight:normal;
	color:#000000;
}.matable tr:last-child td{
	border-width:0px 1px 0px 0px;
}.matable tr td:last-child{
	border-width:0px 0px 1px 0px;
}.matable tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.matable tr:first-child td{
		background:-o-linear-gradient(bottom, #cccccc 5%, #b2b2b2 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #b2b2b2) );
	background:-moz-linear-gradient( center top, #cccccc 5%, #b2b2b2 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#b2b2b2");	background: -o-linear-gradient(top,#cccccc,b2b2b2);

	background-color:#cccccc;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
	color:#000000;
}
.matable tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #cccccc 5%, #b2b2b2 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #b2b2b2) );
	background:-moz-linear-gradient( center top, #cccccc 5%, #b2b2b2 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#b2b2b2");	background: -o-linear-gradient(top,#cccccc,b2b2b2);

	background-color:#cccccc;
}
.matable tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.matable tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
       label
       {
           color: rgb(15, 12, 12);
           font-size: 12px;
         /*  background-color: rgb(120, 120, 120);*/
        /*   text-shadow: rgb(3, 3, 3) -1px 0px 2px;*/
       }
        .myInput{
 border-width:2px;
 border-color:#cccccc; 
 border-style:solid; 
 padding:4px; 
 font-size:14px; 
 text-shadow:0px 0px 0px rgba(42,42,42,.75);
 }
	.myButton {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9));
	background:-moz-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
	background:-webkit-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
	background:-o-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
	background:-ms-linear-gradient(top, #f9f9f9 5%, #e9e9e9 100%);
	background:linear-gradient(to bottom, #f9f9f9 5%, #e9e9e9 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9',GradientType=0);
	background-color:#f9f9f9;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	cursor:pointer;
	color:#666666;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #ffffff;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #e9e9e9), color-stop(1, #f9f9f9));
	background:-moz-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
	background:-webkit-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
	background:-o-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
	background:-ms-linear-gradient(top, #e9e9e9 5%, #f9f9f9 100%);
	background:linear-gradient(to bottom, #e9e9e9 5%, #f9f9f9 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e9e9e9', endColorstr='#f9f9f9',GradientType=0);
	background-color:#e9e9e9;
}
.myButton:active {
	position:relative;
	top:1px;
}





</style>

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
                 style=" position: absolute;  left: 20px; width: 265px; margin-left: 2px; margin-top: 2px; z-index: 1;" />
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
	           
	           <!-- copy these lines to your document: -->
<!--
	<div id="storetopskate_hype_container" style="margin:auto;position:relative;width:994px;height:100px;overflow:hidden;top: 108px;" aria-live="polite">
		<script type="text/javascript" charset="utf-8" src="html5/store_top_skate.hyperesources/storetopskate_hype_generated_script.js?51952"></script>
	</div>-->

	<!-- end copy -->

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
	           <div id="body_content" class="cool_stuff"  style="border: 0px solid; border-radius: 10px;left:167px; width: 843px;  height:auto; min-height:800px;top: 220px; z-index: 1;position: absolute; ">
 
		
		<!--  début table historique de commande --> 
		
		
				<?php $customer=new Customer($_SESSION ['session_name'],null,null,null);
			     	      $admin = new AdminCustomer();
			     	      $cu_id = $customer->getMail();
			     	      $history = new History();
			     	      $od_id = $_GET['od_id'];
			     	      //echo $od_id;
			     	      $order = $history->getAllItemForODID($od_id);
			     	   // print_r($order);
			     	    $d= $history->getThingIDO($od_id);
			     	    $d=$d[0];
			     	    // print_r($d);
			     	      
			     	?>
			     	
		
		
		<table width=100% cellspacing="15" cellpading="2" border="0" >
			<tr> 
				<td>
					<table  width=100%    cellspacing="0" cellpading="1"  >
					
					
						<tr>
							<td align="left" colspan="6">
							
					        		<script>
						      	function retour (){
						      	
						      		document.location.href="Account.php";
						      	
						      	}
						      	
						      	
						      	</script>
					
					
					
							<input type="button" name="retour" onclick="retour()"  value="<?php db_get_text($lang, 'all', 'bouton_retour_item'); ?>" 
							style=" background:url(images/button_previous.png);background-size:120px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width: 120px; margin-top: 5px;"; ?>
				        			   
				        			    
				              
				      			</td>
		               			</tr>
					
					
					
					
						<tr>
							<td align="center" colspan="6">
							
				        			<h1>	<?php db_get_text($lang, 'all', 'details_order_title_item'); ?> 
				        			
				        			
					        			
					        			<?php
								$date= new DateTime($d['od_date']);
								echo $date->format('d/m/y');
								?>
								
							</h1>
				        			   
				        			    
				              
				      			</td>
		               			</tr>
					</table>
				</td>
			
			</tr>
			
			
			
			
			
			<tr> 
				<td>
					<table  width=100%    cellspacing="0" cellpading="1" height=auto bordercolor="#aaaaaa" border="0" >
		

					
		<table width=100%>
		             <tr><td width=25%>
		             <div width=100% height=100%>
		                 <table>
		                 
		                 <tr><td><font color="black" size="2"><?php db_get_text($lang, 'store', 'checkout_shipping_address'); ?> <br> </font></td></tr>
		                 <tr><td>&nbsp;<?php  echo  $d['od_payment_first_name'];?></td></tr>
		                 <tr><td>&nbsp;<?php  echo  $d['od_payment_last_name'];?></td></tr>
		                 <tr><td>&nbsp;<?php  echo  $d['od_shipping_email'];?></td></tr>
		                 <tr><td>&nbsp;<?php  echo  $d['od_shipping_address1'];?></td></tr>
		                 <tr><td>&nbsp;<?php  echo  $d['od_shipping_zip'];?></td></tr>
		                 <tr><td>&nbsp;<?php  echo  $d['od_shipping_country'];?></td></tr>
		                 <tr><td>&nbsp;<?php  echo  $d['od_shipping_phone'];?></td></tr>
		                 </table>
		             </div>
		             </td>
		             
		             <td width=75%>
		             
		                <table width=100%   cellspacing="0" cellpading="15" bordercolor="#aaaaaa" border="1">
		                    <tr><td align="center"><font size="2" color="black"><?php echo db_return_text($lang,'store','designation'); ?><br></font></td><td align="center"><font size="2" color="black"><?php echo db_return_text($lang,'store','model'); ?><br></font></td><td align="center"><font size="2" color="black"><?php echo db_return_text($lang,'store','price'); ?><br></font></td><td align="center"><font size="2" color="black"><?php echo db_return_text($lang,'store','order_total'); ?><br></font></td></tr>
		                    <?php 
		                    $sout=0;
		                    foreach($order as $ord){?>
		                    <tr><td><?php echo db_get_text($lang, 'store', 'product_'.$ord['oi_pd_reference']."_name");?>&nbsp;</td>
		                    <td><?php echo  $ord['oi_pi_flavor'];?></td>
		                    <td align="right"><?php echo  displayAmount($ord['oi_price']);?>&nbsp;</td>
		                    <td align="right"><?php 
		                          $sout+=$ord['oi_price']*$ord['oi_qty'];
		                    
		                    echo  displayAmount($ord['oi_price']*$ord['oi_qty']);?>&nbsp;</td></tr>
		                    <?php }?>
		                    <tr><td colspan="3">
		                             <table width="100%">
		                               <tbody>
		                                   <tr>
		                                      <td width="80%"></td>
		                                      <td width="20%" align="right"><br/><br/><?php echo db_return_text($lang,'store','cart_sub_total'); ;?></td>
		                                    </tr>
		                               </tbody>
		                            </table>
		                            </td>
		                            <td align="right"><br/><br/><?php echo displayAmount($sout)."&nbsp;";?></td></tr>
		                    <tr><td colspan="3"><?php db_get_text($lang, 'all', 'reference_achat_item');?>&nbsp;:&nbsp;<?php echo $d['od_reference'] ?></td><td align="right"><?php $sout+=$d['od_shipping_cost'];
		                    
		                    echo displayAmount($d['od_shipping_cost'])."&nbsp;";?></td></tr>
		                    <tr><td colspan="3">
		                       <table width="100%">
		                              <tr>
		                                      <td width="70%"><font size="2" color="black">
		                                      <?php db_get_text($lang, 'all', 'statut_item'); ?>&nbsp;:&nbsp; </font>
		                                      <?php echo db_get_text($lang, 'all', $d['od_payment_status'].'_status_item'); ?> 
		                                      </td>
		                                      
		                                     
		                                      <td align="right"><font size="3" color="black"><?php db_get_text($lang,'store','total_amount') ;?>&nbsp;</font></td>
		                             </tr>
		                       </table>
		                    
		                    </td><td align="right"><font size="3" color="black"><?php echo displayAmount($sout)."&nbsp;";?></font></td></tr>
		                </table>
		             
		             
		             </td></tr>
		   </table>
					<!---
				       <table cellspacing="0" cellpading="15"  bordercolor="#aaaaaa" border="1"
				       
				       border=0 width=100%>
				       <tbody>
					      <tr><td align="center" colspan="5">
					        <h2>Topskates Shop</h2>
					      
					      </td></tr>
				      		<tr><th align="center"> 
				      			<h5><?php db_get_text($lang, 'all', 'product_name_item'); ?></h5>
				      		</th>

						<th align="center">
							<h5><?php db_get_text($lang, 'all', 'flavor_item'); ?></h5>
				
						</th>
			
			

						<th align="center">
							<h5><?php db_get_text($lang, 'all', 'product_price_item'); ?></h5>
				
						</th>
	
						<th align="center">
							<h5><?php db_get_text($lang, 'all', 'product_qty_item'); ?></h5>
				
						</th>

						<th align="center">	
							<h5><?php db_get_text($lang, 'all', 'product_amount_item'); ?></h5>
						</th>
					        
						</tr>


					        <?php  
					        $total=0;	 
					        foreach($order as $ord){
						     
						  ?>
						  <tr>
							  <td width="140" align="left">&nbsp;&nbsp;
							     <?php echo db_get_text($lang, 'store', 'product_'.$ord['oi_pd_reference']."_name");
					   			echo $ord['oi_pd_reference'];?>
							  </td>
						  
						  
						  
							  <td style="text-aligne : right;">
							     &nbsp;&nbsp;<?php $od_id = $ord['od_id'];
							      	echo $ord['oi_pi_flavor']; ?>
							  </td>
							  
						
							  
							  <td align="right">
							     <?php 
							    	 echo displayAmount($ord['oi_price']);  ?>&nbsp;&nbsp;
							  </td>
							  
							  <td align="right">
							     <?php echo $ord['oi_qty']; ?>&nbsp;&nbsp;
							  </td>
							  
							  <td align="right">
							     <?php 
							     $total+=$ord['oi_qty']*$ord['oi_amount'];
							     echo displayAmount($ord['oi_amount']); ?>&nbsp;&nbsp;
							  </td>
							  
				      </tr> 
						  <?php
						   
					        }
					        ?>
					        <tfoot><tr><td></td><td></td><td></td><td></td><td align="right"><h4><?php echo displayAmount($total); ?></h4></td></tr></tfoot>
						</tbody>
						
				      </table>---------------------------->
				      
				      
				      
				      
				      
				      
				      
				      
					<!---- <h3><a class="myButton" href="Account.php" style="color:grey;"><img src="images/retour.png" style="{ vertical-align: top; }"/> <span ><?php "< ".db_get_text($lang, 'all', 'bouton_retour_item'); ?></span></a></h3> ---->
					
						
					
				
	          			</table>
				</td>
			
			</tr>
			
			
			
			
			<tr> 
				<td>
					<table>
					
					 </table>
				
				
				</td>
			
			</tr>
			
		
			
		</table>
		<!--  fin table historique de commande --> 
		
		 </table>
		 
        


		<!--------------------------------------------------------------------------------->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#envoyer').on('submit', function(e) {

     //Debut fonction
        
        e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
 
       
      })
   });

</script>  


	</div>
		
	
<!-------------------------------------------------------------------------------------------------->   
<!-- ######## FOOTER ################## Hier werde ich ein Bild speichern--> 
				
	           <!-- COPYRIGHT
	           <div id="copyright" style="height:30px; left:100px;  top:850px; width: 800px; z-index: 1; " class="copyright">
	               <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
	           </div> -->


      
	           
	           
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

