
<script language="JavaScript" type="text/javascript" src="library/checkout.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script> 
<script>

/*  $(function(){
 
    $(".cool_stuff").attr("height",100);
     alert($(".cool_stuff").attr("height"));
   });*/
   
   /*
   $(document).ready(function(){
 
    $(".cool_stuff").attr("height",100);
     alert($(".cool_stuff").attr("height"));
   });
   
   */
</script>

<table width="842" border="0" align="center" cellpadding="0" cellspacing="10">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="frmCheckout" id="frmCheckout" onSubmit="return checkShippingAndPaymentInfo();">
<input type='hidden' name='step' value='2'>
    <tr>
	<td>
               	<script>
               	function f (){
               	
               		document.location.href="Store.php?step=0;";
               	}
               	</script>
               
		<!-- <a href="Store.php"> --> 
		<input type="button" name="cancel" onclick="f()" value="<?php db_get_text($lang, 'store', 'checkout_cancel'); ?>" style=" background:url(images/button_previous.png);background-size:120px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width: 120px; margin-top: 5px;" alt=<?php db_get_text($lang, 'store', 'checkout_cancel'); ?>>
	</td>
 
        <td align="center" valign="bottom" ><font color="black" size="4"><?php db_get_text($lang, 'store', 'checkout_step1_title'); ?></font> 
	<?php if ($errorMessage != '') {
		echo "<br><font color='red' size='2'>";
		echo $errorMessage;
		echo "</font>";
	}
	?>
	</td>
	<td>
		<input class="box" name="btnStep1" type="submit" id="btnStep1" value="<?php db_get_text($lang, 'store', 'checkout_proceed'); ?>" style=" background:url(images/button_next.png);background-size:120px 20px; background-repeat:no-repeat; background-position:center; color:#ffffff; font-size:12px; border:0; align:center; width: 120px; margin-top: 5px;" alt=<?php db_get_text($lang, 'store', 'checkout_proceed'); ?>>
	</td>
    </tr>
</table>

          <?php
                if (isSet($_POST['same_invoice_address'])) { $local_same_invoice_address= $_POST['same_invoice_address']; }
                if (isSet($_POST['first_name'])) { $local_first_name = $_POST['first_name']; }
                if (isSet($_POST['last_name'])) { $local_last_name = $_POST['last_name']; }
                if (isSet($_POST['address1'])) { $local_address1 = $_POST['address1']; }
                if (isSet($_POST['city'])) { $local_city = $_POST['city']; }
                if (isSet($_POST['zip'])) { $local_zip = $_POST['zip']; }
                if (isSet($_POST['country'])) { $local_country = $_POST['country']; }
                if (isSet($_POST['buyer_email'])) { $local_buyer_email = $_POST['buyer_email']; }
                if (isSet($_POST['phone'])) { $local_phone = $_POST['phone']; }
                if (isSet($_POST['billing_first_name'])) { $local_billing_first_name = $_POST['billing_first_name']; }
                if (isSet($_POST['billing_last_name'])) { $local_billing_last_name = $_POST['billing_last_name']; }
                if (isSet($_POST['billing_address1'])) { $local_billing_address1 = $_POST['billing_address1']; }
                if (isSet($_POST['billing_city'])) { $local_billing_city = $_POST['billing_city']; }
                if (isSet($_POST['billing_zip'])) { $local_billing_zip = $_POST['billing_zip']; }
                if (isSet($_POST['billing_country'])) { $local_billing_country = $_POST['billing_country']; }
                if (isSet($_POST['billing_email'])) { $local_billing_email = $_POST['billing_email']; }
                if (isSet($_POST['optPayment'])) { $local_optPayment = $_POST['optPayment']; }

		$session_name=false;
		if(isset($_SESSION['session_name']))
		{
	                $session_name=true;
       		        $customer=new Customer($_SESSION['session_name'],null,null,null);
		}
	?>

<div id="ShippingDetailsTable" style="overflow: auto">

<table width="550" border="0" cellspacing="5">
  <tr>
   <td>
    <table width="350" border="0" align="left" cellpadding="0" cellspacing="1" class="entryTable">

        <tr class="entryTableHeader" height="30"> <td colspan="2"><font color="black" size="3">
        <?php 
       	 	if (!isset($_SESSION['session_name'])) {
	       	 	db_get_text($lang, 'all', 'no_account_item');
       	 	} else {
       			db_get_text($lang, 'store', 'checkout_shipping_address');
		} 
	?>

	</font></td> </tr>

        <tr> <td width="120" class="label"><?php if (($errorMessage != '') && ($_POST['first_name'] == '')) { echo "<font color=#FF0000>*&nbsp;"; } else { echo "<font>*&nbsp;"; } db_get_text($lang, 'store', 'checkout_first_name'); echo "</font>"; ?></td> <td class="content"><input name="first_name" type="text" class="box" id="txtShippingFirstName" size="31" maxlength="50" value="<?php if($session_name){ echo $customer->getShippingFirstName();}else if (isSet($_POST['first_name'])) { echo $_POST['first_name']; } ?>"></td> </tr>

        <tr> <td width="120" class="label"><?php if (($errorMessage != '') && ($_POST['last_name'] == '')) { echo "<font color=#FF0000>*&nbsp;"; } else { echo "<font>*&nbsp;"; } db_get_text($lang, 'store', 'checkout_last_name'); echo "</font>"; ?></td> <td class="content"><input name="last_name" type="text" class="box" id="txtShippingLastName" size="31" maxlength="50" value="<?php if($session_name){ echo $customer->getShippingLastName();}else if (isSet($_POST['last_name'])) { echo $_POST['last_name']; } ?>"></td> </tr>

        <tr> <td width="120" class="label"><?php if (($errorMessage != '') && ($_POST['address1'] == '')) { echo "<font color=#FF0000>*&nbsp;"; } else { echo "<font>*&nbsp;"; } db_get_text($lang, 'store', 'checkout_address'); echo "</font>"; ?></td> <td class="content"><input name="address1" type="text" class="box" id="txtShippingAddress1" size="31" maxlength="100" value="<?php if($session_name){ echo $customer->getAdress();}else if (isSet($_POST['address1'])) { echo $_POST['address1']; } ?>"></td> </tr>

        <tr> <td width="120" class="label"><?php if (($errorMessage != '') && ($_POST['city'] == '')) { echo "<font color=#FF0000>*&nbsp;"; } else { echo "<font>*&nbsp;"; } db_get_text($lang, 'store', 'checkout_city');echo "</font>";  ?> - <?php if (($errorMessage != '') && ($_POST['zip'] == '')) { echo "<font color=#FF0000>"; } else { echo "<font>"; } db_get_text($lang, 'store', 'checkout_zip'); ?></td> 
		<td class="content">
			<input name="city" type="text" class="box" id="txtShippingCity" size="15" maxlength="32" value="<?php if($session_name){ echo $customer->getCity();}else if (isSet($_POST['city'])) { echo $_POST['city']; } ?>"> 
			&nbsp;-&nbsp;&nbsp;&nbsp;<input name="zip" type="text" class="box" id="txtShippingPostalCode" size="6" maxlength="10" value="<?php if($session_name){ echo $customer->getZip();}else if (isSet($_POST['zip'])) { echo $_POST['zip']; } ?>">
		</td> 
	</tr>

        <tr> <td width="120" class="label"><?php if (($errorMessage != '') && ($_POST['country'] == '')) { echo "<font color=#FF0000>*&nbsp;"; } else { echo "<font>*&nbsp;"; } db_get_text($lang, 'store', 'checkout_country'); echo "</font>"; ?></td> <td class="content">
		<select  name="country" type="text" class="box" id="txtShippingCountry" >
                          <option value='<?php if(isset($_SESSION['session_name']))
                                         { 
                                        echo $customer->getCountry();
                                            }
                                      else if (isSet($_POST['country']) && ($_POST['country'] != "")) {  
					           echo $_POST['country']; 
				            } else {
					db_get_text($lang, 'store', 'checkout_select_country'); 
				          }
                                      ?>' selected='selected' >
                              <?php 
                              if(isset($_SESSION['session_name']))
                                         { 
                                        echo $customer->getCountry();
                                            }
                                      else if (isSet($_POST['country']) && ($_POST['country'] != "")) {  
					           echo $_POST['country']; 
				            } else {
					db_get_text($lang, 'store', 'checkout_select_country'); 
				          }                             
                                        ?>
                          </option>

                 
			<!-- <?php 
				echo "<option value='";
				
				//echo "' selected='selected'>";
                                 echo "'>";
				if (isSet($_POST['country']) && ($_POST['country'] != "")) {  
					echo $_POST['country']; 
				} else {
					db_get_text($lang, 'store', 'checkout_select_country'); 
				}
				echo "</option>"; 
				db_get_text($lang, 'store', 'checkout_select_country_first_elements');	?> -->

				<?php include "country_list.php" 
			?>
		</select>
		</td> 
	</tr>
        <tr> <td width="120" class="label"><?php if ((($errorMessage != '') && ($_POST['buyer_email'] == '')) || (-2 == $errorCode )) { echo "<font color=#FF0000>*&nbsp;"; } else { echo "<font>*&nbsp;"; } db_get_text($lang, 'store', 'checkout_email'); echo "</font>"; ?></td> <td class="content"><input name="buyer_email" type="text" class="box" id="txtShippingEmail" size="31" maxlength="100" value="<?php if($session_name){ echo $customer->getMail();}else if (isSet($_POST['buyer_email'])) { echo $_POST['buyer_email']; } ?>"></td> </tr>
        <tr> <td width="120" class="label"><?php db_get_text($lang, 'store', 'checkout_phone'); ?></td> <td class="content"><input name="phone" type="text" class="box" id="txtShippingPhone" size="31" maxlength="32" value="<?php if($session_name){ echo $customer->getPhone();}else if (isSet($_POST['phone'])) { echo $_POST['phone']; } ?>"></td> </tr>

    </table>
  </td>
  <td>
   <div id="SeparateInvoicingDetails">
	<input id="same_invoice_address" name="same_invoice_address" type="hidden" value="1">
        <table width="350" border="0" align="center" cellpadding="0" cellspacing="1" class="entryTable">
                <tr class="entryTableHeader">
                        <td width="250" align="center"><font color="black" size="3" ><?php db_get_text($lang, 'store', 'checkout_same_invoice_address'); ?>&nbsp;</font></td>
                </tr>
		<tr>
		        <td align="center"><a id="displayText" href="javascript:toggle();">-> <?php db_get_text($lang, 'store', 'checkout_different_invoice_address'); ?></a></td>
                </tr>
        </table>
    </div>

    <div id="InvoicingDetailsTable" style="display: none">
    <table width="350" border="0" align="left" cellpadding="0" cellspacing="1" class="entryTable">

        <tr class="entryTableHeader" height="30">
            <td width="120"><font color="black" size="3"><?php db_get_text($lang, 'store', 'checkout_billing_address'); ?></font></td>
                <td><a id="displayText2" href="javascript:toggle();">&nbsp;&nbsp;-> <?php db_get_text($lang, 'store', 'checkout_use_shipping_address'); 
                // db_get_text($lang, 'all', 'no_account_item');
                
                ?></a></td>
        </tr>

        <tr> <td width="120" class="label"><?php db_get_text($lang, 'store', 'checkout_first_name'); ?></td> <td class="content"><input name="billing_first_name" type="text" class="box" id="txtPaymentFirstName" size="31" maxlength="50" value="<?php if (isSet($_POST['billing_first_name'])) { echo $_POST['billing_first_name']; } ?>"></td> </tr>

        <tr> <td width="120" class="label"><?php db_get_text($lang, 'store', 'checkout_last_name'); ?></td> <td class="content"><input name="billing_last_name" type="text" class="box" id="txtPaymentLastName" size="31" maxlength="50" value="<?php if (isSet($_POST['billing_last_name'])) { echo $_POST['billing_last_name']; } ?>"></td> </tr>

        <tr> <td width="120" class="label"><?php db_get_text($lang, 'store', 'checkout_address'); ?></td> <td class="content"><input name="billing_address1" type="text" class="box" id="txtPaymentAddress1" size="31" maxlength="100" value="<?php if (isSet($_POST['billing_address1'])) { echo $_POST['billing_address1']; } ?>"></td> </tr>
<!--
        <tr> <td width="120" class="label">Address2</td> <td class="content"><input name="txtPaymentAddress2" type="text" class="box" id="billing_address2" size="30" maxlength="100"></td> </tr>

        <tr> <td width="120" class="label">Phone Number</td> <td class="content"><input name="txtPaymentPhone" type="text" class="box" id="txtPaymentPhone" size="30" maxlength="32"></td> </tr>
-->

        <tr> <td width="120" class="label"><?php db_get_text($lang, 'store', 'checkout_city'); ?> - <?php db_get_text($lang, 'store', 'checkout_zip'); ?></td> 
		<td class="content">
			<input name="billing_city" type="text" class="box" id="txtPaymentCity" size="15" maxlength="32" value="<?php if (isSet($_POST['billing_city'])) { echo $_POST['billing_city']; } ?>">
			&nbsp;-&nbsp;&nbsp;&nbsp;<input name="billing_zip" type="text" class="box" id="txtPaymentPostalCode" size="6" maxlength="10" value="<?php if (isSet($_POST['billing_zip'])) { echo $_POST['billing_zip']; } ?>">
		</td>
	</tr>

        <tr> <td width="120" class="label"><?php db_get_text($lang, 'store', 'checkout_country'); ?></td> <td class="content">
                <select  name="billing_country" type="text" class="box" id="txtPaymentCountry" >
                        <?php 
                                echo "<option value='";
                                if (isSet($_POST['billing_country']) && ($_POST['billing_country'] != "")) {
                                        echo $_POST['billing_country'];
                                } 
                                echo "' selected='selected'>";
                                if (isSet($_POST['billing_country']) && ($_POST['billing_country'] != "")) {  
                                        echo $_POST['billing_country']; 
                                } else {
                                        db_get_text($lang, 'store', 'checkout_select_country'); 
                                }
                                echo "</option>";  
                                db_get_text($lang, 'store', 'checkout_select_country_first_elements');
                                include "country_list.php"
                        ?>

                </select>
                </td>
        </tr>
        <tr> <td width="120" class="label"><?php db_get_text($lang, 'store', 'checkout_email'); ?></td> <td class="content"><input name="billing_email" type="text" class="box" id="txtPaymentEmail" size="31" maxlength="100" value="<?php if (isSet($_POST['billing_email'])) { echo $_POST['billing_email']; } ?>"></td> </tr>

</table>
</div>
</td>
 </tr>
 <tr> 
  <td colspan=2>
        <br><font color="black" size="3"> <?php db_get_text($lang, 'store', 'checkout_payment_method'); ?>: &nbsp;</font>
	<?php   
		if ((!(isSet($_POST['optPayment']))) || (isSet($_POST['optPayment']) && ($_POST['optPayment'] == "payment_online"))) {
		echo '<input name="optPayment" type="radio" id="optPaypal" value="payment_online" checked="checked" />';
		} else {
		echo '<input name="optPayment" type="radio" id="optPaypal" value="payment_online" />';
		}
	?>
       	<label for="optPaypal" style="cursor:pointer"><?php db_get_text($lang, 'store', 'checkout_payment_method_online'); ?></label>

	<?php if ((isSet($_POST['optPayment'])) && ($_POST['optPayment'] == "payment_offline")) {
        	echo '<input name="optPayment" type="radio" id="optCC" value="payment_offline" checked="checked" />';
	} else {
		echo '<input name="optPayment" type="radio" id="optCC" value="payment_offline" />';
	}
	?>
    	<label for="optCC" style="cursor:pointer"><?php db_get_text($lang, 'store', 'checkout_payment_method_offline'); ?></label>
        </H3>
  </td>

 </tr>
</table>
</form>
</div>



<div>
   <?php if(!isset($_SESSION['session_name'])){?>
   <br/><br/><br/>
            <table>
               <?php $e= urlencode ($_SERVER['REQUEST_URI']."?step=1");?>
              <form method="post" action="/customer/includes/signin.php?step=1">
                <tr>
                    <td colspan=2>&nbsp;<font color="black" size="3"><?php db_get_text($lang, 'all', 'customer_sign_in') ?> : &nbsp;</font></td>
                </tr>
                <tr>
                    <td>&nbsp;<?php db_get_text($lang, 'all', 'customer_pseudo_or_email'); ?> :</td><td><input type="text" name="compte" value=""/></td>
                </tr>
                <tr>
                    <td>&nbsp;<?php db_get_text($lang, 'all', 'customer_password'); ?>:</td><td><input type="password" name="password" /></td>
                </tr>
                <tr>
                    <td></td><td><input type="submit" value="<?php db_get_text($lang, 'all', 'go_button'); ?>" /></td>
                </tr>
                <?php 
			                 if(!isset($_GET['id_err'])){?>
			           <tr>
			                <td></td>
					<td><a href='Recover.php?forget_password=1'
											style='text-decoration: underline;'><?php db_get_text($lang, 'all', 'customer_i_forget_my_password'); ?></a>
					</td>
			            </tr>
			            <?php 
			            }
			                 else{  
			                      //CHECK IF AN ERROR WAS SEND
			                      if($_GET['id_err']==2){?>
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
			                      <?php if($_GET['id_err']==10){?>
			            <tr>
					<td></td>
					<td style="color: red;">*<?php echo db_get_text($lang, 'all', 'message_confirmation_mail'); ?>*</td>
				    </tr>
			                      <?php }?>
			                     <?php if(1){
			                     //IN CASE IF THERE IS OVER ERROR PLEASE PUT THIS HERE, AND SMILE :)
			                     ?>
			                     
			                     <?php }
			                                 }
			            ?>
                 </form>
            </table>
             <?php }?>

</div>
<script language="javascript">
function toggle() {
        var ele = document.getElementById("InvoicingDetailsTable");
        var ele2 = document.getElementById("SeparateInvoicingDetails");
        var flag = document.getElementById("same_invoice_address");
        var text = document.getElementById("displayText");
        if(ele.style.display == "block") {
                ele.style.display = "none";
                ele2.style.display = "block";
                flag.value = "1";
                text.innerHTML = "-> <?php db_get_text($lang, 'store', 'checkout_different_invoice_address'); ?>";
        }
        else {
                ele.style.display = "block";
                ele2.style.display = "none";
                flag.value = "0";
                text.innerHTML = "&nbsp;&nbsp;-> <?php db_get_text($lang, 'store', 'checkout_different_use_shipping_address'); ?>";
        }
}

function setSameAddressFlag() {

}

function copy() {
      var ship_firstname = document.getElementById("txtShippingFirstName");
      var inv_firstname = document.getElementById("txtPaymentFirstName"); 
      inv_firstname.value = ship_firstname.value;

      var ship_lastname = document.getElementById("txtShippingLastName");
      var inv_lastname = document.getElementById("txtPaymentLastName"); 
      inv_lastname.value = ship_lastname.value;

      var ship_address1 = document.getElementById("txtShippingAddress1");
      var inv_address1 = document.getElementById("txtPaymentAddress1"); 
      inv_address1.value = ship_address1.value;

      var ship_address2 = document.getElementById("txtShippingAddress2");
      var inv_address2 = document.getElementById("txtPaymentAddress2"); 
      inv_address2.value = ship_address2.value;
}
</script>

