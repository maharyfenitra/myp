<?php

include_once  'include/db.php';
class History{
public function __construct(){

        }
public function getCustomerHitory($cu_id){

       $sql  = "select * from tbl_order where od_shipping_email = '$cu_id' order by od_date desc limit 30";
       //  echo $sql;
       $resultat = dbQuery_($sql);
       $history = array();
      while($rang = mysql_fetch_array($resultat)){
          $history[] = $rang;
      
         }
         
      return $history;
     }
public function getAllItemForODID($od_id){
        $sql  = "select * from tbl_order_item where od_id = '$od_id'";
        
        $resultat = dbQuery_($sql);
        $history = array();
           while($rang = mysql_fetch_array($resultat)){
                   $history[] = $rang;
      
               }     
      return $history;
         }
public function getThingIDO($cu_id){

       $sql  = "select * from tbl_order where od_id = '$cu_id'";
       //  echo $sql;
       $resultat = dbQuery_($sql);
       $history = array();
      while($rang = mysql_fetch_array($resultat)){
          $history[] = $rang;
      
         }
         
      return $history;
     }
  }
  
  ?>
