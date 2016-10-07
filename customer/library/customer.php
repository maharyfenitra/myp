<?php 
include_once  'include/db.php';

  class Customer{
private $id;
private $type;
private $name;
private $mail;
private $password;
private $licences;
private $adress;
private $club;
private $firstName;
private $lastname;
    function __construct($name,$mail,$password,$licences){
if($name!=null&&$mail!=null&&$password!=null&&$licences!=null){
    
              $sql="INSERT tbl_customer (cu_name, cu_account_email,cu_account_password,cu_licence)
                                                            VALUES ('DEFAULT', '$mail','$password','$licences')";
                                      dbQuery_($sql);
                                      $this->name=$name;
                                      $this->mail=$mail;
                                      $this->password=$password;
                                      $this->licences=$licences;
                                      $this->type=$this->getTypeWhenName();

               $sql="SELECT cu_name FROM tbl_customer WHERE cu_account_email='".$this->mail."'";
               $rang=mysql_fetch_array(dbQuery_($sql));
               $this->name= $rang['cu_name'];

                                                          }
if($name!=null&&$mail!=null&&$password!=null&&$licences==null){
              $sql="INSERT tbl_customer (cu_name, cu_account_email,cu_account_password)
                                                            VALUES ('DEFAULT', '$mail','$password')";
                                     dbQuery_($sql);
                                     $this->name=$name;
                                     $this->mail=$mail;
                                     $this->password=$password;
                                     $this->licences=$this->getLicencesWhenName();
                                     $this->type=$this->getTypeWhenName();

                 $sql="SELECT cu_name FROM tbl_customer WHERE cu_account_email='".$this->mail."'";
                 $rang=mysql_fetch_array(dbQuery_($sql));
                 $this->name= $rang['cu_name'];

                                                       }
if($name!=null&&$mail==null&&$password==null&&$licences==null){
          
           $this->name=$name;
           $this->mail= $this->getMailWhenName();
           $this->type=$this->getTypeWhenName();
           $this->licences=$this->getLicencesWhenName();
           $this->password=$this->getPasswordWhenName(); 

            $sql="SELECT cu_name FROM tbl_customer WHERE cu_account_email='".$this->mail."'";
                 $rang=mysql_fetch_array(dbQuery_($sql));
                 $this->name= $rang['cu_name'];

      }
if($name==null&&$mail!=null&&$password==null&&$licences==null){
          
           
           $this->mail= $mail;
           $this->name=$this->getNameWhenMail();
           $this->type=$this->getTypeWhenName();
           $this->licences=$this->getLicencesWhenName();
           $this->password=$this->getPasswordWhenName(); 

            $sql="SELECT cu_name FROM tbl_customer WHERE cu_account_email='".$this->mail."'";
                 $rang=mysql_fetch_array(dbQuery_($sql));
                 $this->name= $rang['cu_name'];

      }
   }

/* 
           ------------------------   GETTER     -------------------------
*/   function getCuName(){
      return $this->name;
       }
     function getNameWhenMail(){
      $sql="SELECT cu_name FROM tbl_customer WHERE cu_account_email='".$this->mail."'";
           $rang=mysql_fetch_array(dbQuery_($sql));

            return $rang['cu_name'];
       }
     function getMailWhenName(){
       $sql="SELECT cu_account_email FROM tbl_customer WHERE cu_name='".$this->name."'";
           $rang=mysql_fetch_array(dbQuery_($sql));

            return $rang['cu_account_email'];
       }
     function getLicencesWhenName(){
      $sql="SELECT cu_licence FROM tbl_customer WHERE cu_name='".$this->name."'";
           $rang=mysql_fetch_array(dbQuery_($sql));
            return $rang['cu_licence'];
       }
     function getTypeWhenName(){
      $sql="SELECT cu_type FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_type'];
           }
     function getPasswordWhenName(){
      $sql="SELECT cu_account_password FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_account_password'];
           }
     function getLicenceCountry(){
       $sql="SELECT cu_licence_country FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_licence_country'];
     }
     function getBirthday(){
       $sql="SELECT cu_birthday FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_birthday'];
     }
     function getTaid(){
       $sql="SELECT cu_ta_id FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_ta_id'];
     }
     function getTaidDiscounted(){
       $sql="SELECT cu_ta_id_discounted FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_ta_id_discounted'];
     }
     function getCreationDate(){
       $sql="SELECT cu_creation_date FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_creation_date'];
     }
     function getLastUpdate(){
       $sql="SELECT cu_last_update FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_last_update'];
     }/*
     function getLastUpdate(){
       $sql="SELECT cu_last_update FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_last_update'];
     }*/
     function getShippingFirstName(){
       $sql="SELECT cu_shipping_first_name FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_shipping_first_name'];
     }
     function getShippingLastName(){
       $sql="SELECT cu_shipping_last_name FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_shipping_last_name'];
     }
     function getIdTypeFor($label){
       $sql="SELECT id FROM tbl_customer_type WHERE label='".$label."'";
       $rang=mysql_fetch_array(dbQuery_($sql));
       return $rang['id'];
     }
     function getLabelTypeFor($id){
       $sql="SELECT label FROM tbl_customer_type WHERE id='".$id."'";
       $rang=mysql_fetch_array(dbQuery_($sql));
       return $rang['label'];
     }
     function getAdress(){  
        $sql="SELECT cu_shipping_address1 FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_shipping_address1'];
      }
     function getCountry(){
          $sql="SELECT cu_shipping_country FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_shipping_country'];
     }
     function getCity(){
         $sql="SELECT cu_shipping_city FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_shipping_city'];
     }
     function getZip(){
         $sql="SELECT cu_shipping_zip FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_shipping_zip'];
     }
     function getPhone(){
         $sql="SELECT cu_shipping_phone FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_shipping_phone'];
     }
     
     
     
     function getCu_last_update(){
         $sql="SELECT cu_last_update FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_last_update'];
     }
     
     function getActive(){
         $sql="SELECT active FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['active'];
     }
     
     function getCu_creation_date(){
         $sql="SELECT cu_creation_date FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_creation_date'];
     }
    /* function getBirthday(){
        $sql="SELECT cu_birthday FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_birthday'];
     }*/
     function getClub(){
      $sql="SELECT cu_club FROM tbl_customer WHERE cu_name='".$this->name."'";
          $rang=mysql_fetch_array(dbQuery_($sql));
           return $rang['cu_club'];
     }
     function getMail(){ return $this->mail;}
     function getName(){ return $this->name;}
     function getType(){ return $this->type;}
     function getLicences(){ return $this->licences;}
     function getPassword(){ return $this->password;}
/* 
           ------------------------   SETTER     -------------------------
*/
     function setName($name){
             $this->name=$name;
          
            $sql="UPDATE `tbl_customer` SET `cu_name`='".$name."' ,cu_last_update = NOW( ) WHERE `cu_account_email`='".$this->mail."'";
                dbQuery_($sql);
               
     }
     
     function setType($type){
             $this->type=$type;
            $sql="UPDATE `tbl_customer` SET `cu_type`='".$type."', cu_last_update = NOW( ) WHERE  `cu_name`='".$this->name."'";
                dbQuery_($sql);
     }
  
     function setMail($mail){
             $this->mail=$mail;
            $sql="UPDATE `tbl_customer` SET `cu_account_email`='".$mail."' ,cu_last_update = NOW( ) WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);
     }
     function setLicences($licences){
             $this->licences=$licences;
             $sql="UPDATE `tbl_customer` SET `cu_licence`='".$licences."' ,cu_last_update = NOW( ) WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);

     }
     function setPassword($password){
             $this->password=$password;
             $sql="UPDATE `tbl_customer` SET `cu_account_password`='".$password."' ,cu_last_update = NOW( ) WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);

     }
     function setAdress($adress){
            $this->adress=$adress;
            $sql="UPDATE `tbl_customer` SET `cu_shipping_address1`='".$adress."' ,cu_last_update = NOW( ) WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);
     }
     function setClub($club){
            $this->club=$club;
             $sql="UPDATE `tbl_customer` SET `cu_club`='".$club."' ,cu_last_update = NOW( ) WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);
     }
     function setFirstName($firstName){
      $this->firstname=$firstName;
      $sql="UPDATE `tbl_customer` SET `cu_shipping_first_name`='".$firstName."' ,cu_last_update = NOW( ) WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);
     }
     function setLastName($lastName){
      $this->lastname=$lastName;
      $sql="UPDATE `tbl_customer` SET `cu_shipping_last_name`='".$lastName."' ,cu_last_update = NOW( ) WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);
     }
     function setCountry($country){
      $sql="UPDATE `tbl_customer` SET `cu_shipping_country`='".$country."' WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);
     }
     function setCity($city){
     $sql="UPDATE `tbl_customer` SET `cu_shipping_city`='".$city."' ,cu_last_update = NOW( ) WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);
     }
     function setZip($zip){
     $sql="UPDATE `tbl_customer` SET `cu_shipping_zip`='".$zip."' ,cu_last_update = NOW( ) WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);
     }
     function setPhone($phone){
     $sql="UPDATE `tbl_customer` SET `cu_shipping_phone`='".$phone."' ,cu_last_update = NOW( ) WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);
     }
     function setBirthday($birthday){
     
         $sql="UPDATE `tbl_customer` SET `cu_birthday`='".$birthday."' ,cu_last_update = NOW( ) WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);
     }
     function setActive($a){
     
         $sql="UPDATE `tbl_customer` SET `active`='".$a."' ,cu_last_update = NOW( ) WHERE `cu_name`='".$this->name."'";
                dbQuery_($sql);
     }

}
function existCompte($mail){
	$sql="SELECT cu_name FROM tbl_customer WHERE cu_account_email='".$mail."'";
	$rang=mysql_fetch_array(dbQuery_($sql));
	//  echo "<h1>cuname :".$rang['cu_name']."  mail :".$mail."</h1>";
	if($rang['cu_name']=='') return false;
	return true;
}
?>
