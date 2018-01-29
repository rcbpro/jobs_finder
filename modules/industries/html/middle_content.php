<?php
/*
 File Name : middle_content.php - industry.php
 Purpose : Displaying the contents taken from the database and categorized and paginate
 Author : Mr.Nibraz
 Developers : Ruchira Chamara
 Development Date : 
*/
?>
<?php
	session_start();
	$php_counter = 0;		
	
	$file_path = $_SERVER['REQUEST_URI'];
	if ((strstr($file_path, "industries.php")) && (!isset($_GET['task']))){
		$can_load = true;
		$all_vacancies = show_all_vacancies('industries');
		$num_of_records = show_count_of_all_vacancies('industries');		
	}
	
	if (($_GET['task'] == 'show_all') && ($_GET['type'] == 'industry')){
		//Showing all industry records according to all industry names ...		
		$all_vacancies = show_all_vacancies($_GET['type']);
		$num_of_records = show_count_of_all_vacancies($_GET['type']);
		$content_title = "All Vacancies - Industry wise";				
		
	}else if (($_GET['task'] == 'show_all') && ($_GET['type'] == 'client')){
		//Showing all cleints records according to all client names ...	
		$all_vacancies = show_all_vacancies($_GET['type']);
		$num_of_records = show_count_of_all_vacancies($_GET['type']);
		$content_title = "All Vacancies - Company wise";				
		
	}else if (($_GET['task'] == 'show_all') && ($_GET['type'] == 'job_cat')){
		//Showing all job_category records according to all job category names ...			
		$all_vacancies = show_all_vacancies($_GET['type']);
		$num_of_records = show_count_of_all_vacancies($_GET['type']);
		$content_title = "All Vacancies - Job Category wise";						
		
	}else if (($_GET['task'] == 'show') && ($_GET['type'] == 'industry')){	
		//Showing the industry records according to the given industry name ...
		$all_vacancies_titles = show_all_vacancies_for_type($_GET['type'], $_GET['industry_id']);				
		$num_of_records = show_count_of_all_vacancies_for_type($_GET['type'], $_GET['industry_id']);
		$industry_name = get_industry_name_by_industry_id($_GET['industry_id']);		
		$content_title = "All Vacancies - {$industry_name}";										
		
	}else if (($_GET['task'] == 'show') && ($_GET['type'] == 'client')){	
		//Showing the records according to the given client name ...
		$all_vacancies_titles = show_all_vacancies_for_type($_GET['type'], $_GET['client_id']);		
		$num_of_records = show_count_of_all_vacancies_for_type($_GET['type'], $_GET['client_id']);		
		$client_name = get_client_name_by_client_id($_GET['client_id']);	
		$content_title = "All Vacancies - {$client_name}";								
		
	}else if (($_GET['task'] == 'show') && ($_GET['type'] == 'job_cat')){	
		//Showing the records according to the job category name ...
		$all_vacancies_titles = show_all_vacancies_for_type($_GET['type'], $_GET['job_cat_id']);		
		$num_of_records = show_count_of_all_vacancies_for_type($_GET['type'], $_GET['job_cat_id']);				
		$job_cat_name = get_job_cat_name_by_cat_id($_GET['job_cat_id']);		
		$content_title = "All Vacancies - {$job_cat_name}";								
		
	}else{	
		$content_title = "Industries";	
	}

	//Pagination Starts for both types of vacancy display
	$display_items = NO_OF_RECORDS_PER_PAGE;
	if (($_GET['type'] == 'industry') && ($_GET['task'] == 'show')){
		$link_concat = "type=" .$_GET['type'] ."&industry_id=" .$_GET['industry_id'];
		$id = $_GET['industry_id'];
	}	
	if ($_GET['type'] == 'client'){
		$link_concat = "type=" .$_GET['type'] ."&client_id=" .$_GET['client_id'];
		$id = $_GET['client_id'];
	}
	if ($_GET['type'] == 'job_cat'){
		$link_concat = "type=" .$_GET['type'] ."&job_cat_id=" .$_GET['job_cat_id'];	
		$id = $_GET['job_cat_id'];
	}
	if ($_GET['task'] == 'show_all'){
		$link_concat = "type=" .$_GET['type'];
	}
	if ($can_load){
		$link_concat = "";		
	}						
	
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
		
		if ($_GET['task'] == 'show'){
			$link = "industries.php?task=show&{$link_concat}&page_no={$page_no}";
		}
		if ($_GET['task'] == 'show_all'){		
			$link = "industries.php?task=show_all&{$link_concat}&page_no={$page_no}";		
		}
		if ($can_load){
			$link = "industries.php?{$link_concat}page_no={$page_no}";				
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
		
		if ($_GET['task'] == 'show'){
			$linkPrivous = "industries.php?task=show&{$link_concat}&page_no={$page_no}";
		}
		if ($_GET['task'] == 'show_all'){			
			$linkPrivous = "industries.php?task=show_all&{$link_concat}&page_no={$page_no}";
		}
		if ($can_load){
			$linkPrivous = "industries.php?{$link_concat}page_no={$page_no}";				
		}
					
			$previous = 'previous';
			$previousLink = "<a href = $linkPrivous class='industry_pag_links'>&lt;&lt; Previous</a>";	
		}
		$link_message = "$previousLink Showing $start_no to $end_no_remain of $num_of_records $nextLink";
		$page_message = "Page " . ($_GET['page_no'] + 1) . " of {$no_of_pages}";
	}
?>
<div id="middle_content">
	<div id="title_content_wrapper">
        <div id="link_header_title" style="width:380px;"><?php echo $content_title; ?></div>
        <div id="go_to_page_selection" style="width:200px;">Go To Page</div>
	</div>        
    <div id="industry_content">
        <div id="industry_page_no" class="defaultFont"><?php echo $page_message;?>	
            <select id="go_to_page" name="go_to_page" onchange="go_to_the_selected_page('<?php echo $_GET['task'];?>', '<?php echo $_GET['type'];?>','<?php echo $id;?>')">
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
        <div id="industry_navigation">
        		<?php
					if ((($_GET['task'] == 'show_all') && (!$can_load)) && (($_GET['type'] == 'client') || ($_GET['type'] == 'industry') || ($_GET['type'] == 'job_cat'))){	
						if (count($all_vacancies)<=4){	
				?>
            				<div class="industry_navigation defaultFont single_industry_navigation">
                <?php
								for ($n=0; $n<count($all_vacancies); $n++){															
				?>
                                <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $all_vacancies[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $all_vacancies[$n]['title'];?></a></div>
                                <div class="vacancy_description" style="font-size:11px;"><?php echo $all_vacancies[$n]['description'];?></div>
                                <div style="height:10px; width:180px;"><!-- --></div>                
                <?php				
								}
				?>
                			</div>
                <?php				
						}else{
				?>	
                            <div class="industry_navigation defaultFont">
                                <?php
                                    for ($n=0; $n<count($all_vacancies); $n++,$php_counter++){
                                        if ($n != 4){
								?>		
                                <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $all_vacancies[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $all_vacancies[$n]['title'];?></a></div>
                                <div class="vacancy_description" style="font-size:11px;"><?php echo $all_vacancies[$n]['description'];?></div>                
                                <div style="height:10px; width:180px;"><!-- --></div>                				
                                <?php                                
                                        }else{
											break;
                                     }
                         		}
                                ?>
                            </div>
                            <div class="industry_navigation defaultFont">
                                <?php
                                    for ($n=$php_counter; $n<8 ; $n++,$php_counter++){
                                        if ($n != 8){
								?>
                                <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $all_vacancies[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $all_vacancies[$n]['title'];?></a></div>
                                <div class="vacancy_description" style="font-size:11px;"><?php echo $all_vacancies[$n]['description'];?></div>                
                                <div style="height:10px; width:180px;"><!-- --></div>                				                                		
                            	<?php
                                        }else{
											break;
                                     }
                         		}									
								?>		
                            </div>                            
                            <div class="industry_navigation defaultFont">
                                <?php
                                    for ($n=$php_counter; $n<12 ; $n++,$php_counter++){
                                        if ($n != 12){
								?>
                                <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $all_vacancies[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $all_vacancies[$n]['title'];?></a></div>
                                <div class="vacancy_description" style="font-size:11px;"><?php echo $all_vacancies[$n]['description'];?></div>                
                                <div style="height:10px; width:180px;"><!-- --></div>                				                                		
                            	<?php
                                        }else{
											break;
                                     }
                         		}									
								?>		                            
							</div>                            
                <?php            
					}
                }    
				?>
				<?php	
					if ((($_GET['task'] == 'show') && (!$can_load)) && (($_GET['type'] == 'industry') || ($_GET['type'] == 'client') || ($_GET['type'] == 'job_cat'))){	
						if (isset($_GET['industry_id'])){
							$id = $_GET['industry_id'];
						}
						if (isset($_GET['client_id'])){
							$id = $_GET['client_id'];							
						}
						if (isset($_GET['job_cat_id'])){
							$id = $_GET['job_cat_id'];							
						}						
						$vacancy_short_list = show_all_vacancies_for_type($_GET['type'], $id);				
						if (count($vacancy_short_list) <=4){ 
				?>		
            <div class="industry_navigation defaultFont single_industry_navigation">
            	<?php                
							for ($n=0; $n<count($vacancy_short_list); $n++){											
				?>				
                                <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $vacancy_short_list[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $vacancy_short_list[$n]['title'];?></a></div>
                                <div class="vacancy_description" style="font-size:11px;"><?php echo $vacancy_short_list[$n]['description'];?></div>
                                <div style="height:10px; width:180px;"><!-- --></div>
                <?php            
							}
				?>
             </div>
                <?php			
						}else{
				?>
                            <div class="industry_navigation defaultFont">
                                <?php
                                    for ($n=0; $n<count($vacancy_short_list); $n++,$php_counter++){
                                        if ($n != 4){
								?>		
                                <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $vacancy_short_list[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $vacancy_short_list[$n]['title'];?></a></div>
                                <div class="vacancy_description" style="font-size:11px;"><?php echo $vacancy_short_list[$n]['description'];?></div>                
                                <div style="height:10px; width:180px;"><!-- --></div>                				
                                <?php                                
                                        }else{
											break;
                                     }
                         		}
                                ?>
                            </div>
                            <div class="industry_navigation defaultFont">
                                <?php
                                    for ($n=$php_counter; $n<8 ; $n++,$php_counter++){
                                        if ($n != 8){
								?>
                                <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $vacancy_short_list[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $vacancy_short_list[$n]['title'];?></a></div>
                                <div class="vacancy_description" style="font-size:11px;"><?php echo $vacancy_short_list[$n]['description'];?></div>                
                                <div style="height:10px; width:180px;"><!-- --></div>                				                                		
                            	<?php
                                        }else{
											break;
                                     }
                         		}									
								?>		
                            </div>                            
                            <div class="industry_navigation defaultFont">
                                <?php
                                    for ($n=$php_counter; $n<12 ; $n++,$php_counter++){
                                        if ($n != 12){
								?>
                                <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $vacancy_short_list[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $vacancy_short_list[$n]['title'];?></a></div>
                                <div class="vacancy_description" style="font-size:11px;"><?php echo $vacancy_short_list[$n]['description'];?></div>                
                                <div style="height:10px; width:180px;"><!-- --></div>                				                                		
                            	<?php
                                        }else{
											break;
                                     }
                         		}									
								?>		                            
							</div>                            
                <?php		
						}						
					}
					if ($can_load){
						if (count($all_vacancies)<=4){						
				?>
            				<div class="industry_navigation defaultFont single_industry_navigation">
                <?php
								for ($n=0; $n<count($all_vacancies); $n++){															
				?>
                                <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $all_vacancies[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $all_vacancies[$n]['title'];?></a></div>
                                <div class="vacancy_description" style="font-size:11px;"><?php echo $all_vacancies[$n]['description'];?></div>
                                <div style="height:10px; width:180px;"><!-- --></div>                
                <?php				
								}
				?>
                			</div>
                <?php				
						}else{
				?>	
                            <div class="industry_navigation defaultFont">
                                <?php
                                    for ($n=0; $n<count($all_vacancies); $n++,$php_counter++){
                                        if ($n != 4){
								?>		
                                <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $all_vacancies[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $all_vacancies[$n]['title'];?></a></div>
                                <div class="vacancy_description" style="font-size:11px;"><?php echo $all_vacancies[$n]['description'];?></div>                
                                <div style="height:10px; width:180px;"><!-- --></div>                				
                                <?php                                
                                        }else{
											break;
                                     	}
                         			}
                                ?>
                            </div>
                            <div class="industry_navigation defaultFont">
                                <?php
                                    for ($n=$php_counter; $n<8 ; $n++,$php_counter++){
                                        if ($n != 8){
								?>
                                <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $all_vacancies[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $all_vacancies[$n]['title'];?></a></div>
                                <div class="vacancy_description" style="font-size:11px;"><?php echo $all_vacancies[$n]['description'];?></div>                
                                <div style="height:10px; width:180px;"><!-- --></div>                				                                		
                            	<?php
                                        }else{
											break;
                                     	}
                         			}									
								?>		
                            </div>                            
                            <div class="industry_navigation defaultFont">
                                <?php
                                    for ($n=$php_counter; $n<12 ; $n++,$php_counter++){
                                        if ($n != 12){
								?>
                                <div class="vacancy_name" style="height:15px; font-size:11px;"><a href="apply_vacancies.php?task=apply&vacancy_id=<?php echo $all_vacancies[$n]['id'];?>" class="vacancy_name_for_back"><?php echo $all_vacancies[$n]['title'];?></a></div>
                                <div class="vacancy_description" style="font-size:11px;"><?php echo $all_vacancies[$n]['description'];?></div>                
                                <div style="height:10px; width:180px;"><!-- --></div>                				                                		
                            	<?php
                                        }else{
											break;
                                     	}
                         			}									
								?>		                            
							</div>                                            
                <?php					
						}	
					}	
				?>
        </div>
        <div id="industry_pagination" class="defaultFont">
        <?php
			if ($num_of_records > 0){
				echo $link_message;
			}		
		?>
        </div> 
    </div>
    <div id="rest_middle" class="marginAuto">
        <div id="rest_middle_1">
            <div class="bottom_headers">Advanced Features</div>
        </div>        
        <div id="rest_middle_2">
        	<div class="bottom_headers">Recruiters News</div>
        </div>           
    </div>
</div>