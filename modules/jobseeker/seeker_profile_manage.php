<?php
/*
 File Name : seeker_profile_management.php 
 Purpose : Job seeker 's Profile Management
 Author : Mr.Nibraz
 Developers : Ruchira Chamara
 Development Date : 
*/
?>
<?php
	session_start();
	require('seeker_functions.php');

	if ($_SESSION['job_logged'] == true){
		if (($_GET['task'] == 'logged_in') && ($_GET['type'] == 'job_user')){
		
		//Showing his/her friends that associated with the system - Connecting to the Social Network
		//$_SESSION['seeker_id'];
?>	

<?php
		}
	}	
	else{
		header("Location: ../my_account/login_details.php");
	}
?>