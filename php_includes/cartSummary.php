<?php

require_once 'php_includes/config.php';
require_once 'php_includes/cart-functions.php';

if (!defined('WEB_ROOT')) {
	exit;
}

$cartContent = getCartContent($lang);

$numItem = count($cartContent);

if(!isset($_SESSION['session_name'])){
  /* $subTotal = 0;
   $subTotal_numItems = 0;
   $subTotal_weight = 0;
   $subTotal_shipping_weight = 0;
   for ($i = 0; $i < $numItem; $i++) {
       extract($cartContent[$i]);
       echo '<div>';
       print_r($cartContent[$i]);
       echo '</div>';
       $pd_name = "$ct_qty x $pd_name";
       $subTotal_weight += $pi_weight * $ct_qty;
       $subTotal_shipping_weight += $pi_shipping_weight * $ct_qty;
       $subTotal_numItems += $ct_qty;
       $subTotal += $ta_price * $ct_qty;
   }*/
   
   $subTotal = 0;
   $subTotal_numItems = 0;
   $subTotal_weight = 0;
   $subTotal_shipping_weight = 0;
   //$_customer_c=new Customer($_SESSION['session_name'],null,null,null);
   $pri=new ProductInfo();
   for ($i = 0; $i < $numItem; $i++) {
       extract($cartContent[$i]);
       $pri->setPdid($pd_id);
       $customerprice=$pri->getPrice(ID_DEFAULT_CUSTOMER_TYPE);
       $pd_name = "$ct_qty x $pd_name";
       $subTotal_weight += $pi_weight * $ct_qty;
       $subTotal_shipping_weight += $pi_shipping_weight * $ct_qty;
       $subTotal_numItems += $ct_qty;
       //$subTotal += $ta_price * $ct_qty;

       if($customerprice!=''){
                     $subTotal += $customerprice * $ct_qty;
                 }
                  else{
                         $subTotal += $ta_price * $ct_qty;
                    }
              }
}
else{
   $subTotal = 0;
   $subTotal_numItems = 0;
   $subTotal_weight = 0;
   $subTotal_shipping_weight = 0;
   $_customer_c=new Customer($_SESSION['session_name'],null,null,null);
   $pri=new ProductInfo();
   for ($i = 0; $i < $numItem; $i++) {
       extract($cartContent[$i]);
       $pri->setPdid($pd_id);
       
       $customerprice=$pri->getPrice($_customer_c->getType());
       if($customerprice==0||$customerprice=='')
       {$customerprice=$pri->getPrice(ID_DEFAULT_CUSTOMER_TYPE);}
       $pd_name = "$ct_qty x $pd_name";
       $subTotal_weight += $pi_weight * $ct_qty;
       $subTotal_shipping_weight += $pi_shipping_weight * $ct_qty;
       $subTotal_numItems += $ct_qty;
       //$subTotal += $ta_price * $ct_qty;

       if($customerprice!=''){
                     $subTotal += $customerprice * $ct_qty;
                 }
                  else{
                         $subTotal += $ta_price * $ct_qty;
                    }
              }
    }
?>
<table width="96%" border="0" cellspacing="0" cellpadding="0" id="cartSummary">
<tr>
<td>
	<table border="0" width="33%">
		
	<tr>
		<td align="center">
			<img src="images/payment_logo_new_flat.png" style="align:center; width: 160px;"><br>
			<a style="margin-top: 10px"><?php db_get_text($lang,'store','secure_payment'); ?></a>
		</td> 
	
	</table>
</td>
<td></td>
<td>
	<table border="0" width="140" height="75">	
		</tr>
  	  	<tr>
  		<td align="center" padding="5px" style="background:url(gallery_icons/panier.png)no-repeat center center;background-size:90px;color:#ffffff; font-size:12px;">
			<a style="color:#5e5e5e; font-size:18px;font-weight: bold;" href="Store.php?step=0"><?php echo db_return_text($lang,'store','cart_total_items')." : " . $subTotal_numItems; ?></a>
		</td>
  	</tr>
	<!--	
  		<tr >
		<td align="center" >
			<a href="Store.php?step=0"><img src="gallery_icons/panier.png" width="80" />		</td>
	</tr>
-->

	</table>
</td>
<td>
	
	<table border="0" width="33%">
	<tr>
  		<td align="center" style="color:#5e5e5e; font-size:14px;">
			<?php echo db_return_text($lang,'store','cart_total')." : "; ?>
		</td>
  	</tr>
  	<tr>
  		<td align="center" style="color:#5e5e5e; font-size:18px;font-weight: bold;" >
			<?php echo displayAmount($subTotal); ?>
		</td>
  	</tr>
	<tr>
  		<td align="center"> 
  			<form action="Store.php" method="POST" name="frmCheckout" id="frmCheckout">
			<input type='hidden' name='step' value='1'>
			<input type='submit' name='cmd' value='<?php db_get_text($lang, 'store', 'cart_checkout'); ?>' style=" background:url(images/button_checkout.png);background-size:100px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:14px; border:0; align:center; width: 100px; margin-top: 0px;" alt=<?php db_get_text($lang, 'store', 'cart_checkout'); ?>></input>
  			</form> 
  		</td>
 	</tr>	
	</table>
</td>

</tr> 
 
 <!-- info poids 
  	<tr >
  	<td align="center" height="16"> <?php db_get_text($lang, 'store', 'cart_total_shipping_weight'); ?>&nbsp;:</td>
  	</tr>
  	<tr>
   	<td align="center" height="16"><strong><?php echo  $subTotal_shipping_weight; ?> g</strong></td>
  	</tr>
 --> 	
  	

</table>
