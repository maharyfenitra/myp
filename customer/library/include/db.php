<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/php_includes/db_config.php';
/**
 * Edit the database settings to your own.
 * To use, just include the function and
 * call it using <?php db_connect(); ?>
 *
 * You can then do your database queries
 */


//echo $_SERVER['DOCUMENT_ROOT'];
// Edit your database settings ciao
/*$db_host = "cl1-sql8";
$db_user = "p891_4";
$db_pass = "Devel";
$db_name = "p891_4";*/

/*$db_host = "localhost";
$db_user = "fuba-industries";
$db_pass = "fuba-industries";
$db_name = "fuba-industries";*/


function db_connect_() {
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

function dbQuery_($sql)
{
	$result = mysql_query($sql) or die(mysql_error());

	return $result;
}

db_connect_();
mysql_query("SET NAMES 'utf8'");
?>
