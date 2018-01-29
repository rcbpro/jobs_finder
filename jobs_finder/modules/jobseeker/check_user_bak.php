<?php
//This class checks wether the supplied user name and password are correct

class checkUser
{
	function valid_user($username,$password)
	{
		global $connection;
		$validity = false;
		//Connecting to the database
		$check_user = mysql_query("select * from clients where username='".$username."' and password='".$password."'",$connection) or die("Could not register.Please try again after while.");

		if (mysql_num_rows($check_user)==1)
		{
			$validity = true;
		}
		else
		{
			$validity = false;
		}
		
		return $validity;
	}
}

?>