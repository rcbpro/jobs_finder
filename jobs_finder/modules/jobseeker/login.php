<?php
session_start();
//This page logs in a user

require("../../library/connection.php");
require("check_user.php");

$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['password'];

$check = new checkUser();

if ($check->valid_user($_SESSION['username'],$_SESSION['password']))
{	
	header("modules/clients/client_home.php");	
}
else
{
	header ('Location:index.php?task=cl_log');
	exit;
}


?>