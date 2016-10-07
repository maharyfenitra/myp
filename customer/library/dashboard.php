<?php 
include 'customer.php';
include 'product_infos.php';
include 'admin_customer';

class Dashboard{
private $name;
private $customer;
private $type;
private $product;
private $normalType;
       function __construct($name){
           $this->name=$name;
           $this->customer=new Customer($name,null,null,null);
           $this->type=customer->getType();
           $this->product=new ProductInfo();
           $this->normalType = 1;
     }
       function setType($name){
           $this->name=$name;
           $this->customer=new Customer($name,null,null,null);
           $this->type=customer->getType();
       }
       function getPriceFor($pdid){
            $this->product->setPdid($pdid);
            return $this->product->getPriceWhereCustomerIs($this->type);
       }
       function getNormalPriceFor($pdid){
            $this->product->setPdid($pdid);
            return $this->product->getPriceWhereCustomerIs($this->normalType);
       }   
  }

?>
