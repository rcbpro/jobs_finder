<?php
/*
 File Name : client_functions.php
 Purpose : All client functions will be listed here
 Author : Mr.Nibraz
 Developers : Ruchira
 Development Date : 
*/
?>
<?php
require('../../library/connection.php');

/* This function will check user name avalability */
function check_user_by_user_name($user_name){

	global $connection;	

	$sql = "Select username From clients where username = '" . $user_name . "'";	
	$results = mysql_query($sql, $connection);
	
	$numRows = mysql_num_rows($results);
	return $numRows;
}
/* End of the function */

/* This function will activate the client Account */
function activation(){

	$random_no = $_GET['rand_no'];

	$status = 'A';
	$affected_rows = edit_user_by_random_no($status, $random_no);
	 
	 if($affected_rows > 0){
		echo "<br /><br /><span>Thank You! Your Account has been Activated.</span>";
	 }
}
/* End of the function */

function edit_user_by_random_no($status, $random_no){

	global $connection;		
	
	$sql = "Update clients Set active_status = '$status' Where activation_code = '$random_no' ";
	$affected_rows = mysql_query($sql, $connection);		
	return $affected_rows;
}

?>