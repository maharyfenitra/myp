<?php 
session_start();
require_once '../../customer/library/customer.php';
require_once '../../customer/library/admin_customer.php';
//echo "name__=".$_GET["name__"]." n=".$_POST["name"]." m=".$_POST["mail"]." l=".$_POST["licence"];

if(isset($_POST["key"])&&$_POST["key"]==1){
	$admin=new AdminCustomer();

	$customer=new Customer($_POST["name__"],null,null,null);
	//$customer->setName($_POST["name"]);
	$customer->setType($admin->getIdTypeFor($_POST["type"]));
	$customer->setMail($_POST["mail"]);
	$customer->setPassword($_POST["password"]);
	$customer->setLicences($_POST["licence"]);
	$customer->setActive($_POST["active"]);
	$customer->setZip($_POST["zip"]);
	$customer->setFirstName($_POST["firstname"]);
	$customer->setLastName($_POST["lastname"]);
	$customer->setCountry($_POST["country"]);
	$customer->setPhone($_POST["phone"]);
	$customer->setBirthday($_POST["birthday"]);
	$customer->setAdress($_POST["adress"]);
	$customer->setClub($_POST["club"]);
	
	
	header('location:index.php');
}
if(isset($_POST["key"])&&$_POST["key"]==2){

	$admin=new AdminCustomer();
	$customer=new Customer($_SESSION['session_name'],null,null,null);
	//$customer->setName($_POST["name"]);
	$customer->setMail($_POST["mail"]);
        
	$customer->setPassword($_POST["password"]);
	//$_SESSION['session_name']=$_POST["name"];
        $customer->setLicences($_POST['password']);
       $customer->setAdress($_POST['adress']);
       $customer->setCountry($_POST['billing_country']);
       $customer->setFirstName($_POST['firstname']);
       $customer->setLastName($_POST['lastname']);
       $customer->setClub($_POST['club']);
       $customer->setZip($_POST['billing_zip']);
       $customer->setCity($_POST['billing_city']); 
       $customer->setPhone($_POST['phone']);
       $date = new DateTime($_POST['birthday']);

      // $originalDate = "2010-03-21";
       
       $customer->setBirthday(date('Y-m-d', strtotime($_POST['birthday'])));
	header('location:../../Account.php');

}
if(isset($_GET['key'])&&$_GET['key']==3){
	$admin=new AdminCustomer();
	$admin->deleteCustomer($_GET['name__']);
	header('location:index.php');
}

?>
