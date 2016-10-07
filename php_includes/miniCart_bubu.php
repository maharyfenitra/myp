<?php
require_once 'php_includes/config.php';
require_once 'php_includes/cart-functions.php';

if (!defined('WEB_ROOT')) {
	exit;
}


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : 'view';

switch ($action) {
	case 'add' :
		addToCart();
		break;
	case 'update' :
		updateCart();
		break;	
	case 'delete' :
		deleteFromCart();
		break;
	case 'view' :
}

$cartContent = getCartContent();

$numItem = count($cartContent);	
?>
<h1>php_includes/miniCart_bubu.php l 29</h1>
<table width="100%" border="1" cellspacing="0" cellpadding="2" id="minicart">
 <?php
if ($numItem > 0) {
?>

<?php
	$subTotal = 0;
	for ($i = 0; $i < $numItem; $i++) {
		extract($cartContent[$i]);
		$image = "$pd_thumbnail";
		$pd_name = "$ct_qty x $pd_name";
		$url = "index.php?c=$cat_id&p=$pd_id";
		
		$subTotal += $pd_price * $ct_qty;
?>
 <tr >

  <td ><img src="<?php echo $image; ?>"><a href="<?php echo $url; ?>"><?php echo $pd_name; ?></a></td>

  <td width="30%" align="center"><?php echo "Price " . displayAmount($pd_price); ?></td>
  
  <td width="75" align="center"><?php echo "quantity "; ?><input name="txtQty[]" type="text" id="txtQty[]" size="5" value="<?php echo $ct_qty; ?>" class="box" onKeyUp="checkNumber(this);">
  <input name="hidCartId[]" type="hidden" value="<?php echo $ct_id; ?>">
  <input name="hidProductId[]" type="hidden" value="<?php echo $pd_id; ?>">
  </td>
  <td  width="30%" align="right"><?php echo "Total" . displayAmount($subTotal + $shopConfig['shippingCost']); ?>
  </td>

  
<!-- Old delete 
<td width="75" align="center"> <input name="btnDelete" type="button" id="btnDelete" value="Delete" onClick="window.location.href='<?php echo $_SERVER['PHP_SELF'] . "?action=delete&cid=$ct_id"; ?>';" class="box"> </td> -->

  <td>
  <a href='<?php echo $_SERVER['PHP_SELF'] . "?action=delete&cid=$ct_id" ?>' >Remove</a>

</td>
  
 </tr>
<?php
	} // end while
?>
  <tr border="none"><td align="right">Sub-total</td>
  <td width="30%" align="right"><?php echo displayAmount($subTotal); ?></td>
 </tr>
  <tr><td align="right">Shipping</td>
  <td width="30%" align="right"><?php echo displayAmount($shopConfig['shippingCost']); ?></td>
 </tr>
  <tr><td align="right">Total</td>
  <td width="30%" align="right"><?php echo displayAmount($subTotal + $shopConfig['shippingCost']); ?></td>
   </tr>
 <tr class="content"> 
  <td colspan="2" align="right">&nbsp;</td>
  <td width="75" align="center">
  
<a href='<?php echo $_SERVER['PHP_SELF'] . "?action=update&hidCartId=$ct_id&hidProductId=$pd_id&txtQty=2" ?>' >UPDATE</a>
  
<!--<input name="btnUpdate" type="submit" id="btnUpdate" value="Update Cart" class="box" onClick="window.location.href='<?php echo $shoppingReturnUrl; ?>';" class="box"></td>-->
 </tr>  
<?php	
} else {
?>
  <tr><td colspan="2" align="center" valign="middle">Shopping Cart Is Empty</td></tr>

<?php
}

$shoppingReturnUrl = isset($_SESSION['shop_return_url']) ? $_SESSION['shop_return_url'] : 'index.php';
?>
<table width="550" border="0" align="center" cellpadding="10" cellspacing="0">
 <tr align="center"> 
  <td><input name="btnContinue" type="button" id="btnContinue" value="&lt;&lt; Continue Shopping" onClick="window.location.href='<?php echo $shoppingReturnUrl; ?>';" class="box"></td>
<?php 
if ($numItem > 0) {
?>  
  <td><input name="btnCheckout" type="button" id="btnCheckout" value="Proceed To Checkout &gt;&gt;" onClick="window.location.href='checkout.php?step=3';" class="box"></td>
<?php
}
?>  
 </tr>
</table>

</table>
