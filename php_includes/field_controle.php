<?php 
  function isValidField($value){
  $reg = "#insert|select|update|drop|delete|drop|truncate|alter#i";
 if(preg_match($reg,$value))
    { 
     return false;
     }
else{
     return true;
    }
   
};
?>
