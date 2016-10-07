<?php 

include '../../customer/library/admin_customer.php';
include '../../customer/library/product_info.php';
include 'mp.php';
$mp = new MP();
$admin = new AdminCustomer();
$alltype=$admin->getAllType();
$product=new ProductInfo();
if(isset($_GET['delete__'])){
	$admin->deleteType($_GET['delete__']);
	
	header('location:/admin/product/');
	return;
}
if(isset($_GET['addtype'])){
	$admin->addNewType($_GET['addtype']);
	header('location:/admin/product/');
	return;
}
if(isset($_POST["update_price_by_ajax"])){
		print_r($_POST);
		$product->setPdid($_POST['pd_id']);
		$product->setPrice($_POST['tid'],$_POST['val']);
		die();

}
$product->setPdid($_GET['pd_id']);
if(isset($_GET['origine_url'])){
	$url= $_GET['origine_url'];
	header('location:index.php?view=modify&productId='.$_GET['pdid']);
	$mp->deleteImage($_GET['pdid'],$_GET['delete_image']);
	
}


if(isset($_GET['update_price'])){
	
	
	$i=0;
	//print_r($_GET);
	foreach($alltype as $type){
		$i++;
		//$new_value='V_'.$i;
		$new_value='V_'.$i;
		
		$id=$admin->getIdTypeFor($type['label']);
		
		$product->setPrice($id,$_GET[$new_value]);
		
	
         }
         $catid='';
            if(isset($_GET['catId'])&&$_GET['catId']!=''){
                   $catid="?catId=".$_GET['catId'];
              }
       header('location:index.php'.$catid);
}
?>
