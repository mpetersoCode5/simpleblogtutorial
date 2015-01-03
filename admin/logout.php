<?php session_start(); ?>
<?php ob_start(); ?>
<?php
//include config
require_once('../includes/config.php');

//log user out
$user->logout();
header('Location: index.php');
?>