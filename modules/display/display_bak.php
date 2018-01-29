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
			$row_html .= "<div class='vacancy_name_for_front'><a href='modules/industries/industries.php?task=show&type=client&client_id={$vacancy_names_on_com[$i]['client_id']}&vacancy_id={$vacancy_names_on_com[$i]['vacancy_id']}' 
			title ='{$vacancy_names_on_com[$i]['description']}' class='vacancy_name_for_front'>{$vacancy_names_on_com[$i]['title']}</a></div>";
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
			$row_html .= "<div class='vacancy_name_for_front_2'><a href='modules/industries/industries.php?task=show&type=industry&industry_id={$vacancy_names_on_ind[$i]['industry_id']}&vacancy_id={$vacancy_names_on_ind[$i]['vacancy_id']}' 
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
			$row_html .= "<div class='vacancy_name_for_front_1'><a href='modules/industries/industries.php?task=show&type=job_cat&job_cat_id={$vacancy_names_on_job_cat[$i]['job_cat_id']}&vacancy_id={$vacancy_names_on_job_cat[$i]['vacancy_id']}' 
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

/* This function show all vacancies for inside pages according to the given type */
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

/* This function will store vacancy details one by one as records included with client_name, vacancy_title, vacancy_description like.... */
function record_vacancy_details_with_header_name($type){
	
	global $connection;
	
	if ($type == 'client'){
		$table = "clients";
		$field_id = 'client_id';
		$field_name = 'company_name';
	}
	if ($type == 'industry'){
		$table = "industries";
		$field_id = 'industry_id';		
		$field_name = 'industry_name';
	}
	if ($type == 'job_cat'){
		$table = "job_categories";
		$field_id = 'job_cat_id';		
		$field_name = 'job_cat_name';
	}
	
	$sql = "Select {$field_name}, {$field_id} From {$table}";// die($sql);
	if ($results = mysql_query($sql, $connection)){
		$row_html = '';	
		$i=0;
		$all_count=1;
		$row_html = array();
		$row_html['string_part'] .= "<div class='industry_navigation defaultFont'>";                					
		while ($row = mysql_fetch_array($results)){
			$header_name[$i]['field_id'] = $row[$field_id];					
			$header_name[$i]['field_name'] = $row[$field_name];
			
			$vacancy_details = get_vacancy_details_by_given_type($header_name[$i]['field_id'], $type); 
			
			for($n=0; $n<count($vacancy_details); $n++, $all_count++){	
				if ($n == 0){
					$header_name[$i]['field_name'] . "<br />";
					$row_html['string_part'] .= "<div class='cat_name' style='height:15px; font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; margin-top:10px;'>{$header_name[$i]['field_name']}</div>";
				}
				$header_name[$i][$n]['title'] = $vacancy_details[$n]['title'] . "<br />";
				$row_html['string_part'] .= "<div class='vacancy_name defaultFont' style='height:15px; font-size:11px;'>{$header_name[$i][$n]['title']}</div>";
				$header_name[$i][$n]['description'] = $vacancy_details[$n]['description'] . "<br /><br />";				
				$row_html['string_part'] .= "<div class='vacancy_description defaultFont' style='font-size:11px;'>{$header_name[$i][$n]['description']}</div>";				
				$row_html['string_part'] .= "<div style='height:10px; width:180px;'>$all_count</div>"; 				
				$row_html['row_count'] = $all_count;
				if ($all_count == 4 || $all_count == 8 || $all_count == 11){
					$row_html['string_part'] .= "</div>";
					$row_html['string_part'] .= "<div class='industry_navigation defaultFont'>";                										
				}
			}
			$i++;
		}
		return $row_html;
	}else{
		return NULL;
	}
	
}
/* End of the function */

function get_vacancy_details_by_given_type($type){
	
	global $connection;
	
	$sql = "Select * From vacancies";
	if ($results = mysql_query($sql, $connection)){
		$i=0;
		$vacancy_details = array();
		while ($row = mysql_fetch_array($results)){
			$vacancy_details[$i]['client_id'] = $row['client_id'];		
			//$vacancy_details[$i][]
			$vacancy_details[$i]['title'] = $row['title'];
			$vacancy_details[$i]['description'] = $row['description'];			
			$i++;
		}
		return $vacancy_details;
	}else{
		return NULL;
	}
}


/* This function will retrieve all header names for the vacancies it consist for the given type 
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

/* This function will retrieve vacancies and categorized according to the given type 
function get_vacancy_details_by_given_type($type){
	
	global $connection;	
	
	if ($type == 'client'){
		$field = " client_id";
	}
	if ($type == 'industry'){
		$field = " industry_id";
	}
	if ($type == 'job_cat'){
		$field = " job_cat_id";
	}	
			
	$field_id = get_field_id_for_the_type($type); 
	$field_name = get_field_name_by_field_id($field_id, $type); 
	$sql = "Select * From vacancies Where {$field} = " . $field_id; die($sql);
	if ($results = mysql_query($sql, $connection)){ 
		$i=0;
		$vacancy_details = array();
		while ($row = mysql_fetch_array($results)){
			$vacancy_details[$i]['id'] = $row['vacancy_id'];			
			$vacancy_details[$i]['title'] = $row['title'];
			$vacancy_details[$i]['description'] = $row['description'];			
			$vacancy_details[$i]['field_name'] = $field_name;						
		$i++;			
		}
		return $vacancy_details;
	}else{
		return NULL; 
	}
}
/* End of the function */ 

/* This function will return the field id for a given type */
function get_field_id_for_the_type($type){
	
	global $connection;
	
	if ($type == 'client'){
		$field_id = "client_id";
		$field_name = "company_name";		
		$table = "clients";
	}
	if ($type == 'industry'){
		$field_id = "industry_id";
		$field_name = "industry_name";						
		$table = "industries";		
	}
	if ($type == 'job_cat'){
		$field_id = "job_cat_id";
		$field_name = "job_cat_name";								
		$table = "job_categories";		
	}
	
	$sql = "Select " . $field_id . " From " . $table; 
	
	if ($results = mysql_query($sql, $connection)){ 
		$i=0;
		while ($row = mysql_fetch_array($results)){
			$fields = $row[$field_id];
		}
		return $fields;
	}else{
		return NULL;
	}
}
/* End of the function */ 

/* This function will return the field name for a given type */

function get_field_name_by_field_id($field_id, $type){

	global $connection;

	if ($type == 'client'){
		$field_id = "client_id";
		$field_name = "company_name";		
		$table = "clients";
	}
	if ($type == 'industry'){
		$field_id = "industry_id";
		$field_name = "industry_name";						
		$table = "industries";		
	}
	if ($type == 'job_cat'){
		$field_id = "job_cat_id";
		$field_name = "job_cat_name";								
		$table = "job_categories";		
	}
	
	$sql = "Select " . $field_name . " From " . $table . " limit 1"; 
	
	if ($results = mysql_query($sql, $connection)){ 
			$fields_name = mysql_fetch_array($results);
		return $fields_name;
	}else{
		return NULL;
	}
}
/* End of the function */ 

?>