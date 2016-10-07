<?php
require_once '../php_includes/config.php';
require_once './library/functions.php';

$content = 'main.php';

$pageTitle = 'IP Update';

print $_SERVER['REMOTE_ADDR'];
file_put_contents("./ip.txt", $_SERVER['REMOTE_ADDR']);
?>
