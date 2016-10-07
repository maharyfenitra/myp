<?php 
include 'lang.php';
$l=new Lang();



$l->update("_eng", $_POST['item'], $_POST['_eng'],$_POST['p_item'],"_eng");
$l->update("fr", $_POST['item'], $_POST['fr'],$_POST['p_item'],"fr");
$l->update("de", $_POST['item'], $_POST['de'],$_POST['p_item'],"de");
$l->update("pl", $_POST['item'], $_POST['pl'],$_POST['p_item'],"pl");
$l->update("it", $_POST['item'], $_POST['it'],$_POST['p_item'],"it");
$l->update("nl", $_POST['item'], $_POST['nl'],$_POST['p_item'],"nl");
$l->update("cz", $_POST['item'], $_POST['cz'],$_POST['p_item'],"cz");
?>