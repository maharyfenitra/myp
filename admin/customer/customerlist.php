<?php
require_once '../../customer/library/admin_customer.php';
$admin=new AdminCustomer();

$tri=1;
if(isset($_GET['tri'])){
$tri=$_GET['tri'];
}
$list=$admin->getAllCustomer($tri);

            $n=count($list);?>
            <select class="box" id="mySelect" onchange="myFunction()" value="<?php echo $tri;?>">
               <option value="<?php echo $tri;?>">actual</option>
               <option value="1">ID</option>
               <option value="2">Name</option>
               <option value="3">Last update</option>
               <option value="4">Date of account creation</option>
            </select>
            <script>
            function myFunction() {
                   var x = document.getElementById("mySelect").value;
                   document.location = "index.php?tri="+x;
                       }
             </script>

<table width="100%" border="0" align="center" cellpadding="2" class="text"
	cellspacing="1" >
	<tr id="listTableHeader">
		<td>Number</td>
		<td>Mail</td>
		<td>Last name</td>
		<td>First name</td>
		<td>Last update</td>
		<td>Creation account</td>
		<td>Type</td>
		<td>Detail</td>
		<td>Active</td>
		
		
		
	</tr>
	<?php 
	
	$i=0;
	

	foreach($list as $tbl){
	$row="row1";	
	if ($i%2==0)
	$row="row2";
	$i++;
		?>
		
	<tr class="<?php echo $row ?>">
		
                <td ><?php echo $tbl['cu_name']?></td>
                <td><?php echo $tbl['cu_account_email']?></td>
                <td><?php echo $tbl['cu_shipping_last_name']?></td>
                <td><?php echo $tbl['cu_shipping_first_name']?></td>
                <td><?php 
                
                $date = new DateTime($tbl['cu_last_update']);
				              echo $date->format('d-m-Y');
                
                ?></td>
                <td><?php 
                $date = new DateTime($tbl['cu_creation_date']);
				              echo $date->format('d-m-Y');
                
                //echo $tbl['cu_creation_date']?></td>
                <td><?php echo $admin->getLabelTypeFor($tbl['cu_type']);?></td>
		<td><a href="index.php?view=detail&&name__=<?php echo $tbl['cu_name'];?>">Detail</a>
		
		
		</td>
		
		<td align="right"><?php echo  $tbl['active'];?>
		
		
		</td>
		
	</tr>
	<?php
	}
	?>
</table>

