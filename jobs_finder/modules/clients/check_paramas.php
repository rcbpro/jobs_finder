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
require("client_functions.php");
require("../../library/securimage/securimage.php");

if ($_GET['task'] == 'chk_uname'){

	$num_rows = check_user_by_user_name($_GET['user_name']);
	echo $num_rows;
}
if ($_GET['task'] == 'spam_chk'){
	
	$verification_code = $_GET['v_code'];
	$img = new Securimage();
	$valid = $img->check($verification_code);
	if($valid == true) {
		echo "1";	
	}else{
		echo "0";
	}		
}
if ($_GET['task'] == 'activate'){
	activation();
}
?>