<?php 
session_start();
$_SESSION['session_name']=null;
$url= $_GET['url'];
	
//echo   $url;
$URL=$url;
$url= explode("?",$url);
	if ($url[0]=='/Details_Orders.php'||$url[0]=='/History.php'){
	
		header('location:/Store.php');
		return;
	
}
//print_r ($url);

//header('location:Store.php'.$URL);
header('location:/Store.php');
?>
