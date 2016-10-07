<?php 
//include '../../customer/library/product_info.php';
include '../../customer/library/admin_customer.php';
  $productinfo= new ProductInfo();
  $productinfo->setPdid($_GET['pd_id']);
   $admin = new AdminCustomer();
  $alltype=$admin->getAllType();
  $ref = $productinfo->getPDReference()
  
?>
<h4><?php echo $ref;?></h4>
<form action='cycle.php' method="GET">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
<tr id="listTableHeader"><td >Type</td><td>Price</td><td>Delete</td></tr>
<?php 
$i=0;
foreach($alltype as $type){
  $i++;
  $new_value="V_".$i;
  $type__="t_".$i;
	?>
<tr><td width="200" name="t_<?php echo $i;?>" value='<?php echo $type['label']?>' class="label"><?php echo $type['label'];?></td><td>
<input type="text" name='V_<?php echo $i;?>' value='<?php echo $productinfo->getPrice($admin->getIdTypeFor($type['label']));?>' align="right"style="text-align:right;" class="box" /></td>
<td class="label"><a href="cycle.php?delete__=<?php echo $admin->getIdTypeFor($type['label']);?>&&pd_id=<?php echo $_GET['pd_id'];?>">delete</a></td>
</tr>

<?php }?>
<tr><td >
         <input type='hidden' name='pd_id' value='<?php echo $_GET['pd_id'];?>'/>
         <input type='hidden' name='count' value="<?php echo $i;?>"/>
         <input type='hidden' name='update_price' value="ok"/>
         <input type='submit' value='Valide' class="box"/></td><td></td><td></td></tr>
</table>

</form>

<input type='button' id='add' value='Add new type' class="box"/>
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
$(document).on('click', '#add', function() {
	var reponse = prompt("Please enter the new type", "");
	window.location="cycle.php?addtype="+reponse+"&&pd_id=<?php echo $_GET['pd_id'];?>";

})
</script>
