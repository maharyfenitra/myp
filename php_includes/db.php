<?php
/**
 * Edit the database settings to your own.
 * To use, just include the function and
 * call it using <?php db_connect(); ?>
 *
 * You can then do your database queries
 */

require "db_config.php";


function db_connect() {
    global $db_host;
    global $db_user;
    global $db_pass;
    global $db_name;
    $connection = mysql_connect($db_host,$db_user,$db_pass);
    if (!(mysql_select_db($db_name,$connection))) {
        echo "Could not connect to the database";
    }
    return $connection;
}

function db_get_text($lang, $page, $item) {

 	print db_return_text($lang, $page, $item);
}
function db_get_text_($lang, $page, $item) {

 	return db_return_text($lang, $page, $item);
}

function db_return_text($lang, $page, $item) {
       // if (!$lang or $lang=='') $lang='_en';
        $query = "SELECT * from language_items where lang='$lang' and page='$page' and item='$item'";
        $result = mysql_query($query);
        if (!$result) {
            $message .= 'Invalid query : ' . $query;
            die($message);
        }
        if ($row = mysql_fetch_assoc($result)) {
          return $row['text'];
        } else {
          $query = "SELECT * from language_items where lang='_en' and page='$page' and item='$item'";
          $result = mysql_query($query);
          if (!$result) {
              $message .= 'Invalid query : ' . $query;
              die($message);
          }
          if ($row = mysql_fetch_assoc($result)) {
            return $row['text'];
          }
        }
        return '';
}

function db_get_URL($lang, $page, $item) {
        if (!$lang or $lang=='') $lang='_en';
        $query = "SELECT * from language_items where lang='$lang' and page='$page' and item='$item'";
        $result = mysql_query($query);
        if (!$result) {
            $message .= 'Invalid query : ' . $query;
            die($message);
        }
        if ($row = mysql_fetch_assoc($result)) {
          print $row['URL'];
        }
}

function db_get_item_price($cur, $item) {
        $cur='EUR';
        $query = "SELECT * from tariff where Currency='$cur' and Item='$item'";
        $result = mysql_query($query);
        if (!$result) {
            $message .= 'Invalid query : ' . $query;
            die($message);
        }
        if ($row = mysql_fetch_assoc($result)) {
          print $row['Price'];
        }
}

function db_get_item_billing_amount($cur, $item) {
        $cur='EUR';
        $query = "SELECT * from tariff where Currency='$cur' and Item='$item'";
        $result = mysql_query($query);
        if (!$result) {
            $message .= 'Invalid query : ' . $query;
            die($message);
        }
        if ($row = mysql_fetch_assoc($result)) {
          print $row['Billing_amount'];
        }
}

function db_get_item_shipping_param($cur, $item) {
        $cur='EUR';
        $query = "SELECT * from tariff where Currency='$cur' and Item='$item' and Free_shipping=1";
        $result = mysql_query($query);
        if (!$result) {
            $message .= 'Invalid query : ' . $query;
            die($message);
        }
        if ($row = mysql_fetch_assoc($result)) {
          print '<input type="hidden" name="shipping" value="0">';
        }
}

function db_get_shipping_standard_cost($cur, $country, $weight, $amount) {
        $cur='EUR';
        $query = "SELECT min(st_tariff_standard) as shipping_cost from tbl_shipping_tariff where st_currency='$cur' and st_ct_zone = (SELECT ct_zone from tbl_country where ct_country = '$country') and $weight <= st_weight and $amount >= st_amount";
        $result = mysql_query($query);
        if (!$result) {
            $message .= 'Invalid query : ' . $query;
            die($message);
        }
        if ($row = mysql_fetch_assoc($result)) {
          return $row['shipping_cost'];
        }
	return 0;
}

function db_get_shipping_express_cost($cur, $country, $weight, $amount) {
        $cur='EUR';
        $query = "SELECT min(st_tariff_express) as shipping_cost from tbl_shipping_tariff where st_currency='$cur' and st_ct_zone = (SELECT ct_zone from tbl_country where ct_country = '$country') and $weight <= st_weight and $amount >= st_amount";
        $result = mysql_query($query);
        if (!$result) {
            $message .= 'Invalid query : ' . $query;
            die($message);
        }
        if ($row = mysql_fetch_assoc($result)) {
          return $row['shipping_cost'];
        }
        return 0;
}


function db_get_item_code($cur, $item) {
        $cur='EUR';
        $query = "SELECT * from tariff where Currency='$cur' and Item='$item'";
        $result = mysql_query($query);
        if (!$result) {
            $message .= 'Invalid query : ' . $query;
            die($message);
        }
        if ($row = mysql_fetch_assoc($result)) {
          print $row['Code_old'];
        }
}
 
function db_get_item_id($cur, $item) {
        $cur='EUR';
        $query = "SELECT * from tariff where Currency='$cur' and Item='$item'";
        $result = mysql_query($query);
        if (!$result) {
            $message .= 'Invalid query : ' . $query;
            die($message);
        }
        if ($row = mysql_fetch_assoc($result)) {
          print $row['ID'];
        }
}

function dbQuery($sql)
{
	$result = mysql_query($sql) or die(mysql_error());
	
	return $result;
}

function dbAffectedRows()
{
	global $dbConn;
	
	return mysql_affected_rows($dbConn);
}

function dbFetchArray($result, $resultType = MYSQL_NUM) {
	return mysql_fetch_array($result, $resultType);
}

function dbFetchAssoc($result)
{
	return mysql_fetch_assoc($result);
}

function dbFetchRow($result) 
{
	return mysql_fetch_row($result);
}

function dbFreeResult($result)
{
	return mysql_free_result($result);
}

function dbNumRows($result)
{
	return mysql_num_rows($result);
}

function dbSelect($dbName)
{
	return mysql_select_db($dbName);
}

function dbInsertId()
{
	return mysql_insert_id();
}





function db_get_paypal_form($div_name, $left, $top, $width, $height, $lang, $cur, $item) {
print '<div class="com-apple-iweb-widget-HTMLRegion" id="'.$div_name.'" style="left: '.$left.'px; top: '.$top.'px; opacity: 1.00; position: absolute; top: '.$top.'px; width: '. $width.'px; z-index: 1; ">';
print '<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">';
print '<input type="image" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="320" height="20" border="0" name="submit" alt="Effectuez vos paiements via PayPal : une solution rapide, gratuite et sécurisée">';
print '<img alt="" border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">';
print '<input type="hidden" name="add" value="1">';
print '<input type="hidden" name="cmd" value="_cart">';
print '<input type="hidden" name="business" value="paypal@eoskates.com">';
print '<input type="hidden" name="item_number" value="'; print db_get_item_id($cur, $item); print '">';
print '<input type="hidden" name="item_name" value="'; print db_get_text($lang, 'paypal', $item); print '">';
print '<input type="hidden" name="amount" value="'; print db_get_item_billing_amount($cur, $item); print '">';
print db_get_item_shipping_param($cur, $item); 
print '<input type="hidden" name="no_shipping" value="0">';
print '<input type="hidden" name="no_note" value="1">';
print '<input type="hidden" name="currency_code" value="EUR">';
print '<input type="hidden" name="lc" value="FR">';
print '<input type="hidden" name="bn" value="PP-ShopCartBF">';
print '</form>';
print '</div>';

}

function db_get_shop_list($cur, $family) {
        $cur='EUR';
        $query = "SELECT * from tariff where Currency='$cur' and Item like '$family%' and not (Item like '%_x8') and Weight>0 order by Code ASC";
        $result = mysql_query($query);
        if (!$result) {
            $message .= 'Invalid query : ' . $query;
            die($message);
        }
        while ($row = mysql_fetch_assoc($result)) {
          print "<tr><td>".$row['Code']."</td><td align='right'>".$row['weight']."g</td><td align='right'>".$row['Price']."&nbsp;".$cur."</td><td><input type='text' name='qty_".$row['Code']."' size='2' maxlength='3'><td><input type='checkbox' name='check_".$row['Code']."' value='1'></td></tr>";
        }
}



db_connect();
mysql_query("SET NAMES 'utf8'");
?>
