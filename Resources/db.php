<?php
/**
 * Edit the database settings to your own.
 * To use, just include the function and
 * call it using <?php db_connect(); ?>
 *
 * You can then do your database queries
 */

// Edit your database settings
$db_host = "cl2-sql4";
$db_user = "eoskates2";
$db_pass = "elgfos";
$db_name = "eoskates2";

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
        if (!$lang or $lang=='') $lang='en';
        $query = "SELECT * from language_items where lang='$lang' and page='$page' and item='$item'";
        $result = mysql_query($query);
        if (!$result) {
            $message .= 'Invalid query : ' . $query;
            die($message);
        }
        if ($row = mysql_fetch_assoc($result)) {
          print $row['text'];
        }
}

function db_get_URL($lang, $page, $item) {
        if (!$lang or $lang=='') $lang='en';
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

function db_get_item_code($cur, $item) {
        $cur='EUR';
        $query = "SELECT * from tariff where Currency='$cur' and Item='$item'";
        $result = mysql_query($query);
        if (!$result) {
            $message .= 'Invalid query : ' . $query;
            die($message);
        }
        if ($row = mysql_fetch_assoc($result)) {
          print $row['Code'];
        }
}



db_connect();
mysql_query("SET NAMES 'utf8'");
?>
