<?php
	session_start();
	
	if ($_GET['task'] == 'cl_log'){	
		$header_content_title = "Client Login";
	}
	else if ($_GET['task'] == 'cl_reg'){	
		$header_content_title = "Client Registration";
	}	
	else if ($_GET['task'] == 'job_log'){	
		$header_content_title = "Jobseeker Login";
	}	
	else if ($_GET['task'] == 'job_reg'){	
		$header_content_title = "Jobseeker Registration";
	}
	else{
		$header_content_title = "Login / Registration";		
	}		
?>
<div id="middle_content">
<div id="link_header_title_for_main"><?php echo $header_content_title; ?></div>
    <div id="login_register_info_box">
        <?php
        if ((($_SESSION['cl_logged'] == false) || ($_SESSION['job_logged'] == false)) && (!isset($_GET['task']))){
			//redirecting to the login page 
            require('login_details.php');
        }
        if (isset($_SESSION['cl_logged']) && ($_GET['task'] != 'job_log') && ($_GET['task'] != 'cl_log')){
            //redirecting to the client profile page
			require('../clients/client_profile_manage.php');			
        }
        if (isset($_SESSION['job_logged']) && ($_GET['task'] != 'job_log') && ($_GET['task'] != 'cl_log')){
            //redirecting to the job seeker profile page            
			require('../jobseeker/seeker_profile_manage.php');					
        }
		if ($_GET['task'] == 'cl_reg'){
			//redirecting to the client registration page
			require('../clients/registration.php');
		}
		if (($_GET['task'] == 'cl_log') || ($_GET['task'] == 'job_log') || ($_GET['task'] == 'reg') || ($_GET['task'] == 'log')){
			//redirecting the client or the job seeker to the logging page		
			require('login_details.php');		
		}	
        ?>
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