<?php 
//session_start();

require_once '../../php_includes/db.php';
require_once '../library/mail_confirmation_compte.php';
//require_once 'kjiuihiuiuiu.php';
//$v= new ForgetPassword('mahary@fuba-industries.com');
echo "envoie mail</br>";
//echo db_get_text_($lang, 'all', 'custem_password_2');
$v= new Mail_Confirmation_Compte('mahary@fuba-industries.com',1);
  //$v= new Mail_Confirmation_Compte('mahary@fuba-industries.com',1);

?>
