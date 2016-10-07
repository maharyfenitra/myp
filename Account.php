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
        if(!isset($_SESSION["session_name"])){
            header("location:Store.php");
        
        }
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
	       
	       
        <meta name="viewport" content="user-scalable=yes, width=636" />
        <link href="jquery-ui/jquery-ui.css" rel="stylesheet">
        <style>
	body{
		font: 80% "Trebuchet MS", sans-serif;
		margin: 10px;
	}
	.demoHeaders {
		margin-top: 2em;
	}
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	.fakewindowcontain .ui-widget-overlay {
		position: absolute;
	}
	select {
		width: 300px;
	}
        .ui-datepicker-table
          {
            width :100%;
            }
     /*   th {
    color: #FFF;
    font-family: "Arial";
    font-size: 9px;*/
}
	</style>

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

</style>
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
	           <div id="body_content" class="cool_stuff"  style="border: 0px solid; border-radius: 10px;left:167px; width: 843px;  height:auto; top: 220px; z-index: 1;position: absolute; ">


        
<script src="jquery-ui/jquery-ui.js"></script>


		

		<!-- HOME MENU BANNER -->
		
		  


<!-- ######### MAIN PANEL #################################### --> 
            
       
            <!-- BLOK DIV 1 -->
          
     	<!-- <div id="body_content" style="border-radius:10px; width: 900px;  height: 1000px; left: -75px; position: absolute; top: -150px; z-index: 1; vertical-align:middle;">-->
			
     	<?php $customer=new Customer($_SESSION['session_name'],null,null,null);
     	      $admin = new AdminCustomer();
     	      $cu_id = $customer->getCuName();
     	      $history = new History();
     	      $order = $history->getCustomerHitory($cu_id);
     	      //print_r($order);
     	      
     	      
     	?>
<script>

$(document).ready(function() {
    $('#monForm').on('submit', function(e) {

     //Debut fonction
        
       // e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
 
        var $this = $(this);
 
        var pseudo = $('#pseudo').val();
        var mail = $('#mail').val();
        var p_1=$('#password').val();
        var p_2=$('#password_2').val();
       // alert(p_1+"  "+p_2);
       if(p_1===''){
           e.preventDefault();
           alert("<?php echo db_get_text_($lang, 'all', 'wrong_confirm_password'); ?>");
            }else
       if(p_1!==p_2){
          e.preventDefault();
          alert("<?php echo db_get_text_($lang, 'all', 'not_identical_password_item'); ?>");
       }else
        
        if(pseudo === '') {
            e.preventDefault();
            alert("<?php echo db_get_text_($lang, 'all', 'missing_important_field'); ?>");
             //  return;
                } else {
               // continue
                //return
           /*  $("#monForm").hide();
         $("#register").hide();
         
            $.ajax({
                url: $this.attr('action'),
                type: $this.attr('method'),
                data: $this.serialize(),
               // dataType: 'json', // JSON
                success: function(json) {
                         if(json!=0)
                            // alert(json);
                            $("#welcome").html("<h2><?php db_get_text($lang, 'all', 'compte_already_exist'); ?></h2>");
     $("#welcome").show();
                   
                }


            });*/
        }
    });
});

</script>  
		

		<div style="left: 50px; position:static; z-index: 1000; top:50px; width: 100%;height :auto;">
		<form method="POST" action="/admin/customer/cycle.php" id="monForm">
		<table width=100%    cellspacing="0" cellpading="15"  border="0" ><tr><td align="center" colspan="2"><h1><?php db_get_text($lang, 'all', 'my_account_item'); ?></h1></td></tr></table>
                <table width=100%    cellspacing="0" cellpading="15"  bordercolor="white" border="0" style="margin-left:50px"  >
   <!--- <tr><th width="220" align="center"></th><th></th></tr> ------------>
   <!-- <tr><td align="right"><label for="club"></td><td><h3><a href='History.php' style='color : black;'><?php db_get_text($lang, 'all', 'history_link_item'); ?></a></h3></label></td></tr>--->
    <tr><td align="left"><label for="mail" style="margin:4px"><?php db_get_text($lang, 'all', 'customer_mail') ;?> :</label></td><td><label><?php  echo $customer->getMail();?></label><input style="margin:4px" class="myInput" type="hidden" id="mail" name="mail" size="44" value='<?php  echo $customer->getMail();?>'/></br></td></tr>
    <tr><td align="left" ><label for="firstname" style="margin:4px"><?php db_get_text($lang, 'all', 'customer_first_name'); ?> :</label></td><td><input  class="myInput" maxlength="15" style="margin:4px" type="text" id="firstname" name="firstname" size="44" value='<?php  echo $customer->getShippingFirstName();?>' /></br></td></tr>
    <tr><td align="left" border="0"><label for="lastname" style="margin:4px"><?php db_get_text($lang, 'all', 'customer_last_name'); ?> :</label></td><td><input class="myInput" maxlength="20" style="margin:4px" type="text" id="lastname" name="lastname" size="44" value='<?php  echo $customer->getShippingLastName();?>'/></br></td></tr>

    <tr><td align="left"><label for="password" style="margin:4px"><?php db_get_text($lang, 'all', 'customer_password'); ?> :</label></td><td><input style="margin:4px" class="myInput" id="password" type="password" id="password" name="password" value='<?php  echo $customer->getPassword();?>'/></br></td></tr>
    <tr><td align="left"><label for="password" style="margin:4px"><?php db_get_text($lang, 'all', 'customer_password_2'); ?> :</label></td><td><input style="margin:4px" class="myInput" id="password_2" type="password" id="password" name="password_2" value='<?php  echo $customer->getPassword();?>'/></br></td></tr>

    <tr><td align="left"><label for="adress" style="margin:4px"><?php db_get_text($lang, 'all', 'customer_adress'); ?> :</label></td><td><input class="myInput" style="margin:4px" type="text" id="password" name="adress" size="44" value='<?php  echo $customer->getAdress();?>'/></br></td></tr>
    <tr><td align="left"><label  for="city" style="margin:4px"><?php db_get_text($lang, 'store', 'checkout_city'); ?> - <?php db_get_text($lang, 'store', 'checkout_zip'); ?> :</label></td><td>

<input class="myInput" style="margin:4px" name="billing_city" type="text" class="box" id="txtPaymentCity" size="31" maxlength="32" value='<?php  echo $customer->getCity();?>' >
			&nbsp;/&nbsp;&nbsp;<input name="billing_zip" type="text" class="myInput box " id="txtPaymentPostalCode" size="6" maxlength="10" value='<?php  echo $customer->getZip();?>'></br></td></tr>

<tr> <td align="left"><label style="margin:4px"><?php db_get_text($lang, 'store', 'checkout_country'); ?> :</label></td> <td class="content">
                <select style="margin:4px" name="billing_country" type="text" class="myInput box" id="txtPaymentCountry" >
                       <option value='<?php echo $customer->getCountry();?>' > <?php echo $customer->getCountry(); ?></option>
                                <?php
                                include "php_includes/country_list.php"
                        ?>

                </select>
                </td>
        </tr>

<tr> <td align="left"><label style="margin:4px"><?php db_get_text($lang, 'store', 'checkout_phone'); ?> :</label></td> <td class="content"><input style="margin:4px" name="phone" type="text" class="myInput box" id="txtShippingPhone" size="44" maxlength="32" value='<?php  echo $customer->getPhone();?>'></td> </tr>

    <tr><td align="left"><label for="birthday" style="margin:4px"><?php db_get_text($lang, 'all', 'customer_birthday'); ?> *:</label></td><td>
    
    <script src="jquery-ui/external/jquery/jquery.js"></script>
<script src="jquery-ui/jquery-ui.js"></script>

<input class="myInput" style="margin:4px" type="text" id="birthday" name="birthday"  size="44" value='<?php echo date('d-m-Y', strtotime($customer->getBirthday()));?>'/></td></tr>


<script>
   // $("#birthday").datepicker({ changeMonth: true, changeYear: true, dateFormat: '<?php db_get_text($lang, 'all', 'date_format'); ?>', yearRange: "1950:+nn" });
    $("#birthday").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'dd-mm-yy', yearRange: "1950:+nn" });
     $('.ui-datepicker-calendar').width(100);
    
  
</script>
    <tr><td align="left"><label for="license" style="margin:4px"><?php db_get_text($lang, 'all', 'customer_license'); ?> :</label></td><td><input  class="myInput" style="margin:4px" type="text" id="club" name="license" size="44" value='<?php  echo $customer->getLicences();?>' /></br></td></tr>
    <tr><td align="left"><label for="club" style="margin:4px"><?php db_get_text($lang, 'all', 'customer_club'); ?> :</label></td><td><input class="myInput" style="margin:4px" type="text" id="club" name="club" size="44" value='<?php  echo $customer->getClub();?>'/></br></td></tr>

<!--    <tr><td align="left"><label for="club" style="margin:4px"><?php db_get_text($lang, 'all', 'customer_type_item'); ?> :</label></td><td>
    
    <label style="margin:4px">
    
    <?php  $type = $customer->getType(); 
           $type = $customer->getLabelTypeFor($type); 
           echo db_get_text($lang, 'all', $type.'_type_item');?>
    
    </label></br></td></tr>
-->
    
    
    
    <tr ><td height="20px"><input type="hidden" name="name__" value="<?php echo $customer->getName();?>"/>
	<input class="myInput" type="hidden" name="key" value="2"/></td><td>
	
	<input  style="margin:20px" class="myButton" type="submit" id="envoyer" value="<?php db_get_text($lang, 'all', 'update_item'); ?>"/></td></tr>
   </table>
		</form>
		<br/>
		<br/>
		<!--  début table historique de commande --> 
		<table width=100% cellspacing="15" cellpading="2" border="0" >
			<tr> 
				<td>
					<table  width=100%    cellspacing="0" cellpading="1"  >
						<tr>
							<td align="center" colspan="6">
				        			<h1><?php db_get_text($lang, 'all', 'history_link_item'); ?></h1>
				      		
				      			</td>
		               			</tr>
					</table>
				</td>
			
			</tr>
			
			
			
			
			
			<tr> 
				<td>
					<table  width=100%    cellspacing="0" cellpading="1" height=auto bordercolor="#aaaaaa" border="0" >
		
						   <tr><th align="center" width="25%" align="left" > 
					      			<?php db_get_text($lang, 'all', 'date_d_achat');?>
					      		</th>

							<th align="center"  width="25%">
								<?php db_get_text($lang, 'all', 'reference_achat_item');?>
							</th>
			
							<!--<th align="center">
								<?php db_get_text($lang, 'all', 'transaction_item'); ?>
							</th>--->

							<th align="center" width="25%">
								<?php db_get_text($lang, 'all', 'statut_item'); ?>
							</th>
	
							<!--<th align="center" width="120">
								<h3><?php db_get_text($lang, 'all', 'adresse_item'); ?></h3>
							</th>

							<th align="center" width="100">	
								<h3><?php db_get_text($lang, 'all', 'pays_item'); ?></h3>
							 
						      </th>-->
							<th align="center">
								<?php db_get_text($lang, 'all', 'total_item'); ?>
							</th>
						        
						 </tr>
					       <!--   <tr><td align="center" width="140" align="left" > 
					      			<?php db_get_text($lang, 'all', 'date_d_achat');?>
					      		</td>

							<td align="center"  width="100">
								<?php db_get_text($lang, 'all', 'reference_achat_item');?>
							</td>
			

							<td align="center" width="150">
								<?php db_get_text($lang, 'all', 'statut_item'); ?>
							</td>
	
							<td align="center" width="120">
								<?php db_get_text($lang, 'all', 'adresse_item'); ?>
							</td>

							<td align="center" width="100">	
								<?php db_get_text($lang, 'all', 'pays_item'); ?>
							 
						      </td>
							<td align="center">
								<?php db_get_text($lang, 'all', 'total_item'); ?>
							</td>
						        
						 </tr>--->
	          			</table>
				</td>
			
			</tr>
			
			
			
			
			<tr> 
				<td>
					 <table  width=100%   cellspacing="0" cellpading="15" bordercolor="#aaaaaa" border="1">
			      		<!--<tr><th align="center"> 
			      			<?php db_get_text($lang, 'all', 'date_d_achat');?>
			      		</th>

					<th align="center">
						<?php db_get_text($lang, 'all', 'reference_achat_item');?>
					</th>
			
			

					<th align="center">
						<?php db_get_text($lang, 'all', 'statut_item'); ?>
					</th>
	
					<th align="center">
						<?php db_get_text($lang, 'all', 'adresse_item'); ?>
					</th>

					<th align="center">	
						<?php db_get_text($lang, 'all', 'pays_item'); ?>
					 
				      </th>
					<th align="center">
						<?php db_get_text($lang, 'all', 'total_item'); ?>
					</th>
				        
					</tr>-->


				        <?php  
				        
				        $customer=new Customer($_SESSION ['session_name'],null,null,null);
		     	                  $admin = new AdminCustomer();
		     	                  $cu_id = $customer->getMail();
		     	                  $history = new History();
		     	                  $order = $history->getCustomerHitory($cu_id);	
		     	                  $d= $history->getAllItemForODID($cu_id);
				        foreach($order as $ord){
				              if($ord['od_payment_status']!='New'){
				           ?>
				           <tr>
				           <td width="25%" align='center'>
				              <?php 
				              
				              $date = new DateTime($ord['od_date']);
				              echo $date->format('d-m-Y');;?>
				           </td>
				           <td width="25%" align='center'>
				              <?php
				              $od_id = $ord['od_id'];
				              
				              $or = $history->getAllItemForODID($od_id);
                                                $t =0;
                                                foreach($or as $o){
                                                     $t+=$o['oi_price']*$o['oi_qty'];
                                
                                                 }
                                
				               echo '<a style="color:black;" href="Details_Orders.php?od_id='.$od_id.'">'.$ord['od_reference'].'</a>'; ?>
				           </td>
				          <!-- <td>
				              <?php echo $ord['od_transaction_number']; ?>
				           </td>-->
				           <td width="25%">
				              &nbsp;&nbsp;<?php
				              db_get_text($lang, 'all', $ord['od_payment_status'].'_status_item');
				              
				             // echo $ord['od_payment_status'];  
				             ?>
				           </td>
				         <!--  <td width="120">
				              <?php echo $ord['od_shipping_address1']; ?>
				           </td>
				           <td width="100">
				              <?php echo $ord['od_shipping_country']; ?>
				           </td>-->
				           <td align='right'>
				              <?php echo displayAmount($ord['od_amount_total']); ?>&nbsp;&nbsp;&nbsp;
				           </td>
			      		</tr> 
				           <?php
				             }
				        }
				        ?>
		    
			      
		
		
				<!-- <h3><a href="Account.php" style="background-color:black"><?php db_get_text($lang, 'all', 'history_link_item'); ?></a></h3> -->
		
		
				
			  
				 
					 
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
<!-------------------------------------------------------------------------------------------------->   
<!-- ######## FOOTER ################## Hier werde ich ein Bild speichern--> 
				
	           <!-- COPYRIGHT
	           <div id="copyright" style="height:30px; left:100px;  top:850px; width: 800px; z-index: 1; " class="copyright">
	               <p style="padding-bottom: 0pt; padding-top: 0pt; "><?php db_get_text($lang, 'all', 'copyright'); ?></p>
	           </div> -->


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

