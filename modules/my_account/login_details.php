<?php
	if ($_GET['task'] != 'logged_in'){	
	
		if ($_GET['task'] == 'cl_log')
			$cl_log_checked = "checked = checked";
		if ($_GET['task'] == 'job_log')
			$job_log_checked = "checked = checked";	
		if (($_GET['task'] == 'log') || ($_GET['task'] == 'job_log') || ($_GET['task'] == 'cl_log'))
			$log_checked = "checked = checked";				
		if (($_GET['task'] == 'job_reg') || ($_GET['task'] == 'cl_reg') || ($_GET['task'] == 'reg'))
			$reg_checked = "checked = checked";				
	}
?>
<div id="ask_for_login" class="defaultFont">
	<table border="0" cellpadding="0" cellspacing="0">
    	<tr>
        	<td>
            <?php
				if (($_GET['task'] == 'reg') || ($_GET['task'] == 'job_reg') || ($_GET['task'] == 'cl_reg')){
			?>	
            <input type="radio" name="login_type_1" class="login_type" id="login_type_1" <?php echo $reg_checked; ?> value="1" border="0" onclick="submit_reg_value('job_reg');" />
            <?php
				}
				if ((!isset($_GET['task'])) || ($_GET['task'] == 'job_log') || ($_GET['task'] == 'cl_log') || ($_GET['task'] == 'log')){
			?>
            <input type="radio" name="login_type_1" class="login_type" id="login_type_1" <?php echo $job_log_checked;?> value="1" border="0" onclick="submit_login_value('job_log');" />            
            <?php
				}
			?>
            </td>                    
        	<td><span>I am a Job Seeker...</span></td>
        </tr>
    	<tr>
        	<td colspan="2"><div id="space_div_height_2"><!-- --></div></td>
        </tr>        
    	<tr>
        	<td>
            <?php
				if (($_GET['task'] == 'reg') || ($_GET['task'] == 'job_reg') || ($_GET['task'] == 'cl_reg')){
			?>	
            <input type="radio" name="login_type_2" class="login_type" id="login_type_2" <?php echo $reg_checked; ?> value="2" border="0" onclick="submit_reg_value('cl_reg');" />
            <?php
				}
				if ((!isset($_GET['task'])) || ($_GET['task'] == 'cl_log') || ($_GET['task'] == 'job_log') || ($_GET['task'] == 'log')){				
			?>
            <input type="radio" name="login_type_2" class="login_type" id="login_type_2" <?php echo $cl_log_checked;?> value="2" border="0" onclick="submit_login_value('cl_log');" />            
            <?php
				}
			?>	
            </td>            
        	<td><span>I am a Client...</span></td>            
        </tr> 
    </table>
</div>
<div id="login_info" class="defaultFont">
    <table border="0" cellspacing="0" cellpadding="0">
	<form name="login_form" action="" method="post">    
		<tr>
        	<td>Username</td>
            <td><input type="text" name="user_name" id="user_name" class="login_inputs" value="" /></td>
		</tr>
        <tr>
        	<td>Password</td>
            <td><input type="password" name="password" id="password" class="login_inputs" value="" /></td>
        </tr>           
        <tr>
        	<td colspan="2"><input type="button" name="login_button" id="login_button" value="login" onclick="check_login('<?php echo $_GET['task'];?>');" />
            </td>
        </tr>
        <tr>
        	<td colspan="2"><div id="login_info_div"></div></td>
        </tr>        
    </form>                           
    </table>               
</div>
<div id="asking_registered" class="defaultFont">
	<input type="checkbox" name="request_for_login" id="request_for_login" onclick="submit_the_request();" <?php echo $log_checked;?> /><span style="margin-left:5px;">I want to login ...</span><br /><br />
	<a href="#" class="new_login_link" onclick="get_details_for_sign_up('<?php echo $_GET['task'];?>');">Click Here to sign up...</a>
</div>
<div id="loginMessageBox" class="defaultFont">
</div>