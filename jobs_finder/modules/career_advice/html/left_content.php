<?php
	require_once("../display/display.php");
	
	$job_cats = display_job_catgories();
?>
<div id ="left_content">
	<div id="job_category_area">
    	<span class="box_title">Job Category</span>
        <div id="job_category_content">
        	<div id="some_job_cats">
            <?php
				if (count($job_cats) > 0)
				{
					for ($i=0; $i<count($job_cats); $i++)
					{
			?>
					<li class="job_cats"><a href="index.php?task=showJobCats" class="job-cat_names" title="<?php echo $job_cats[$i]['description'];?>"><?php echo $job_cats[$i]['job_cat_name'];?></a></li>				
			<?php				
					}
				}
			?>
            </div>
            <div id="show_all">
   	        	<span class="job_cats"><a href="index.php?task=showAllCats" class="job-cat_names">Show All</a></span>                                                                        
			</div>                    
        </div>    	
    </div>
	<div id="blog_area">
    	<span class="box_title">Blogs</span>
        <div id="small_blog_content">
        	" Hey this is nice man..... "
        </div>
    </div>
	<div id="ads_area">
    	<span class="box_title"></span>
        <div id="ads_area_content_1">        	
        </div>        
        <div id="ads_area_content_2">
        	<span class="ads_area_text">Advertise</span>
        	<span class="ads_area_text">FAQ's</span>
        	<span class="ads_area_text">Media Room</span>                        
        </div>
    </div>         	
</div>