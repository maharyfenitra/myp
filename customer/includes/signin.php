<?php
require_once '../library/customer.php';
require_once '../library/checker.php';
session_start();
$compte=$_POST['compte'];
$password=$_POST['password'];
$check=new Checker();
$session_name=null;
if(!existCompte($compte)){//CHECK IF COMPTE EXIST

        if (isSet($_GET['step'])) {
  		$ss=$_GET['step'];
    	        
    		header("location:../../Store.php?step=$ss&&id_err=3");
   		
   		 return;
	         }
	
	header('location:../../Customer.php?id_err=3&&url='.$_POST['url']);
	
	return;
}
if($check->compteValide($compte)==0){//CHECK IF COMPTE VALIDE

        if (isSet($_GET['step'])) {
  		$ss=$_GET['step'];
    	        
    		header("location:../../Store.php?step=$ss&&id_err=2");
   		
   		 return;
	         }
	
	header('location:../../Customer.php?id_err=2&&url='.$_POST['url']);
	
	return;
}

if($check->singIn($compte,$password)){//CHECK IF PASWORD IS GOOD VALIDE
	
	if($check->isMail($compte)){
		
		$customer=new Customer(null,$compte,null,null);
		
		$session_name=$customer->getName();
	   
	    } else {
		
		$session_name=$compte;
	   }
	
	        $_SESSION['session_name']=$session_name;
      
        
	   if (isSet($_GET['step'])) {
  		
  		$ss=$_GET['step'];
    	
    		header("location:../../Store.php?step=$ss");
   		
   		return;
	}
	
	header('location:/Store.php');
} else //DO THIS WHEN PASSWORD IS WRONG
{
 	
  	if (isSet($_GET['step'])) {
  		$ss=$_GET['step'];
    	
    		header("location:../../Store.php?step=$ss&&id_err=1");
   		
   		return;
	}
    	
    	header('location:../../Customer.php?id_err=1');
    }
?>
