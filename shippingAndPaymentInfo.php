<?php

if (!defined('WEB_ROOT')

    || !isset($_POST['step']) || (int)$_POST['step'] != 1) {

	exit;

}



$errorMessage = '&nbsp;';

?>

<script language="JavaScript" type="text/javascript" src="library/checkout.js"></script>


<table width="550" border="0" align="center" cellpadding="10" cellspacing="0">

    <tr> 
        <td align="center" ><font color="black" size="4">Step 1 Of 3 : Enter Shipping And Invoicing Information</font> </td>
    </tr>

</table>

<p id="errorMessage"><marquee direction="left" scrolldelay="0" loop="infinite" scrollamount="6"><font color="red" size="4"><?php echo $errorMessage; ?></font></marquee></p>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>?step=2" method="post" name="frmCheckout" id="frmCheckout" onSubmit="return checkShippingAndPaymentInfo();">

<div id="ShippingDetailsTable" >
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">

        <tr class="entryTableHeader"> 
            <td colspan="2"><font color="black" size="3">Shipping Information</font></td>
        </tr>

        <tr> 
            <td width="150" class="label">First Name</td>
            <td class="content"><input name="txtShippingFirstName" type="text" class="box" id="txtShippingFirstName" size="30" maxlength="50"></td>
        </tr>

        <tr> 
            <td width="150" class="label">Last Name</td>
            <td class="content"><input name="txtShippingLastName" type="text" class="box" id="txtShippingLastName" size="30" maxlength="50"></td>
        </tr>

        <tr> 
            <td width="150" class="label">Address1</td>
            <td class="content"><input name="txtShippingAddress1" type="textarea" class="box" id="txtShippingAddress1" size="50" maxlength="100"></td>
        </tr>

<!--        <tr> 
            <td width="150" class="label">Address2</td>
            <td class="content"><input name="txtShippingAddress2" type="text" class="box" id="txtShippingAddress2" size="50" maxlength="100"></td>
        </tr>
-->
        <tr> 
            <td width="150" class="label">Phone Number</td>
            <td class="content"><input name="txtShippingPhone" type="text" class="box" id="txtShippingPhone" size="30" maxlength="32"></td>
        </tr>

        <tr> 
            <td width="150" class="label">City</td>
            <td class="content"><input name="txtShippingCity" type="text" class="box" id="txtShippingCity" size="30" maxlength="32"></td>
        </tr>

        <tr> 
            <td width="150" class="label">Zip Code - State</td>
            <td class="content">
		<input name="txtShippingPostalCode" type="text" class="box" id="txtShippingPostalCode" size="10" maxlength="10">
		<input name="txtShippingState" type="text" class="box" id="txtShippingState" size="30" maxlength="32">
            </td>
        </tr>


    </table>
</div>

    <p>&nbsp;</p>

<script language="javascript">
function toggle() {
        var ele = document.getElementById("InvoicingDetailsTable");
        var ele2 = document.getElementById("SeparateInvoicingDetails");
        var text = document.getElementById("displayText");
        if(ele.style.display == "block") {
                ele.style.display = "none";
                ele2.style.display = "block";
                text.innerHTML = "Different Invoicing Address";
        }
        else {
                ele.style.display = "block";
                ele2.style.display = "none";
                text.innerHTML = "Same Invoicing Address";
        }
}
</script>

<div id="SeparateInvoicingDetails">
	<table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
	        <tr class="entryTableHeader"> 
			<td width="150"><font color="black" size="3">Invoicing Information</font></td>
			<td><a id="displayText" href="javascript:toggle();">Different Invoicing Address</a></td>
		</tr>
	</table>
</div>

<div id="InvoicingDetailsTable" style="display: none">
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">

        <tr class="entryTableHeader"> 
            <td width="150"><font color="black" size="3">Invoicing Information</font></td>
		<td><a id="displayText2" href="javascript:toggle();">Same as Shipping</a></td>
<!--            <td><input type="checkbox" name="chkSame" id="chkSame" value="checkbox" onClick="setPaymentInfo(this.checked);"> 
                <label for="chkSame" style="cursor:pointer">Same as shipping information</label></td>
-->        </tr>

        <tr> 
            <td width="150" class="label">First Name</td>
            <td class="content"><input name="txtPaymentFirstName" type="text" class="box" id="txtPaymentFirstName" size="30" maxlength="50"></td>
        </tr>

        <tr> 
            <td width="150" class="label">Last Name</td>
            <td class="content"><input name="txtPaymentLastName" type="text" class="box" id="txtPaymentLastName" size="30" maxlength="50"></td>
        </tr>

        <tr> 
            <td width="150" class="label">Address1</td>
            <td class="content"><input name="txtPaymentAddress1" type="text" class="box" id="txtPaymentAddress1" size="50" maxlength="100"></td>
        </tr>

        <tr> 
            <td width="150" class="label">Address2</td>
            <td class="content"><input name="txtPaymentAddress2" type="text" class="box" id="txtPaymentAddress2" size="50" maxlength="100"></td>
        </tr>

        <tr> 
            <td width="150" class="label">Phone Number</td>
            <td class="content"><input name="txtPaymentPhone" type="text" class="box" id="txtPaymentPhone" size="30" maxlength="32"></td>
        </tr>

        <tr> 
            <td width="150" class="label">Province / State</td>
            <td class="content"><input name="txtPaymentState" type="text" class="box" id="txtPaymentState" size="30" maxlength="32"></td>
        </tr>

        <tr> 
            <td width="150" class="label">City</td>
            <td class="content"><input name="txtPaymentCity" type="text" class="box" id="txtPaymentCity" size="30" maxlength="32"></td>
        </tr>

        <tr> 
            <td width="150" class="label">Postal / Zip Code</td>
            <td class="content"><input name="txtPaymentPostalCode" type="text" class="box" id="txtPaymentPostalCode" size="10" maxlength="10"></td>
        </tr>

    </table>
</div>

    <p>&nbsp;</p>


    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">

      <tr>
        <td valign="top" width="150" class="entryTableHeader"><font color="black" size="3">Payment Method</font></td>

        <td class="content" valign="top">
	        <table>
			<tr><td>
				<input name="optPayment" type="radio" id="optPaypal" value="paypal" checked="checked" />
       		 		<label for="optPaypal" style="cursor:pointer">Paypal</label>
			</td></tr>

			<tr><td>
			        <input name="optPayment" type="radio" id="optCod" value="cod" />
			        <label for="optCod" style="cursor:pointer">Cash on Delivery</label></td>
			</td></tr>

			<tr><td>
			        <input name="optPayment" type="radio" id="optCC" value="creditcard" />
       				<label for="optCC" style="cursor:pointer">Credit Card</label></td>
			</td></tr>
		</table>
	</td>
      </tr>

    </table>

    <p>&nbsp;</p>

    <p align="center"> 

        <input class="box" name="btnStep1" type="submit" id="btnStep1" value="Proceed &gt;&gt;">

    </p>

