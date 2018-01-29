<?php
	$company_names = show_vacancy_company_names_for_front();
	$industry_names = show_industry_names_for_front();	
	$job_cat_names = show_job_cat_names_for_front();	
?>
<div id="middle_content">
<div id="link_header_title_for_main">Latest Hiring</div>
	<div id="box_wrappers">
        <!-- company_box -->
        <div id="company_box" class="commonProperty">
            <div class="box_header">Companies</div>	
            <div class="box_middle defaultFont">
            	<div class ="company_content">
                <?php            
					for ($i=0; $i<5; $i++){
				?>
                    <div class="com_name_for_front"><a href="modules/industries/industries.php?task=show&type=client&client_id=<?php echo $company_names[$i]['client_id']; ?>" 
                    class="com_name_for_front"><?php echo $company_names[$i]['company_name']; ?></a></div>
                    <?php
						for ($n=0; $n<count(show_client_vacancies_for_front($company_names[$i]['client_id'])); $n++){
								echo show_client_vacancies_for_front($company_names[$i]['client_id']);
						}
					}                  
				?>					
				</div>                    
                <div class="show_all_for_three_boxes defaultFont"><a href="modules/industries/industries.php?task=show_all&type=client">Show All</a>&nbsp;&gt;&gt;</div>
            </div>	
            <div class="box_bottom"><!-- --></div>	                                        
        </div>
        <!-- industry_box -->    
        <div id="industry_box" class="commonProperty">
            <div class="box_header ">Industries</div>	
            <div class="box_middle  defaultFont">
            	<div class="company_content">
                <?php
					for ($i=0; $i<5; $i++){
				?>
                    <div class="ind_name_for_front"><a href="modules/industries/industries.php?task=show&type=industry&industry_id=<?php echo $industry_names[$i]['industry_id']; ?>" 
                    class="ind_name_for_front"><?php echo $industry_names[$i]['industry_name']; ?></a></div>
                    <?php
						for ($n=0; $n<count(show_vacancies_for_industries_for_front($industry_names[$i]['industry_id'])); $n++){
								echo show_vacancies_for_industries_for_front($industry_names[$i]['industry_id']);
						}
					}
				?>                      
                </div>    
                <div class="show_all_for_three_boxes defaultFont"><a href="modules/industries/industries.php?task=show_all&type=industry">Show All</a>&nbsp;&gt;&gt;</div>                        
            </div>	
            <div class="box_bottom "><!-- --></div>	                                                        
        </div>
        <!-- category_box -->        
        <div id="category_box" class="commonProperty">
            <div class="box_header">Categories</div>	
            <div class="box_middle defaultFont">
            	<div class="company_content">
                <?php
					for ($i=0; $i<5; $i++){										
				?>
                    <div class="cat_name_for_front"><a href="modules/industries/industries.php?task=show&type=job_cat&job_cat_id=<?php echo $job_cat_names[$i]['job_cat_id']; ?>" 
                    class="cat_name_for_front"><?php echo $job_cat_names[$i]['job_cat_name'];?></div>                                            
                    <?php
						for ($n=0; $n<count(show_vacancies_for_job_categories_for_front($job_cat_names[$i]['job_cat_id'])); $n++){
								echo show_vacancies_for_job_categories_for_front($job_cat_names[$i]['job_cat_id']);
						}
					}
				?>    
                </div>    
                <div class="show_all_for_three_boxes defaultFont"><a href="modules/industries/industries.php?task=show_all&type=job_cat">Show All</a>&nbsp;&gt;&gt;</div>            
            </div>	
            <div class="box_bottom"><!-- --></div>	                                                        
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