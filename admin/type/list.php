<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php_includes/product-functions.php';

include '../../customer/library/admin_customer.php';
  $productinfo= new ProductInfo();
  $admin = new AdminCustomer();
  $alltype=$admin->getAllType();
  $ref = $productinfo->getPDReference();
  
?>

<p>&nbsp;</p>

<table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
	<tr>
		<td align="left"> <input name="btnAddCustomerType" type="button" id="btnAddCustomerType" value="Add new Customer Type" class="box" onClick="addType()">
		</td>
	</tr>
</table>
<br>
  
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
	<tr id="listTableHeader" align="center">
		<td>Customer Type label</td>
    <td>Description</td>
		<td>Delete</td></tr>
<?php
	$i = 0;
	foreach($alltype as $type){

                if ($i%2) {
                        $class = 'row1';
                } else {
                        $class = 'row2';
                }

                $i += 1;
?>
		<tr class="<?php echo $class; ?>"><td class='input_switch lbl' alt='<?php echo $admin->getIdTypeFor($type["label"]);?>'><?php echo $type['label'];?></td><td class='input_switch dsc' alt='<?php echo $admin->getIdTypeFor($type["label"]);?>'><?php echo $type['description'];?></td><td><a href="#goto<?php echo $admin->getIdTypeFor($type['label']);?>" onclick="javascript:if(confirm('This will erase all prices associated to this customer Type. Are you really ure you want to delete it?')) location.href = 'processType.php?delete__=<?php echo $admin->getIdTypeFor($type['label']);?>';">Delete</a></td></tr>

<?php 
	}
?>

</table>

<script src="type.js">

</script>

