<?php
require_once 'php_includes/config.php';
require_once 'php_includes/cart-functions.php';
require_once 'php_includes/field_controle.php';


if (!defined('WEB_ROOT')) {
	exit;
}

$cartContent = getCartContent($lang);

$numItem = count($cartContent);	
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0" id="minicartcontainer">
<tr>
<td valign="top">
<table border="0" width="100%" cellspacing="0" cellpadding="0" id="deletebuttons">
<?php
if ($numItem > 0) {
	for ($i = 0; $i < $numItem; $i++) {
		extract($cartContent[$i]);
?>
  <tr height="50">
	<td>
	<form action="<?php echo $_SERVER['PHP_SELF'].'?step=0'; ?>" method="POST" name="frmDelete" id="frmDelete">
	<input name="action" type="hidden" value="delete">
	<? if (isSet($_POST['step'])&&isValidField($_POST['step'])) { echo '<input name="step" type="hidden" value="'; echo $_POST['step']; echo '">'; } ?>
	<input name="cid" type="hidden" value="<? echo $ct_id ?>">
	<input name="i" type="hidden" value="<? echo $pi_id ?>">
	<input type="submit" value="" style=" background:url(images/Button_Delete.png);background-size:15px; background-repeat:no-repeat; background-position:center; color:#dddddd; font-size:11px; border:0; align:center; width: 30px;">
<?php
if (isSet($_POST['step'])&&isValidField($_POST['step'])) {
                if (isSet($local_same_invoice_address)) {
			echo '<input name="h_same_invoice_address" type="hidden" id="hidShippingSameInvoiceAddress" value="';
                	echo $local_same_invoice_address;
                	echo '">';
		}
                if (isSet($local_first_name)) {
			echo '<input name="h_first_name" type="hidden" id="hidShippingFirstName" value="';
                	echo $local_first_name;
                	echo '">';
		}
                if (isSet($local_last_name)) {
                	echo '<input name="h_last_name" type="hidden" id="hidShippingLastName" value="';
                	echo $local_last_name;
                	echo '">';
		}
                if (isSet($local_address1)) {
                	echo '<input name="h_address1" type="hidden" id="hidShippingAddress1" value="';
                	echo $local_address1;
                	echo '">';
		}
                if (isSet($local_city)) {
			echo '<input name="h_city" type="hidden" id="hidShippingCity" value="';
                	echo $local_city;
                	echo '">';
		}
                if (isSet($local_zip)) {
			echo '<input name="h_zip" type="hidden" id="hidShippingZip" value="';
                	echo $local_zip;
                	echo '">';
		}
                if (isSet($local_country)) {
			echo '<input name="h_country" type="hidden" id="hidShippingCountry" value="';
                	echo $local_country;
                	echo '">';
		}
                if (isSet($local_buyer_email)) {
			echo '<input name="h_buyer_email" type="hidden" id="hidShippingBuyerEmail" value="';
                	echo $local_buyer_email;
                	echo '">';
		}
                if (isSet($local_phone)) {
			echo '<input name="h_phone" type="hidden" id="hidShippingPhone" value="';
                	echo $local_phone;
                	echo '">';
		}
                if (isSet($local_billing_first_name)) {
			echo '<input name="h_billing_first_name" type="hidden" id="hidBillingFirstName" value="';
                	echo $local_billing_first_name;
                	echo '">';
		}
                if (isSet($local_billing_last_name)) {
			echo '<input name="h_billing_last_name" type="hidden" id="hidBillingLastName" value="';
                	echo $local_billing_last_name;
                	echo '">';
		}
                if (isSet($local_billing_address1)) {
			echo '<input name="h_billing_address1" type="hidden" id="hidBillingAddress1" value="';
                	echo $local_billing_address1;
                	echo '">';
		}
                if (isSet($local_billing_city)) {
                        echo '<input name="h_billing_city" type="hidden" id="hidBillingCity" value="';
                	echo $local_billing_city;
                	echo '">';
		}	
                if (isSet($local_billing_zip)) {
			echo '<input name="h_billing_zip" type="hidden" id="hidBillingZip" value="';
                	echo $local_billing_zip;
                	echo '">';
		}
                if (isSet($local_billing_country)) {
                        echo '<input name="h_billing_country" type="hidden" id="hidBillingCountry" value="';
                	echo $local_billing_country;
                	echo '">';
		}
                if (isSet($local_billing_email)) {
                        echo '<input name="h_billing_email" type="hidden" id="hidBillingEmail" value="';
                	echo $local_billing_email;
                	echo '">';
		}
                if (isSet($local_optPayment)) {
                        echo '<input name="h_optPayment" type="hidden" id="hidOptPayment" value="';
                	echo $local_optPayment;
                	echo '">';
		}
}
?>



	</form>
	</td>
  </tr>
<?php 
} // end for
?>
</table>
</td><td>
<table border="0" width="100%" cellspacing="0" cellpadding="0" id="minicart">

<?php

	require_once "php_includes/productItemList.php";
	$subTotal = 0;
        $top=-100;
$_session =false;
$_customer_c=null;
$pri=new ProductInfo();
if(isset($_SESSION["session_name"])) {$_session=true;

$_customer_c=new Customer($_SESSION["session_name"],null,null,null);
}

?>
	<form action="<?php 
	//$_SERVER['PHP_SELF']
	echo 'Store.php?step=0'; ?>" method="POST" name="frmCart" id="frmCart">
	<input name="action" type="hidden" value="update">
	<? if (isSet($_POST['step'])&&isValidField($_POST['step'])) { echo '<input name="step" type="hidden" value="'; echo $_POST['step']; echo '">'; } 
	for ($i = 0; $i < $numItem; $i++) {
		extract($cartContent[$i]);
		$image = "$pd_thumbnail";
//		$pd_name = "$ct_qty x $pd_name";
		$url = "index.php?c=$cat_id&p=$pd_id";
		$top=$top+100;	
                 $pri->setPdid($pd_id);
              if($_session){
                 $customerprice=$pri->getPrice($_customer_c->getType());
                }else{
                $customerprice=$pri->getPrice(ID_DEFAULT_CUSTOMER_TYPE);
                  }
                 
                 if($_session&&$customerprice!=''&&$customerprice!=0){
                     //$subTotal += $customerprice * $ct_qty;
                 }
                  else{
                         $customerprice=$pri->getPrice(ID_DEFAULT_CUSTOMER_TYPE);
                       //  $subTotal += $customerprice * $ct_qty;
                    }
                    $ta_price=$customerprice;
                    $subTotal += $customerprice * $ct_qty;

?>

<tr height="50">

  <td width="120" align="center" >
<?php
if (isSet($_POST['step'])&&isValidField($_POST['step'])) {
                if (isSet($local_same_invoice_address)) {
                        echo '<input name="h_same_invoice_address" type="hidden" id="hidShippingSameInvoiceAddress" value="'; 
			echo $local_same_invoice_address; 
			echo '">';
                }
		if (isSet($local_first_name)) {
                	echo '<input name="h_first_name" type="hidden" id="hidShippingFirstName" value="'; 
			echo $local_first_name; 
			echo '">';
		}
                if (isSet($local_last_name)) {
                        echo '<input name="h_last_name" type="hidden" id="hidShippingLastName" value="'; 
			echo $local_last_name; 
			echo '">';
                }
                if (isSet($local_address1)) {
                        echo '<input name="h_address1" type="hidden" id="hidShippingAddress1" value="'; 
			echo $local_address1; 
			echo '">';
                }
                if (isSet($local_city)) {
                        echo '<input name="h_city" type="hidden" id="hidShippingCity" value="'; 
			echo $local_city; 
			echo '">';
		}
                if (isSet($local_zip)) {
                        echo '<input name="h_zip" type="hidden" id="hidShippingZip" value="'; 
			echo $local_zip; 
			echo '">';
                }
                if (isSet($local_country)) {
                        echo '<input name="h_country" type="hidden" id="hidShippingCountry" value="'; 
			echo $local_country; 
			echo '">';
                }
                if (isSet($local_buyer_email)) {
                        echo '<input name="h_buyer_email" type="hidden" id="hidShippingBuyerEmail" value="'; 
			echo $local_buyer_email; 
			echo '">';
                }
                if (isSet($local_phone)) {
                        echo '<input name="h_phone" type="hidden" id="hidShippingPhone" value="'; 
			echo $local_phone; 
			echo '">';
                }
                if (isSet($local_billing_first_name)) {
                        echo '<input name="h_billing_first_name" type="hidden" id="hidBillingFirstName" value="'; 
			echo $local_billing_first_name; 
			echo '">';
                }
                if (isSet($local_billing_last_name)) {
                        echo '<input name="h_billing_last_name" type="hidden" id="hidBillingLastName" value="'; 
			echo $local_billing_last_name; 
			echo '">';
                }
                if (isSet($local_billing_address1)) {
                        echo '<input name="h_billing_address1" type="hidden" id="hidBillingAddress1" value="'; 
			echo $local_billing_address1; 
			echo '">';
                }
                if (isSet($local_billing_city)) {
                        echo '<input name="h_billing_city" type="hidden" id="hidBillingCity" value="'; 
			echo $local_billing_city; 
			echo '">';
                }
                if (isSet($local_billing_zip)) {
                        echo '<input name="h_billing_zip" type="hidden" id="hidBillingZip" value="'; 
			echo $local_billing_zip; 
			echo '">';
                }
                if (isSet($local_billing_country)) {
                        echo '<input name="h_billing_country" type="hidden" id="hidBillingCountry" value="'; 
			echo $local_billing_country; 
			echo '">';
                }
                if (isSet($local_billing_email)) {
                        echo '<input name="h_billing_email" type="hidden" id="hidBillingEmail" value="'; 
			echo $local_billing_email; 
			echo '">';
                }
                if (isSet($local_optPayment)) {
                        echo '<input name="h_optPayment" type="hidden" id="hidOptPayment" value="'; 
			echo $local_optPayment; 
			echo '">';
		}
}
?>

        <a href=<?php echo '"'.$pd_image_large. '"' ?> rel="lightbox" title=<?php echo '"'.$pd_name. '"' ?>>
		<img src=<?php echo '"'.$image. '"' .SetThumbnailDimensions ($image,140,42)?> border="0" alt="<?php echo $pd_name; ?>"><a href="<?php echo $url; ?>">
	</a>
  </td>  

  <td width="260" align="left" style="padding-left:10px" >
       <?php echo $pd_name; ?> 
  </td>

  <td width="100" align="center" > 
	<?php
		if ($pi_id >= 0) {
			echo getProductItemFlavor($pi_id);
	?>		<input name="i[]" type="hidden" value="<?php echo $pi_id; ?>">
	<?php 
		} else {
			echo getCartProductItemList($cat_id,$pd_id,$lang,$i);
		} 
	?>	
  </td>

  <td width="65" align="right" style="padding-right:15px">
      <?php 
    if($_session&&$customerprice!=''){
        echo displayAmount($customerprice);
                                     }else
                     {
                    echo displayAmount($ta_price); }?>
  </td>
  <td width="50" align="center">
        <input name="hidCartId[]" type="hidden" value="<?php echo $ct_id; ?>">
        <input name="hidProductId[]" type="hidden" value="<?php echo $pd_id; ?>">
        <input name="hidProductItemId[]" type="hidden" value="<?php echo $pi_id; ?>">
<!--	<input name="txtQty[]" type="text" id="txtQty[]" size="2" value="<?php echo $ct_qty; ?>" class="box" onKeyUp="checkNumber(this);"> -->
	<?php
		if ((isSet($ct_voucher_id)) && ($ct_voucher_id >= 0)) {
			echo "1";
                } else {
		        echo "<select name='txtQty[]'>";
                             for ($q = 1; $q <= 50; $q++) {
                                      if (isSet($ct_qty)) {
                                              if ($q == $ct_qty) {
                                                       echo "<option value='$q' selected>$q</option>";
                                              } else {
                                                       echo "<option value='$q'>$q</option>";
                                              }
                                      } else {
                                              if ($q == 1) {
                                                       echo "<option value='$q' selected>$q</option>";
                                              } else {
                                                       echo "<option value='$q'>$q</option>";
                                              }
                                      }
                              }
                echo "</select>";
		}
          ?>

  </td>
  <td  width="70" align="right">
        <?php 
if($_session&&$customerprice!=''){
        echo displayAmount($customerprice * $ct_qty);
        
                                     }else{
echo displayAmount($ta_price * $ct_qty);} ?>
  </td>
  <td  width="10" align="right">&nbsp;&nbsp;&nbsp;</td>
    
</tr>
<?php
	} // end for
?>
</table>
</td>
</tr> 
<tr>
 <td colspan="2">
<table width = "100%" bgcolor ="#EFEDED"  cellpadding ="5">
 <tr>
 	<td align="right"><font color="black" size="3"><?php echo db_return_text($lang,'store','cart_total')." :"; ?></font></td>
  	<td align="right"><font color="black" size="3"><?php echo displayAmount($subTotal); ?></font></td>
 </tr>
 <tr class="content"> 
 <script>
 
   function f(){document.location.href="Store.php?step=1";}
 </script>
  	<td colspan="1" align="left">
  	     <input type='button' name='cmd' onclick='f()' value='<?php db_get_text($lang, 'store', 'cart_checkout'); ?>' style=" background:url(images/button_checkout.png);background-size:100px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width: 100px; margin-top: 0px;" alt=<?php db_get_text($lang, 'store', 'cart_checkout'); ?>/>
  	</td>
  	<td width="95" align="center">
  
  
  
  
  <input name="btnUpdate" id="btnConfirm" value="<?php echo db_return_text($lang,'store','cart_update'); ?>" class="box" style=" background:url(images/button_update.png);background-size:150px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width: 150px; " type="submit">
  
  
  
  
  
  
  </td>
</table>
  
</form>

 </td>
</tr>

<?php
} else {
	if (1==$thank_you) {
		echo "<tr><td colspan='2' align='center' valign='middle' height='120'>";
		echo db_return_text($lang,'store','cart_thank_you');
		echo "<br>";
		if (1==$thank_you_online) echo db_return_text($lang,'store','cart_thank_you_online'); 
		if (1==$thank_you_offline) echo db_return_text($lang,'store','cart_thank_you_offline'); 
		echo "</td></tr>";
	} else {
  		echo "<tr><td colspan='2' align='center' valign='middle' height='120'>";
		echo db_return_text($lang,'store','cart_empty'); 
		echo "</td></tr>";
	}
}
$shoppingReturnUrl = isset($_SESSION['shop_return_url']) ? $_SESSION['shop_return_url'] : 'index.php';
?>
 
 </tr>

</table>

</tr></table>

