<?php 
include '../../php_includes/db.php';
class MP{
	
	
	function __construct(){
	
	}
	 function deleteImage($pdid,$pd_name){
		$sql="DELETE FROM `tbl_product_image` WHERE `pd_id` ='".$pdid."' AND `pd_image`='".$pd_name."'";
		dbQuery($sql);
	    unlink("../../image_uploaded/".$pd_name); 
	}
}

?>