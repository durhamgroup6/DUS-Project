<?php
$db_host = 'mysql:host=localhost';
$db_name = 'dbname=teamdurham';
$db_user = 'root';
$db_pass = '';
$pdo = new PDO($db_host . ';' . $db_name, $db_user, $db_pass, array(PDO::ATTR_PERSISTENT => true));
?>