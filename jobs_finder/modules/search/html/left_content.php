<?php
	require_once("../display/display.php");	
	
	$job_cats = display_job_catgories();
?>
<div id ="left_content">
	<div id="job_category_area">
    	<div class="box_title">Job Category</div>
        <div id="job_category_content">
        	<div id="some_job_cats">
            <?php
				if (count($job_cats) > 0)
				{
					for ($i=0; $i<11; $i++)
					{
			?>
					<span class="job_cats"><a href="modules/industries/industries.php?task=show&type=job_cat" class="job-cat_names" title="<?php echo $job_cats[$i]['description'];?>"><?php echo $job_cats[$i]['job_cat_name'];?></a></span>				
			<?php				
					}
				}
			?>
            </div>
            <div id="show_all">
   	        	<span class="job_cats"><a href="modules/industries/industries.php?task=show_all&type=job_cat" class="job-cat_names">Show All</a></span>                                                                        
			</div>                    
        </div>    	
    </div>
	<div id="blog_area">
    	<div class="box_title">Blogs</div>
        <div id="small_blog_content">
        	" Hey this is nice man..... " "test"
        </div>
        <div id="see_all_posted"><span class="job_cats"><a href="index.php?task=showAllCats" class="job-cat_names">Show All Posted</a></span></div>
    </div>
	<div id="ads_area">
        <div id="ads_area_content_1">        	
        </div>        
        <div id="ads_area_content_2">
        	<span class="ads_area_text">Advertise</span>
        	<span class="ads_area_text">FAQ's</span>
        	<span class="ads_area_text">Media Room</span>                        
        </div>
    </div>         	
</div>