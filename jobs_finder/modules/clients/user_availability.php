<?php
/*
 File Name : user_availability.php
 Purpose : check user availability.
 Author : Mr.Nibraz
 Developers : Ruchira
 Development Date : 
*/
?>
<?php
require('client_functions.php');

$user_name = $_GET['txtClUserName'];
$num_rows = check_user_by_user_name($user_name);

if ($num_rows > 0)
{
	$num_rows = "1";
}
else 
{
	$num_rows =  "0";
}

echo $num_rows;	

?>