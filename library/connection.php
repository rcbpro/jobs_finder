<?php
	/* Connection variable definition */
	
	require("utilities.php");
	
	$connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
	if (!$connection)
	{
		die("Cannot open the connection !" . mysql_error());
	}
	$selected_db = mysql_select_db(DB_NAME,$connection);
	if (!$selected_db)
	{
		die("Database dose not exsist !" . mysql_error());
	}	
?>