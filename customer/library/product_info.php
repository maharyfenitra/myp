<?php
include_once  'include/db.php';
class ProductInfo{
private $pdid;
  function __construct(){
   
 }


  function getPriceWhereCustomerIs($id){
            $sql="select * FROM price WHERE pd_id='".$this->pdid."' AND type_id='".$id."'";
            $rang=mysql_fetch_array(dbQuery_($sql));
            return $rang['price'];
    }

  function setPdid($pdid){
   $this->pdid=$pdid;
  }
  
  function getPrice($type){
  	$sql="select price FROM tbl_product_price WHERE pd_id='".$this->pdid."' 
  	
  	AND type_id='".$type."'";
  	$rang=mysql_fetch_array(dbQuery_($sql));
  	//echo $this->pdid." ".$type;
  	return $rang['price'];   
  }
  function getPDReference(){
  	$sql="select pd_reference FROM tbl_product WHERE pd_id='".$this->pdid."'";
  	$rang=mysql_fetch_array(dbQuery_($sql));
  	//echo $this->pdid." ".$type;
  	return $rang['pd_reference'];   
  }
  
  function upDatePrice($type,$price){
  	$sql="UPDATE `tbl_product_price` SET `price`='".$price."' WHERE `type_id`='".$type."' AND pd_id='".$this->pdid."'";
  	dbQuery_($sql);
  }
  function addPrice($type,$price){
  	$sql="INSERT tbl_product_price (pd_id, type_id,price)
  	VALUES ('$this->pdid', '$type','$price')";
  	dbQuery_($sql);
  }
  function setPrice($type,$price){
  	if($this->getPrice($type)!=''){
  		$this->upDatePrice($type,$price);
  	}else{
  		$this->addPrice($type,$price);
  	}
  }
}
 ?>
