<?php 
include_once  'include/db.php';
require_once 'customer.php';

class Checker{
 function __construct(){

  }
 function singIn($id,$password){
       if($this->isMail($id)){
              return $this->singInWhithMail($id,$password);
        }
        else{
              return $this->singInWithName($id,$password);
        }
    }
    function compteValide($mail){
        $sql = "select * from tbl_customer where cu_account_email ='$mail'";
        $resultat = dbQuery_($sql);
        $r = mysql_fetch_array($resultat);
        if($r['active']==0||$r['active']==''&&$r['cu_account_email']==$mail){
              return 0;
        }
        return 1;
    
    }
 function isMail($mail){
    $reg = "#^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#";
 if(preg_match($reg,$mail))
    { 
     return true;
     }
else{
     return false;
    }
  }
 function singInWhithMail($mail,$password){
     $customer=new Customer(null,$mail,null,null);
     $sql="SELECT cu_account_password FROM tbl_customer WHERE cu_account_email='".$customer->getMail()."'";
     $resultat = dbQuery_($sql);
     $pass = mysql_fetch_array($resultat);
     if($pass['cu_account_password']!=$password){
             return false;
         }
      return true;
    }
  function singInWithName($name,$password){
     $customer=new Customer($name,null,null,null);
     $sql="SELECT cu_account_password FROM tbl_customer WHERE cu_name='".$customer->getName()."'";
     $resultat = dbQuery_($sql);
     $pass = mysql_fetch_array($resultat);
     if($pass['cu_account_password']!=$password){
             return false;
         }
      return true;
    }
}
?>
