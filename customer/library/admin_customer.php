<?php

require_once 'customer.php';
require_once 'include/db.php';
class AdminCustomer{

	function __construct(){

	}
	function updateLabel($id,$label){
		$label = mysql_real_escape_string($label);
		$sql = "update tbl_customer_type set label = '$label' where id='$id'";
		echo $sql;
		dbQuery_($sql);
	}
	function updateDescription($id,$description){
		$description = mysql_real_escape_string($description);
		$sql = "update tbl_customer_type set description = '$description' where id='$id'";
		echo $sql;
		dbQuery_($sql);
	}

	function setTypeCustomer($name,$type){
		$b = new Customer($name,null,null,null);
		$b->setType($type);
	}
	function addNewType($label){
		$sql="INSERT tbl_customer_type (label) VALUES ('$label')";
		dbQuery_($sql);
	}
	function deleteType($id){
		$sql="DELETE FROM `tbl_product_price` WHERE `type_id` =".$id;
		
		dbQuery_($sql);
		
		$sql="DELETE FROM `tbl_customer_type` WHERE `id` =".$id;
		dbQuery_($sql);
		
	}
	function deleteCustomer($name){
		$sql="DELETE FROM `tbl_customer` WHERE `cu_name` ='".$name."'";
		dbQuery_($sql);
	}
	function getIdTypeFor($label){
		$sql="SELECT id FROM tbl_customer_type WHERE label='".$label."'";
		$rang=mysql_fetch_array(dbQuery_($sql));
		return $rang['id'];
	}
	function getAllType(){
		$sql="SELECT * FROM tbl_customer_type";
		$i=0;
		$tbl=array();
		$resultat=dbQuery_($sql);
		while($rang =mysql_fetch_array($resultat)){
			$tbl[$i] = array(
					"label"=>$rang['label'],
					"id" =>$rang['id'],
					"description" =>$rang['description'],

			);
			// echo $rang['cu_name'];
			$i++;
		}
		return $tbl;
	}
	function getLabelTypeFor($id){
		$sql="SELECT label FROM tbl_customer_type WHERE id='".$id."'";
		$rang=mysql_fetch_array(dbQuery_($sql));
		return $rang['label'];
	}
	function clonePrice($pid,$npid){
	$all=$this->getAllType();
	$productinfo_1= new ProductInfo();
	$productinfo_1->setPdid($pid);
	$productinfo_2= new ProductInfo();
	$productinfo_2->setPdid($npid);
	
	foreach($all as $a){
	
	$p=$productinfo_1->getPrice($a['id']);
	       $productinfo_2->setPrice($a['id'],$p);
	
	   }
	
	}
	function cloneImage($pid,$npid){
	
	$sql="select * from tbl_product_image where pd_id='$pid'";
	$resultat=dbQuery_($sql);
	 while($rang =mysql_fetch_array($resultat)){
	    $im=$rang['pd_image'];
	    $sql_1="insert into tbl_product_image (pd_id,pd_image) values ('$npid','$im')";
	    dbQuery_($sql_1);
	     }
	}
	function getAllCustomer($key=false){
	
	       if(!$key||$key==1){
	           $tri='cu_name';
	       }
	       if($key==2){
	           $tri='cu_shipping_last_name';
	       }
	       if($key==3){
	           $tri='cu_last_update';
	       }
	       if($key==4){
	           $tri='cu_creation_date';
	       }
		$sql="SELECT * FROM tbl_customer ORDER BY $tri DESC";
		
		$tbl=array();
		$resultat=dbQuery_($sql);
		while($rang =mysql_fetch_array($resultat)){
			$tbl[]=$rang;
		}
		return $tbl;
	}
}

?>
