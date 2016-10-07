<?php
require_once 'php_includes/config.php';
require_once '../../php_includes/db.php';
require_once '../library/customer.php';
require_once '../library/mail_confirmation_compte.php';
$lang = $_GET['lang'];
                    
if(isset($_POST['key'])){

if($_POST['key']==1){

//echo $_POST['firstname'].' '.$_POST['lastname'].' '.$_POST['password'].' '.$_POST['adress'].' '.$_POST['club'].' select='.$_POST['billing_country'].' phone='.$_POST['phone'].' billying city'
//.$_POST['billing_city'].' '.$_POST['billing_zip'];
if(isset($_POST['mail'])&&isset($_POST['password'])&&!existCompte($_POST['mail'])) {
          if(($_POST['mail'] !== '')) {
                    $lang = $_GET['lang'];
                    
                    $ex = new Customer('AUTO',$_POST['mail'],$_POST['password'],'');
                    $ex->setLicences($_POST['license']);
                    $ex->setAdress($_POST['adress']);
                    $ex->setCountry($_POST['billing_country']);
                    $ex->setFirstName($_POST['firstname']);
                    $ex->setLastName($_POST['lastname']);
                    $ex->setClub($_POST['club']);
                    $ex->setZip($_POST['billing_zip']);
                    $ex->setCity($_POST['billing_city']); 
                    $ex->setPhone($_POST['phone']);
                    $ex->setBirthday(date('Y-m-d', strtotime($_POST['birthday'])));
                    $v= new Mail_Confirmation_Compte($_POST['mail'],getShopConfig()['email'],getShopConfig()['name'],$lang);
                     echo 0;
                                     } else {
                                    echo  1;
                                          }
                                   } else {
                          echo 2;
                          }
  }
}
 
 //json_encode(['reponse' => $reponse]);
?>
