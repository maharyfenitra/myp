<?php 

include '../../customer/library/admin_customer.php';
include '../../customer/library/product_info.php';
//include 'mp.php';
//$mp = new MP();
$admin = new AdminCustomer();
$alltype=$admin->getAllType();
$product=new ProductInfo();


if(isset($_GET['delete__'])){
	$admin->deleteType($_GET['delete__']);
	
	header('location:/admin/type/');
	return;
}
if(isset($_GET['addtype'])){
	$admin->addNewType($_GET['addtype']);
	header('location:/admin/type/');
	return;
}
if(isset($_POST['update_label'])){
    echo $_POST['update_label']." ".$_POST['val'];
    $admin->updateLabel($_POST['update_label'],$_POST['val']);
}


if(isset($_POST['update_description'])){
    echo $_POST['update_description']." ".$_POST['val'];
    $admin->updateDescription($_POST['update_description'],$_POST['val']);
}










?>
