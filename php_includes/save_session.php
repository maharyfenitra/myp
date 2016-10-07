<?php 
  session_start();
  $_SESSION['session_name']=$_POST['session'];
   echo $_POST['session'];

?>
