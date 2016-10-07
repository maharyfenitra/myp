<?php 
require_once 'customer.php';
require_once 'admin_customer.php';

$b=new Customer("Tom",null,null,null);
$a=new AdminCustomer();
//$a->addNewType("Type 1");
echo $a->getLabelTypeFor(1);
?>
