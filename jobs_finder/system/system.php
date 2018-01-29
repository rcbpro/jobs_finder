<?php
	session_start();
	require('../library/connection.php');
	
	global $connection;
	
	$action = $_POST['action'];
	
	if($action == "validate_first_step"){
		
		$company_name = $_POST['company_name'];
		$industry = $_POST['industry'];		
		$address = $_POST['address'];		
		$country = $_POST['country'];			
		$city = $_POST['company_city'];	
		
		$sql = "Insert into clients(`company_name`, `industry_id`, `address`, `country`, `city`) values('$company_name', '$industry', '$address', '$country', '$city');";
		$result = mysql_query($sql)or die(mysql_error());
		
		$_SESSION['inserted_id'] = mysql_insert_id($connection);
		
		$affected_rows = mysql_affected_rows($connection);			 
		if($affected_rows > 0){
			print("yes");	
		}else{
			print("no");
		}		
	}
	
	if ($action == 'validate_second_step'){

		$contact_name = $_POST['contact_name'];
		$_SESSION['contact_name'] = $contact_name;
		$designation = $_POST['designation'];		
		$phone_no = $_POST['phone_no'];		
		$alt_phone_no = $_POST['alt_phone_no'];			
		$fax_no = $_POST['fax_no'];	
		$sal = $_POST['sal'];
		$client_id = $_SESSION['inserted_id'];
		
		$sql = "Update clients set `client_name` = '$contact_name', `client_position` = '$designation', `telephone_office` = '$phone_no', `alt_telephone_office` = '$alt_phone_no', `fax_no` = '$fax_no', `salutation` = '$sal' where `client_id` = '$client_id';";
		$result = mysql_query($sql)or die(mysql_error());
		
		$affected_rows = mysql_affected_rows($connection);			 
		if($affected_rows > 0){
			print("yes");	
		}else{
			print("no");
		}			
	}

	if ($action == 'validate_third_step'){

		$u_name = $_POST['u_name'];
		$password = $_POST['password'];		
		$email = $_POST['email'];		
		$security_code = $_POST['security_code'];			
		$client_id = $_SESSION['inserted_id'];
		
		$reg_date = date('Y-m-d');
		$m= date("m"); // Month value
		$de= date("d"); //today's date
		$y= date("Y"); // Year value
		//$day =  date('Y-m-d', mktime(0,0,0,$m,($de-7),$y)); 
		$expiery_date = date('Y-m-d', mktime(0,0,0,$m,($de+365),$y)); 		
		$random_no = mt_rand();			
		$active_status = 'D';
		
		$sql = "Update clients set `username` = '$u_name', `password` = '$password', `email` = '$email', `registered_date` = '$reg_date', `expire_date` = '$expiery_date', `activation_code` = '$random_no', `active_status` = '$active_status' where `client_id` = '$client_id';";
		$result = mysql_query($sql)or die(mysql_error());
		
		$affected_rows = mysql_affected_rows($connection);			 		
		
		if($affected_rows > 0){		
			print("yes");	
		}else{
			print("no");
		}			
	}

	if ($action == "check_user_cli"){		
	
		$user_name = $_POST['User_Name'];
		$password = $_POST['Password'];		

		$sql = "Select username, password From clients where username = '" . $user_name . "' and password = '" . $password . "'";
		$results = mysql_query($sql) or die(mysql_error());
		$num_rows = mysql_num_rows($results);
		if ($num_rows > 0){
			$_SESSION['cl_logged'] = true;
			print('yes');
		}else{
			print('no');
		}
	}
	
	if ($action == "check_user_job"){		
	
		$user_name = $_POST['User_Name'];
		$password = $_POST['Password'];		

		$sql = "Select username, seeker_id, password From jobseekers_infomations where username = '" . $user_name . "' and password = '" . $password . "'";
		$results = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_array($results);
		$_SESSION['seeker_id'] = $row['seeker_id'];
		$num_rows = mysql_num_rows($results);
		if ($num_rows > 0){
			$_SESSION['job_logged'] = true;	
			print('yes');
		}else{
			print('no');
		}
	}	

?>