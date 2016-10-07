<?php

if (!defined('WEB_ROOT')) {

	exit;

}



$od_reference = '';
$orderId = '';
if (!isset($_GET['oid']) || (int)$_GET['oid'] <= 0) {
	if (isset($_GET['od_reference'])) {
		$get_od_reference = $_GET['od_reference'];
		$sql = "SELECT od_id FROM tbl_order WHERE od_reference='$get_od_reference'";
		$result = dbQuery($sql);
		extract(dbFetchAssoc($result));
		$orderId = $od_id;
	} else {
		header('Location: index.php');
	}
} else {
	$orderId = (int)$_GET['oid'];
}
// get ordered items

$sql = "SELECT oi_pd_reference, oi_pi_flavor, oi_price, oi_qty

	    FROM tbl_order_item oi 

		WHERE oi.od_id = $orderId

		ORDER BY od_id ASC";



$result = dbQuery($sql);

$orderedItem = array();

while ($row = dbFetchAssoc($result)) {

	$orderedItem[] = $row;

}





// get order information

$sql = "SELECT od_date, od_last_update, od_payment_status, od_shipping_first_name, od_shipping_last_name, od_shipping_address1, 
               od_shipping_phone, od_shipping_email, od_shipping_state, od_shipping_city,
               od_shipping_zip, od_shipping_country, od_shipping_cost, od_shipping_mode,od_shipping_weight,
			   od_payment_first_name, od_payment_last_name, od_payment_address1, 
			   od_payment_state, od_payment_city , od_payment_zip, od_reference, od_memo

	    FROM tbl_order 

		WHERE od_id = $orderId";



$result = dbQuery($sql);

extract(dbFetchAssoc($result));



$orderStatus = array('New', 'Payment_Pending', 'Paid', 'Shipped', 'Completed', 'Cancelled');

$orderOption = '';

foreach ($orderStatus as $status) {

	$orderOption .= "<option value=\"$status\"";

	if ($status == $od_payment_status) {

		$orderOption .= " selected";

	}

	

	$orderOption .= ">$status</option>\r\n";

}

?>

<p>&nbsp;</p>

<form action="" method="get" name="frmOrder" id="frmOrder">

    <table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">

        <tr> 

            <td colspan="2" align="center" id="infoTableHeader">Order Detail</td>

        </tr>

        <tr> 

            <td width="150" class="label">Order Number / Reference</td>

            <td class="content"><?php echo $orderId;?> / <?php echo $od_reference;?></td>

        </tr>
        
        <tr> 

            <td width="150" class="label">Order Date</td>

            <td class="content"><?php echo $od_date; ?></td>

        </tr>

        <tr> 

            <td width="150" class="label">Last Update</td>

            <td class="content"><?php echo $od_last_update; ?></td>

        </tr>

        <tr> 

            <td class="label">Status</td>

            <td class="content"> <select name="cboOrderStatus" id="cboOrderStatus" class="box">

                    <?php echo $orderOption; ?> </select> <input name="btnModify" type="button" id="btnModify" value="Modify Status" class="box" onClick="modifyOrderStatus(<?php echo $orderId; ?>);"></td>

        </tr>

    </table>

</form>

<p>&nbsp;</p>

<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">

    <tr id="infoTableHeader"> 

        <td colspan="3">Ordered Item</td>

    </tr>

    <tr align="center" class="label"> 

        <td>Item</td>

        <td>Flavor</td>

        <td>Unit Price</td>

        <td>Total</td>

    </tr>

    <?php

$numItem  = count($orderedItem);

$subTotal = 0;

for ($i = 0; $i < $numItem; $i++) {

	extract($orderedItem[$i]);

	$subTotal += $oi_price * $oi_qty;

?>

    <tr class="content"> 

        <td><?php echo "$oi_qty x $oi_pd_reference"; ?></td>

        <td><?php echo "$oi_pi_flavor"; ?></td>

        <td align="right"><?php echo displayAmount($oi_price); ?></td>

        <td align="right"><?php echo displayAmount($oi_qty * $oi_price); ?></td> 

    </tr>

    <?php

}

?>

    <tr class="content"> 

        <td colspan="3" align="right">Sub-total</td>

        <td align="right"><?php echo displayAmount($subTotal); ?></td>

    </tr>

    <tr class="content"> 

        <td colspan="3" align="right"><?php echo $od_shipping_mode; ?>&nbsp;Shipping&nbsp;<?php echo $od_shipping_weight; echo "g ";?></td>

        <td align="right"><?php echo displayAmount($od_shipping_cost); ?></td>

    </tr>

    <tr class="content"> 

        <td colspan="3" align="right">Total</td>

        <td align="right"><?php echo displayAmount($od_shipping_cost + $subTotal); ?></td>

    </tr>

</table>

<p>&nbsp;</p>

<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">

    <tr id="infoTableHeader"> 

        <td colspan="2">Shipping Information</td>

    </tr>

    <tr> 

        <td width="150" class="label">First Name</td>

        <td class="content"><?php echo $od_shipping_first_name; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">Last Name</td>

        <td class="content"><?php echo $od_shipping_last_name; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">Address1</td>

        <td class="content"><?php echo $od_shipping_address1; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">Province / State</td>

        <td class="content"><?php echo $od_shipping_state; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">City</td>

        <td class="content"><?php echo $od_shipping_city; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">Postal Code</td>

        <td class="content"><?php echo $od_shipping_zip; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">Country</td>

        <td class="content"><?php echo $od_shipping_country; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">Phone Number</td>

        <td class="content"><?php echo $od_shipping_phone; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">Email / State</td>

        <td class="content"><?php echo $od_shipping_email; ?> </td>

    </tr>

</table>

<p>&nbsp;</p>

<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">

    <tr id="infoTableHeader"> 

        <td colspan="2">Payment Information</td>

    </tr>

    <tr> 

        <td width="150" class="label">First Name</td>

        <td class="content"><?php echo $od_payment_first_name; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">Last Name</td>

        <td class="content"><?php echo $od_payment_last_name; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">Address1</td>

        <td class="content"><?php echo $od_payment_address1; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">Province / State</td>

        <td class="content"><?php echo $od_payment_state; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">City</td>

        <td class="content"><?php echo $od_payment_city; ?> </td>

    </tr>

    <tr> 

        <td width="150" class="label">Postal Code</td>

        <td class="content"><?php echo $od_payment_zip; ?> </td>

    </tr>

</table>

<p>&nbsp;</p>

<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">

    <tr id="infoTableHeader"> 

        <td colspan="2">Buyer's Memo</td>

    </tr>

    <tr> 

        <td colspan="2" class="label"><?php echo nl2br($od_memo); ?> </td>

    </tr>

</table>

<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">

    <tr id="infoTableHeader">

        <td colspan="2">Links</td>

    </tr>

    <tr>
        <td colspan="2" class="label">
	<strong>WITH CHIP RENTAL</strong><br>
	<?php echo "http://www.eo-speedracing.com/static7/inscription-en-ligne-renseignements-coureur?oid=";
	echo urlencode($orderId);
	echo "&nom=";
	echo urlencode($od_shipping_last_name);
	echo "&prenom=";
	echo urlencode($od_shipping_first_name);
	echo "&adresse=";
	echo urlencode($od_shipping_address1);
	echo "&cp=";
	echo urlencode($od_shipping_zip);
        echo "&ville=";
        echo urlencode($od_shipping_city);
        echo "&pays=";
        echo urlencode($od_shipping_country);
        echo "&email=";
        echo urlencode($od_shipping_email);
	?>
        </td>
    </tr>

    <tr>
        <td colspan="2" class="label">
        <strong>NO CHIP RENTAL - ask for chip number !</strong><br>
        <?php echo "http://www.eo-speedracing.com/static7/inscription-en-ligne-renseignements-coureur?oid=";
        echo urlencode($orderId);
        echo "&nom=";
        echo urlencode($od_shipping_last_name);
        echo "&prenom=";
        echo urlencode($od_shipping_first_name);
        echo "&adresse=";
        echo urlencode($od_shipping_address1);
        echo "&cp=";
        echo urlencode($od_shipping_zip);
        echo "&ville=";
        echo urlencode($od_shipping_city);
        echo "&pays=";
        echo urlencode($od_shipping_country);
        echo "&email=";
        echo urlencode($od_shipping_email);
	echo "&askchip=1";
        ?>
        </td>
    </tr>


    <tr>
        <td colspan="2" class="label">
	<strong>Additional skaters WITH CHIP RENTAL</strong><br>
	<?php echo "http://www.eo-speedracing.com/static7/inscription-en-ligne-renseignements-coureur?oid="; 
	echo urlencode($orderId);
	?>
        </td>
    </tr>

    <tr>
        <td colspan="2" class="label">
        <strong>Additional skaters NO CHIP RENTAL - ask for chip number !</strong><br>
        <?php echo "http://www.eo-speedracing.com/static7/inscription-en-ligne-renseignements-coureur?oid=";
        echo urlencode($orderId);
	echo "&askchip=1";
        ?>
        </td>
    </tr>
	

</table>


<p>&nbsp;</p>

<p align="center"> 

    <input name="btnBack" type="button" id="btnBack" value="Back" class="box" onClick="window.history.back();">

</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

