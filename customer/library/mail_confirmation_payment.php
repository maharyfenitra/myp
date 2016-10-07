<?php
require_once 'customer.php';
class Mail_Confirmation_Payment{
function __construct($mail,$sender,$entreprise_name,$lang = false,$id=false,$or_stat=false){
//$mail = 'Eoskate@mail.fr'; // Déclaration de l'adresse de destination.

if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
    $passage_ligne = "\r\n";
}
else
{
    $passage_ligne = "\n";
}
$server_name = $_SERVER['SERVER_NAME'];
//=====Déclaration des messages au format texte et au format HTML.
//echo $mail;
$activation_compte_message = db_get_text_($lang, 'all', 'activation_compte_message');
$customer = new Customer(null,$mail,null,null);
$key__cd = $mail.$customer->getPassword();
 $key__cd =  md5($mail.$customer->getPassword());
 $activate_link = "http://$server_name/customer/activate_compte.php?lang = $lang&key=$key__cd&mail=$mail";
$message_txt =db_get_text_($lang, 'all', 'hello_item');

$title=db_get_text_($lang, 'all', 'payment_confirmation_title');

$hello=htmlspecialchars(db_get_text_($lang, 'all', 'hello_item').' '.$customer->getShippingFirstName(), ENT_QUOTES);//db_get_text_($lang, 'all', 'hello_item').' '.$customer->getShippingFirstName();

$message=db_get_text_($lang, 'all', 'payment_mail_message');

$message="";



$ar=$this->getOrderInfo($id);
extract($ar);



//************************************************************************************************************************

//$newDate = date("d-m-Y h:m:s", strtotime($od_date));
$newDate = date("d-m-Y h:m:s");


$message=htmlspecialchars(db_get_text_($lang, 'all', 'we_received_order_item'), ENT_QUOTES).' <b>'.$newDate.'</b> '.htmlspecialchars(db_get_text_($lang, 'all', 'msg_total_order_item'), ENT_QUOTES).' <b>'.$od_amount_total.'‎ Euros </b>. ';
//$message=htmlspecialchars($message, ENT_QUOTES);

//************************************************************************************************************************
$message_2="";

$link=$activate_link;

$button=db_get_text_($lang, 'all', 'acceder_votre_compte');

include "mail_theme.php";



//echo "<img src = 'images/image1.jpg' />";
//==========

 
//=====Création de la boundary

$boundary = "-----=".md5(rand());

//==========


//=====Définition du sujet.

$sujet = db_get_text_($lang, 'all', 'order_email_subject');

//=========
 

//=====Création du header de l'e-mail.

$header = "From: \"$entreprise_name\"<$sender>".$passage_ligne;

$header.= "Reply-to: \"$entreprise_name\" <$sender>".$passage_ligne;

$header.= "MIME-Version: 1.0".$passage_ligne;

$header .= "Bcc: $sender".$passage_ligne; 

$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

//==========

 

//=====Création du message.

$message = $passage_ligne."--".$boundary.$passage_ligne;

//=====Ajout du message au format texte.

$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;

$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

$message.= $passage_ligne.$message_txt.$passage_ligne;

//==========

$message.= $passage_ligne."--".$boundary.$passage_ligne;

//=====Ajout du message au format HTML

$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;

$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

$message.= $passage_ligne.$message_html.$passage_ligne;

//==========

$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

//==========

 

//=====Envoi de l'e-mail.

mail($mail,$sujet,$message,$header);
//echo $message;
//==========
                    }
public function getOrderInfo($id){
  /*$sql = "SELECT * 
          FROM  `tbl_order` 
            WHERE od_payment_email =  '$mail'
               ORDER BY od_id DESC";*/
  $sql="SELECT * FROM  `tbl_order` WHERE od_id='$id'";
  $rang=mysql_fetch_array(dbQuery($sql));
  // $rang;
  return $rang;

  }
}
?>
