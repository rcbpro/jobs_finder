<?php
/*
 File Name : middle_content.php - search.php
 Purpose : All Display functions
 Author : Mr.Nibraz
 Developers : Ruchira Chamara
 Development Date : 
*/
?>
<?php
	require('search_functions.php');
		
	$php_counter = 0;		
	$clients = get_company_names_to_array();
	$job_cats = get_job_cate_names_to_array();
	$industries = show_industry_names_for_search();	

	if ($_GET['search_type'] == 'advance'){		
		$advance_type_search = "checked = checked";	
	}
	
	if (($_GET['task'] == 'search') && ($_GET['type'] == 'basic')){
		$vacancy_details = get_basic_search_results($_GET['search_query']);
		$num_of_records = get_count_of_search_vacancies_for_basic_search($_GET['search_query']);		
	}
	if (($_GET['task'] == 'search') && ($_GET['type'] == 'advance')){		
		$vacancy_details = get_advanced_search_results($_GET['industry_id'], $_GET['company_id'], $_GET['job_cat_id'], $_GET['city'], $_GET['min_years'], $_GET['max_years'], $_GET['search_query']);
		$num_of_records = get_count_of_search_vacancies_for_advance_search($_GET['industry_id'], $_GET['company_id'], $_GET['job_cat_id'], $_GET['city'], $_GET['min_years'], $_GET['max_years'], $_GET['search_query']);		
	}
?>
<?php
	//Pagination Starts for both types of vacancy display
	$display_items = NO_OF_RECORDS_PER_PAGE;
	
	if (!isset($_GET['page_no'])){
		$start_no = 1;
	}
	if ($_GET['page_no'] != ''){
		if ($_GET['page_no'] == 1){
			$start_no = $display_items;
		}
		if ($_GET['page_no'] > 1){
			$start_no = ($_GET['page_no']) * $display_items;
		}
	}
	if ($num_of_records < $display_items){
		$link_message = "Showing 1 to {$num_of_records} of {$num_of_records}";
		$page_message = "Page " . ($_GET['page_no'] + 1) . " of {$no_of_pages}";		
	}else{
		$no_of_pages = ceil($num_of_records/$display_items);
		$page_no = $_GET['page_no'] + 1;
		
		if ($_GET['type'] == 'basic'){
			$link = "search.php?task=search&type=". $_GET['type']."&search_query=".$_GET['search_query']."&page_no={$page_no}";		
		}
		if ($_GET['type'] == 'advance'){
			if (isset($_GET['industry_id'])){
				$link_concat  .= "&industry_id=" . $_GET['industry_id'];
			}	
			if (isset($_GET['company_id'])){
				$link_concat .= "&company_id=" . $_GET['company_id'];
			}	
			if (isset($_GET['job_cat_id'])){
				$link_concat .= "&job_cat_id=" . $_GET['job_cat_id'];
			}	
			if (isset($_GET['city'])){
				$link_concat .= "&city=" . $_GET['city'];
			}	
			if (isset($_GET['min_years'])){
				$link_concat .= "&min_years=" . $_GET['min_years'];
			}	
			if (isset($_GET['max_years'])){
				$link_concat .= "&max_years=" . $_GET['max_years'];
			}	
			if (isset($_GET['search_query'])){
				$link_concat .= "&search_query=" . $_GET['search_query'];
			}	
			$link = "search.php?task=search&type=". $_GET['type']."{$link_concat}"."&page_no={$page_no}";					
		}	

		$set_pages = $page_no * $display_items;
		$remain_items = $num_of_records - $set_pages;				
		$condition = ($page_no + 1) * $display_items;
						
		if($condition < $tot_itmes){
			$nextLink="<a href = $link class ='industry_pag_links'>Next Page &gt;&gt;</a>";
		}
		if ($remain_items > 0){
			$nextLink="<a href = $link class ='industry_pag_links'>Next Page &gt;&gt;</a>";				
			if ($remain_items < $display_items){
				$end_no_remain = $page_no * $display_items;
			}else{
				$end_no_remain = $page_no * $display_items;					
			}
		}
		if ($remain_items <= 0){
			$end_no_remain = $num_of_records;										
		}
		if ($remain_items == $num_of_records){
			$end_no_remain = $remain_items;					
		}

		if($_GET['page_no']==0){
			$start_no = '1';
		}
		if($_GET['page_no'] > 0){
			$page_no = $_GET['page_no']-1;
		
		if ($_GET['type'] == 'basic'){
			$linkPrivous = "search.php?task=search&type=".$_GET['type']."&search_query=".$_GET['search_query']."&page_no={$page_no}";
		}
		if ($_GET['type'] == 'advance'){
			$linkPrivous = "search.php?task=search&type=".$_GET['type']."{$link_concat}"."&page_no={$page_no}";			
		}	
			$previous = 'previous';
			$previousLink = "<a href = $linkPrivous class='industry_pag_links'>&lt;&lt; Previous</a>";	
		}
		$link_message = "$previousLink Showing $start_no to $end_no_remain of $num_of_records $nextLink";
		$page_message = "Page " . ($_GET['page_no'] + 1) . " of {$no_of_pages}";
	}
?>
<div id="middle_content">
<div id="link_header_title_for_main">Search for Jobs</div>
	<div id="box_wrappers">
    	<div id="search_header_page_area">    
    	<?php
			if (($_GET['task'] == 'search') && (count($vacancy_details) > 0)){
		?>	
	        <div id="go_to_page_selection" style="width:550px;">Go To Page
            <select id="go_to_page" name="go_to_page" onchange="go_to_search_page('<?php echo $_GET['type'];?>','<?php echo $_GET['search_query'];?>')">
            	<?php
				if ($no_of_pages == 0){
					$loop_start_no = 1;
					$loop_end_no = $no_of_pages+2 ;
				}else{
					$loop_start_no =1;					
					$loop_end_no = $no_of_pages+1;
				}	
					for ($count=$loop_start_no; $count<$loop_end_no; $count++){
						if ($_GET['page_no'] == $count){
							$selected = "selected = selected";
						}
		                echo "<option value='{$count}' $selected>{$count}</option>";
					}	
                ?>
            </select>
            </div>            
	        <div id="industry_page_no" class="defaultFont"><?php echo $page_message;?></div>	
        <?php
		}
		?>  	          	        
        </div>        
    	<div id="search_content_area">
        <?php 
			if ($_GET['task'] != 'search')
			{
		?>	
        	<div id="search_type_headers">
            	<input type="radio" class="login_type" id="basic_search" name="basic_search" value="1" checked="checked" style="margin-right:10px;" onclick="display_content('basic');" />Basic Search<br />
            	<input type="radio" class="login_type" id="advanced_search" name="basic_search" value="2"  <?php echo $advance_type_search; ?> style="margin-right:10px; margin-top:10px;" onclick="display_content('advanced');" />Advanced Search                
            </div>
				<?php
                if (($_GET['search_type'] == 'basic') || (!isset($_GET['search_type']))){
                ?>
                <div id="search_type_content_1">
                    <span>Enter the keyword to search</span>
                    <input type="text" name="search_query" id="search_query" /><br />
                    <input type="button" name="search_button" id="search_button" value="Search" style="margin-top:5px; margin-left:90px;" onclick="search_jobs('<?php echo $_GET['search_type'];?>');" />
                    <span id="example">ex: Php Developer ...</span>
                </div>
                <?php
                }
                if ($_GET['search_type'] == 'advance'){			
                ?>
                <div id="search_type_content_2">
                    <div id="advance_search_content_1">
                        <span style="margin-left:25px;">By Industry Type</span>
                        <select name="search_by_industry" id="search_by_industry" style="width:150px; margin-left:5px;">
                            <option value="0">Select Industry Type</option>                        
                        <?php
                            for ($i=0; $i<count($industries); $i++){
 		                        echo "<option value='{$industries[$i]['id']}' $selected>{$industries[$i]['name']}</option>";
                            }
                        ?>    
                        </select>            	            	
                        <span style="margin-left:20px;">By Company Name</span>
                        <select name="search_by_company" id="search_by_company" style="width:130px; margin-left:5px;">
                            <option value='0'>Select Company</option>                                                
                        <?php
                            for ($i=0; $i<count($clients); $i++){
                        ?>	
                            <option value='<?php echo $clients[$i]['client_id']; ?>'><?php echo $clients[$i]['company_name']; ?></option>                
                        <?php
                            }
                        ?>	    
                        </select>
                        <span style="display:block; float:left; margin-top:25px; margin-left:33px;">By Job Category</span>
                        <select name="search_by_job_cat" id="search_by_job_cat" style="width:150px; margin-top:20px; margin-left:5px;">
                            <option value='0'>Select Job Category</option>                                             
                        <?php
                            for ($i=0; $i<count($job_cats); $i++){				
                        ?>	
                            <option value='<?php echo $job_cats[$i]['job_cat_id']; ?>'><?php echo $job_cats[$i]['job_cat_name']; ?></option>                
                        <?php
                            }
                        ?>	    
                        </select>                            	            	
                        <span style="margin-left:45px;">By Location</span>
                        <select name="search_by_location" id="search_by_location" style="width:150px; margin-top:20px; margin-left:5px;">
                            <option value='0'>Select Location</option>                                             
                        <?php
                            foreach ($cities_array as $key => $value){
                        ?>	
                            <option value='<?php echo $value; ?>'><?php echo $value; ?></option>                
                        <?php
                            }
                        ?>	    
                        </select>                            	            	                        
                    </div>
                    <div id="advance_search_content_2">
                        <span style="margin-left:50px; margin-top:20px;">By years of Experience - Min:</span>
                        <select name="search_by_min_years" id="search_by_min_years" style="width:60px; margin-top:20px;">
                            <option value='-1'>Min :</option>                                                
                            <option value='0'>No Experience</option>                                
                        <?php
                            for ($i=1; $i<=5; $i++){				
                        ?>	
                            <option value='<?php echo $i; ?>'><?php echo $i; ?></option>                
                        <?php
                            }
                        ?>	    
                        </select>            	            	                                
                        <span style="margin-left:30px; margin-top:20px;">By years of Experience - Max:</span>
                        <select name="search_by_max_years" id="search_by_max_years" style="width:60px; margin-top:20px;">
                            <option value='0'>Max :</option>                                                
                        <?php
                            for ($i=1; $i<=10; $i++){				
                        ?>	
                            <option value='<?php echo $i; ?>'><?php echo $i; ?></option>                
                        <?php
                            }
                        ?>	    
                        </select>                 
                    </div>                
                    <div id="advance_search_content_3">
                        <span style="margin-left:120px;">Search Keyword</span>
                        <input type="text" name="search_query_advance" id="search_query_advance" />
                        <input type="submit" name="advanced_search_button" id="advanced_search_button" value="Search" onclick="search_jobs('<?php echo $_GET['search_type'];?>');" />
                    </div> 
                </div>
                <?php
                }
				?>
            <?php    
			}else{
				if (((count($vacancy_details)<=4) && (count($vacancy_details)!=0))){ 
			?>
                    <div class="industry_navigation defaultFont single_industry_navigation" style="height:250px;">
        			<?php
                        for ($n=0; $n<count($vacancy_details); $n++){															
        			?>
                        <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $vacancy_details[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $vacancy_details[$n]['title'];?></a></div>
                        <div class="vacancy_description" style="font-size:11px;"><?php echo $vacancy_details[$n]['description'];?></div>
                        <div style="height:10px; width:180px;"><!-- --></div>                
        			<?php				
                        }
			        ?>
                    </div>
            	<?php
				}else if (count($vacancy_details)>4){
				?>            
                <div class="industry_navigation defaultFont" style="height:250px;">
                	<?php
						for ($i=0; $i<count($vacancy_details); $i++, $php_counter++){
                             if ($i != 4){						
					?>	
                    <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $vacancy_details[$i]['id'];?>" class="vacancy_name_for_back"><?php echo $vacancy_details[$i]['title'];?></a></div>
                    <div class="vacancy_description" style="font-size:11px;"><?php echo $vacancy_details[$i]['description'];?></div>                
                    <div style="height:10px; width:180px;"><!-- --></div>                				                                		
                    <?php
							}else{
								break;
							}
						}
					?>
                </div>                                        
                <div class="industry_navigation defaultFont" style="height:250px;">
                	<?php
						for ($n=$php_counter; $n<8 ; $n++,$php_counter++){
                             if ($n != 8){						
					?>	                
                    <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $vacancy_details[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $vacancy_details[$i]['title'];?></a></div>
                    <div class="vacancy_description" style="font-size:11px;"><?php echo $vacancy_details[$i]['description'];?></div>                
                    <div style="height:10px; width:180px;"><!-- --></div>                				                                		
                    <?php
							}else{
								break;
							}
						}
					?>                    
                </div>                                        
                <div class="industry_navigation defaultFont" style="height:250px;">
					<?php
                        for ($n=$php_counter; $n<12 ; $n++,$php_counter++){
                            if ($n != 12){
                    ?>                
                    <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $vacancy_details[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $vacancy_details[$i]['title'];?></a></div>
                    <div class="vacancy_description" style="font-size:11px;"><?php echo $vacancy_details[$i]['description'];?></div>                
                    <div style="height:10px; width:180px;"><!-- --></div>                				                                		
					<?php
                            }else{
                                break;
                         	}
                    	}									
                    ?>		                                                
                </div>
                <?php
				}else{
				?>
                <div id="could_not_found">
                Sorry No Matching Search Results !                
                </div>
                <a href="#" onclick="javascript:history.go(-1);" class="back_link" style="margin-left:10px;">Back</a>
                <?php	
				}
				?>
                <div id="serach_result_pagination">                
                <?php				
                    if ($num_of_records > 0){
                        echo $link_message;
                    }		
                ?>                
                </div>                                                                       
            <?php
			}
			?>           
        </div>
    </div>
    <div id="rest_middle">
        <div id="rest_middle_1">
            <div class="bottom_headers">Advanced Features</div>
        </div>        
        <div id="rest_middle_2">
        	<div class="bottom_headers">Recruiters News</div>
        </div>           
    </div>
</div>