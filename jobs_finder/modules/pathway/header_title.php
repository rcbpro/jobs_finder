<?php
	$file_path = $_SERVER['REQUEST_URI'];
	if (strstr($file_path,"index.php")){
		$header_title = "job2morrow - Home Page";
	}
	else if (strstr($file_path,"my_account.php")){
		$header_title = "job2morrow - Your Account";		
	}
	else if (strstr($file_path,"search.php")){
		$header_title = "job2morrow - Search for Jobs";				
	}
	else if (strstr($file_path,"industries.php")){
		$header_title = "job2morrow - All Jobs according to Industries";					
	}
	else if (strstr($file_path,"career_advice.php")){
		$header_title = "job2morrow - Career Guru for you - Online Help Desk";						
	}
	else if (strstr($file_path,"companies.php")){
		$header_title = "job2morrow - All Our Clients";						
	}	
?>