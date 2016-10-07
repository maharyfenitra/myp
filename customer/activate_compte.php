<?php

    require_once '../php_includes/db.php';
    
    $query = "select * from tbl_customer";
    $re = dbQuery($query);
    $key = $_GET['key'];
    $mail='';
    while($rangs=mysql_fetch_array($re)){
    //md5($mail.$customer->getPassword());
    $key_= md5($rangs['cu_account_email'].$rangs['cu_account_password']);
    //echo $key."  ".$key_;
    if($key == $key_){
      // print_r($rangs);
       $query = "update tbl_customer set active ='1' where cu_account_email='".$rangs['cu_account_email']."'";
       dbQuery($query);
       $mail=$rangs['cu_account_email'];
      // echo $rangs['cu_account_email'];
       //echo "<br/>";
       }
    }
    header("location:../Customer.php?default_mail=$mail");
   // echo "YOUR COMPTE IS ACTIVATE";
?>
