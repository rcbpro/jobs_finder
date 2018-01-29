	if (($min_years != '') && ($max_years != '')){
		$new_sql = " And experience Between " . $min_years . " And " . $max_years;									
	}
	if (($min_years == '') && ($max_years == '')){
		$new_sql = " ";											
	}
	if (($min_years == 0) && ($max_years == '')){
		$new_sql = " And experience = 0 ";													
	}
	if (($min_years == 0) && ($max_years != '')){
		$new_sql = " And experience Berween 0 And " . $max_years;											
	}	
	if (($min_years == 0) && ($max_years != 0)){
		$new_sql = " And experience Between 0 And " . $max_years;									
	}		
