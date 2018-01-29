<?php
	session_start();
	require('client_functions.php'0;	
	
	if ($_SESSION['cl_logged'] == true){
		if (($_GET['task'] == 'logged_in') && ($_GET['type'] == 'cli_user')){
?>	
test dfsdf
<?php
		}
	}else{
		header("Location: ../my_account/login_details.php");die("test");
	}
?>