<?php
require 'config.php';
require 'Auth.php';

$auth = new Auth($pdo);
$auth->logout();

header("Location: login.php");
exit;
?>
