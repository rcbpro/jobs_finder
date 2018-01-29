<?php
/*
 File Name : display.php - functions
 Purpose : All Display functions
 Author : Mr.Nibraz
 Developers : Ruchira Chamara
 Development Date : 
*/
?>
<?php

/* All Front end functions will be in here */

/* This function will display the job categories for left content */
function display_job_catgories(){

	global $connection;
	
	$sql = "Select * From job_category";
	$results = mysql_query($sql, $connection);
	if ($results){
		$job_catagory = array();
		$i=0;
		while ($row = mysql_fetch_array($results)){
			$job_catagory[$i]['job_cat_name'] = $row['job_cat_name'];	
			$job_catagory[$i]['description'] = $row['description'];				
			$i++;
		}
		return $job_catagory;
	}else{
		return NULL;
	}
}
/* End of the fucntion */

/* This function will display hired company names in the front */
function show_vacancy_company_names_for_front(){

	global $connection;
	
	$sql = "Select company_name, client_id From clients";
	$results = mysql_query($sql, $connection);
	if ($results){
		$company_names = array();
		$i = 0;		
		while ($row = mysql_fetch_array($results)){
			if (check_available_vacancies($row['client_id'], $row['job_cat_id'], $row['industry_id'])){
				$company_names[$i]['company_name'] = $row['company_name'];
				$company_names[$i]['client_id'] = $row['client_id'];			
				$i++;
			}
		}
		return $company_names;
	}else{
		return NULL;
	}
}
/* End of the fucntion */

/* This function will display vacancies hired by companies in the front */
function show_client_vacancies_for_front($client_id){

	global $connection;
	
	$sql = "Select * From Vacancies Where client_id = {$client_id} limit 3";
	$results = mysql_query($sql, $connection);
	if ($results){
		$vacancy_names_on_com = array();
		$row_html = "";
		$i = 0;
		while ($row = mysql_fetch_array($results)){
			$vacancy_names_on_com[$i]['client_id'] = $row['client_id'];
			$vacancy_names_on_com[$i]['vacancy_id'] = $row['vacancy_id'];			
			$vacancy_names_on_com[$i]['title'] = $row['title'];						
			$vacancy_names_on_com[$i]['description'] = $row['description'];			
			$row_html .= "<div class='vacancy_name_for_front'><a href='#' title ='{$vacancy_names_on_com[$i]['description']}' 
			class='vacancy_name_for_front' 
			onclick=apply_vacancy_box('task=apply&vacancy_id={$vacancy_names_on_com[$i]['vacancy_id']}');>{$vacancy_names_on_com[$i]['title']}</a></div>";
			$i++;
		}
		return $row_html;
	}
	else{
		return NULL;
	}
}
/* End of the fucntion */

/* This function will display industry names in the front */
function show_industry_names_for_front(){

	global $connection;
	
	$sql = "Select * From industries";
	$results = mysql_query($sql, $connection);
	if ($results){
		$industry_names = array();
		$i = 0;
		while ($row = mysql_fetch_array($results)){
			if (check_available_vacancies($row['client_id'], $row['job_cat_id'], $row['industry_id'])){
				$industry_names[$i]['industry_name'] = $row['industry_name'];
				$industry_names[$i]['industry_id'] = $row['industry_id'];			
				$i++;
			}	
		}
		return $industry_names;
	}
	else{
		return NULL;
	}
}
/* End of the fucntion */

/* This function will display vacancies hired by industries in the front */
function show_vacancies_for_industries_for_front($industry_id){

	global $connection;
	
	$sql = "Select * From Vacancies Where industry_id = {$industry_id} limit 3";
	$results = mysql_query($sql, $connection);
	if ($results){
		$row_html = "";
		$i = 0;
		$vacancy_names_on_ind = array();
		while ($row = mysql_fetch_array($results)){
			$vacancy_names_on_ind[$i]['title'] = $row['title'];
			$vacancy_names_on_ind[$i]['industry_id'] = $row['industry_id'];
			$vacancy_names_on_ind[$i]['vacancy_id'] = $row['vacancy_id'];						
			$vacancy_names_on_com[$i]['description'] = $row['description'];						
			$row_html .= "<div class='vacancy_name_for_front_2'><a href='modules/industries/apply_vacancies.php?task=apply&vacancy_id={$vacancy_names_on_ind[$i]['vacancy_id']}' 
			title ='{$vacancy_names_on_com[$i]['description']}' class='vacancy_name_for_front_1'>{$vacancy_names_on_ind[$i]['title']}</a></div>";
			$i++;
		}
		return $row_html;
	}else{
		return NULL;
	}	
}
/* End of the fucntion */

/* This function will display job category names in the front */
function show_job_cat_names_for_front(){

	global $connection;
	
	$sql = "Select * From job_category";	
	$results = mysql_query($sql, $connection);
	if ($results){
		$job_cat_names = array();
		$i = 0;
		while ($row = mysql_fetch_array($results)){
			if (check_available_vacancies($row['client_id'], $row['job_cat_id'], $row['industry_id'])){
				$job_cat_names[$i]['job_cat_id'] = $row['job_cat_id'];
				$job_cat_names[$i]['job_cat_name'] = $row['job_cat_name'];
				$i++;			
			}			
		}
		return $job_cat_names;
	}
	else{
		return NULL;
	}
}
/* End of the fucntion */

/* This function will display vacancies hired by job categories in the front */
function show_vacancies_for_job_categories_for_front($job_cat_id){

	global $connection;
	
	$sql = "Select * From Vacancies Where job_cat_id = {$job_cat_id} limit 3";
	$results = mysql_query($sql, $connection);
	if ($results){
		$row_html = "";
		$i = 0;
		$vacancy_names_on_job_cat = array();
		while ($row = mysql_fetch_array($results)){
			$vacancy_names_on_job_cat[$i]['title'] = $row['title'];
			$vacancy_names_on_job_cat[$i]['job_cat_id'] = $row['job_cat_id'];
			$vacancy_names_on_job_cat[$i]['vacancy_id'] = $row['vacancy_id'];						
			$vacancy_names_on_com[$i]['description'] = $row['description'];									
			$row_html .= "<div class='vacancy_name_for_front_1'><a href='modules/industries/apply_vacancies.php?task=apply&vacancy_id={$vacancy_names_on_job_cat[$i]['vacancy_id']}' 
			title ='{$vacancy_names_on_com[$i]['description']}' class='vacancy_name_for_front_2'>{$vacancy_names_on_job_cat[$i]['title']}</a></div>";
			$i++;
		}
		return $row_html;
	}else{
		return NULL;
	}	
}
/* End of the fucntion */

/* This function will check for available vacancies for clients */
function check_available_vacancies($client_id, $job_cat_id, $industry_id){

	global $connection;		
	
	$sql = "Select vacancy_id From vacancies where ";
	if ($client_id != NULL){
		$sql .= " client_id = " . $client_id;
	}
	if ($job_cat_id != NULL){
		$sql .= " job_cat_id = " . $job_cat_id;
	}
	if ($industry_id != NULL){
		$sql .= " industry_id = " . $industry_id;
	}	
	$results = mysql_query($sql, $connection);
	if (mysql_num_rows($results)){
		return true;
	}else{
		return false;
	}
}
/* End of the fucntion */

/* This function will return client name by client id */
function get_client_name_by_client_id($client_id){

	global $connection;
	
	$sql = "Select company_name From clients Where client_id = {$client_id}";
	if ($results = mysql_query($sql, $connection)){
		while ($row = mysql_fetch_array($results)){
			$company_name = $row['company_name'];
		}
		return $company_name;
	}else{
		return NULL;
	}
}
/* End of the fucntion */

/* This function will return the industry name by industry id */
function get_industry_name_by_industry_id($industry_id){

	global $connection;
	
	$sql = "Select industry_name From industries Where industry_id = {$industry_id}";
	if ($results = mysql_query($sql, $connection)){
		while ($row = mysql_fetch_array($results)){
			$industry_name = $row['industry_name'];
		}
		return $industry_name;
	}else{
		return NULL;
	}
}
/* End of the fucntion */

/* This function will return job cat name by job cat id */
function get_job_cat_name_by_cat_id($job_cat_id){

	global $connection;
	
	$sql = "Select job_cat_name From job_category Where job_cat_id = {$job_cat_id}";
	if ($results = mysql_query($sql, $connection)){
		while ($row = mysql_fetch_array($results)){
			$job_cat_name = $row['job_cat_name'];
		}
		return $job_cat_name;
	}else{
		return NULL;
	}	
}
/* End of the function */

/* This function show all vacancies for inside pages according to the given type and given id */
function show_all_vacancies_for_type($type, $id){

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
	
	$sql = "Select * From vacancies Where ";	
	if ($type == 'client'){	
		$sql .= " client_id = {$id}";
	}
	if ($type == 'industry'){
		$sql .= " industry_id = {$id}"; 
	}
	if ($type == 'job_cat'){
		$sql .= " job_cat_id = {$id}";
	}
	$sql .= $limit;
	if ($results = mysql_query($sql, $connection)){
		$i=0;
		$vacancies = array();
		while ($row = mysql_fetch_array($results)){
			$vacancies[$i]['id'] = $row['vacancy_id'];					
			$vacancies[$i]['title'] = $row['title'];			
			$vacancies[$i]['description'] = $row['description'];			
			$i++;
		}
		return $vacancies;
	}else{
		return NULL;
	}	
}
/* End of the function */

/* This function will return num of records count for the pagination */
function show_count_of_all_vacancies_for_type($type, $id){

	global $connection;
	
	$sql = "Select * From vacancies Where ";	
	if ($type == 'client'){	
		$sql .= " client_id = {$id}";
	}
	if ($type == 'industry'){
		$sql .= " industry_id = {$id}"; 
	}
	if ($type == 'job_cat'){
		$sql .= " job_cat_id = {$id}";
	}
	if ($results = mysql_query($sql, $connection)){
		$num_rows = mysql_num_rows($results);
		return $num_rows;
	}	
}
/* End of the function */

/* This function will retrieve all header names for the vacancies it consist for the given type */
function show_all_vacancy_header_names_by_type($selected_type){

	global $connection;
	
	if ($selected_type == 'client'){
		$field = " company_name,client_id";
		$data_table = " clients";
	}
	if ($selected_type == 'industry'){
		$field = " industry_name,industry_id";	
		$data_table = " industries";
	}
	if ($selected_type == 'job_cat'){
		$field = " job_cat_name,job_cat_id";		
		$data_table = " job_category";
	}
	$sql = "Select {$field} From {$data_table}";
	if ($results = mysql_query($sql, $connection)){
		$i=0;
		$vacancy_headers = array();
		while ($row = mysql_fetch_array($results)){
			if ($selected_type == 'client'){
				$vacancy_headers[$i]['field_name'] = $row['company_name'];
				$vacancy_headers[$i]['field_id'] = $row['client_id'];				
			}else if ($selected_type == 'industry'){
				$vacancy_headers[$i]['field_name'] = $row['industry_name'];				
				$vacancy_headers[$i]['field_id'] = $row['industry_id'];				
			}else{
				$vacancy_headers[$i]['field_name'] = $row['job_cat_name'];
				$vacancy_headers[$i]['field_id'] = $row['job_cat_id'];									
			}
		$i++;	
		}
		return $vacancy_headers;
	}else{
		return NULL;
	}
}
/* End of the function */

/* This function show all vacancies for inside pages according to the given type */
function show_all_vacancies($type){

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
	$sql = "Select * From vacancies ";	
	$sql .= $limit; 
	if ($results = mysql_query($sql, $connection)){
		$i=0;
		$vacancies = array();
		while ($row = mysql_fetch_array($results)){
			$vacancies[$i]['id'] = $row['vacancy_id'];		
			$vacancies[$i]['title'] = $row['title'];
			$vacancies[$i]['description'] = $row['description'];			
			$i++;
		}
		return $vacancies;
	}else{
		return NULL;
	}	
}
/* End of the function */

/* This function will return num of records count for the pagination */
function show_count_of_all_vacancies($type){

	global $connection;
	
	$sql = "Select * From vacancies";	
	if ($results = mysql_query($sql, $connection)){
		$num_rows = mysql_num_rows($results);
		return $num_rows;
	}	
}
/* End of the function */

?>