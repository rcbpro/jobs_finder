<?php
/*
 File Name : search_functions.php - search.php
 Purpose : All Search functions
 Author : Mr.Nibraz
 Developers : Ruchira Chamara
 Development Date : 
*/
?>
<?php

require('../../library/connection.php');
	
/* This function will retrieve all client ids with thier client names */
function get_company_names_to_array(){

	global $connection;
	
	$sql = "Select client_id, company_name From clients";
	if ($results = mysql_query($sql, $connection)){
		$i=0;
		$clients = array();
		while ($row = mysql_fetch_array($results)){
			$clients[$i]['client_id'] = $row['client_id'];
			$clients[$i]['company_name'] = $row['company_name'];
			$i++;			
		}
		return $clients;
	}else{
		return NULL;
	}	
}
/* End of the function */	

/* This function will retrieve all job_categories */
function get_job_cate_names_to_array(){

	global $connection;
	
	$sql = "Select job_cat_id, job_cat_name From job_category";
	if ($results = mysql_query($sql, $connection)){
		$i=0;
		$job_cats = array();
		while ($row = mysql_fetch_array($results)){
			$job_cats[$i]['job_cat_id'] = $row['job_cat_id'];
			$job_cats[$i]['job_cat_name'] = $row['job_cat_name'];
			$i++;			
		}
		return $job_cats;
	}else{
		return NULL;
	}	
}
/* End of the function */	

/* This function will search the database for the basic search results */
function get_basic_search_results($search_keyword){

	global $connection;
	
	$display_items = NO_OF_RECORDS_PER_PAGE;
	$page_no = $_GET['page_no'];
	
	if (isset($_GET['page_no'])){
		if ($_GET['page_no'] != ''){
			if ($_GET['page_no'] == 0){
				$start_no_sql = 0;
				$end_no_sql = $display_items;
			}else{
				$start_no_sql = $page_no * $display_items;
				$end_no_sql = $display_items;				
			}
		}
	}else{
		 $start_no_sql = 0;
		 $end_no_sql = $display_items;		
	}
	$limit = " Limit {$start_no_sql}, {$end_no_sql}";		
	
	$sql = "Select * From vacancies where (title Like '%".$search_keyword."%' OR description Like '%".$search_keyword."%')"; 
	$sql .= $limit;
	if ($results = mysql_query($sql, $connection)){
		$i=0;
		$basic_search_results = array();
		while ($row = mysql_fetch_array($results)){
			$basic_search_results[$i]['id'] = $row['vacancy_id'];		
			$basic_search_results[$i]['title'] = $row['title'];
			$basic_search_results[$i]['description'] = $row['description'];			
			$i++;
		}
		return $basic_search_results;
	}else{
		return NULL;
	}
}
/* End of the function */

/* This function will return the serach result count fot the basic search */
function get_count_of_search_vacancies_for_basic_search($search_keyword){

	global $connection;
	
	$sql = "Select * From vacancies where (title Like '%".$search_keyword."%' OR description Like '%".$search_keyword."%')";
	if ($results = mysql_query($sql, $connection)){
		$num_rows = mysql_num_rows($results);
		return $num_rows;
	}	
}
/* End of the function */

/* This function will reload the industry select menu from its industry table */
function show_industry_names_for_search(){

	global $connection;
	
	$sql = "Select * From industries";
	if ($results = mysql_query($sql, $connection)){
		$i=0;
		$industry_names = array();
		while ($row = mysql_fetch_array($results)){
			$industry_names[$i]['id'] = $row['industry_id'];
			$industry_names[$i]['name'] = $row['industry_name'];			
			$i++;
		}
		return $industry_names;
	}else{
		return NULL;
	}
}
/* End of the function */

/* This function will return the search results from the database for the advanced search */
function get_advanced_search_results($industry_id, $company_id, $job_cat_id, $city, $min_years, $max_years, $search_query){

	global $connection;
	
	$display_items = NO_OF_RECORDS_PER_PAGE;
	$page_no = $_GET['page_no'];
	
	if (isset($_GET['page_no'])){
		if ($_GET['page_no'] != ''){
			if ($_GET['page_no'] == 0){
				$start_no_sql = 0;
				$end_no_sql = $display_items;
			}else{
				$start_no_sql = $page_no * $display_items;
				$end_no_sql = $display_items;				
			}
		}
	}else{
		 $start_no_sql = 0;
		 $end_no_sql = $display_items;		
	}
	$limit = " Limit {$start_no_sql}, {$end_no_sql}";			
	
	$sql = "Select * From vacancies where status = 'A' ";
	if ($industry_id != ''){
		$sql .= " And industry_id = " . $industry_id;
	}
	if ($company_id != ''){
		$sql .= " And client_id = " . $company_id;		
	}
	if ($job_cat_id != ''){
		$sql .= " And job_cat_id = " . $job_cat_id;				
	}
	if ($city != ''){
		$sql .= " And city = '" . $city . "'";						
	}	
	if (($min_years == 0) && ($min_years != '')){ 
		$new_sql = " And experience = 0";
	}
	if (($min_years != 0) && ($min_years != '')){
		$new_sql = " And experience = " . $min_years;
	}
	if (($min_years != 0) && ($max_years != 0)){
		$new_sql = " And experience Between " . $min_years . " And " . $max_years;
	}
	if (($min_years == 0) && ($max_years != 0) && ($max_years != '')){
		$new_sql = " And experience Between 0 And " . $max_years;
	}	
	if ($search_query != ''){
		$sql .= " And (title Like '%" . $search_query . "%' Or description Like '%" . $search_query . "%' Or professional_qualifications Like '%" . $search_query . "%')";											
	} 
	$sql .= $new_sql;  
	$sql .= $limit;
	if ($results = mysql_query($sql, $connection)){
		$i=0;
		$vacancy_details = array();
		while ($row = mysql_fetch_array($results)){
			$vacancy_details[$i]['id'] = $row['vacancy_id'];
			$vacancy_details[$i]['title'] = $row['title'];
			$vacancy_details[$i]['description'] = $row['description'];						
			$i++;
		}
		return $vacancy_details;
	}else{
		return NULL;
	}		
}
/* End of the function */

/* This function will return the serach result count fot the advance search */
function get_count_of_search_vacancies_for_advance_search($industry_id, $company_id, $job_cat_id, $city, $min_years, $max_years, $search_query){

	global $connection;
	
	$sql = "Select * From vacancies where status = 'A' ";
	if ($industry_id != ''){
		$sql .= " And industry_id =" . $industry_id;
	}
	if ($company_id != ''){
		$sql .= " And client_id =" . $company_id;		
	}
	if ($job_cat_id != ''){
		$sql .= " And job_cat_id =" . $job_cat_id;				
	}
	if ($city != ''){
		$sql .= " And city ='" . $city . "'";						
	}	
	if (($min_years == 0) && ($min_years != '')){ 
		$new_sql = " And experience = 0";
	}
	if (($min_years != 0) && ($min_years != '')){
		$new_sql = " And experience = " . $min_years;
	}
	if (($min_years != 0) && ($max_years != 0)){
		$new_sql = " And experience Between " . $min_years . " And " . $max_years;
	}
	if (($min_years == 0) && ($max_years != 0) && ($max_years != '')){
		$new_sql = " And experience Between 0 And " . $max_years;
	}	
	if ($search_query != ''){
		$sql .= " And (title Like '%" . $search_query . "%' Or description Like '%" . $search_query . "%' Or professional_qualifications Like '%" . $search_query . "%')";											
	} 
	$sql .= $new_sql; 
	if ($results = mysql_query($sql, $connection)){
		$num_rows = mysql_num_rows($results);
		return $num_rows;
	}	
}
/* End of the function */

?>