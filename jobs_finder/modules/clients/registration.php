<?php
	session_start();
	require('../../modules/send_email/send_email.php');		

	if ((!isset($_GET['step'])) && ($_GET['status'] == 'registered')){		
		$mail = $_POST['email'];
		$mail_data = explode("@", $mail);
		$mail_server = "www.".$mail_data[1];
		$random_no = mt_rand();			
		
		$from_header =  "job2morrow.com"; 
		$from = USER_ACTIVATION_EMAIL;
		
		$contents = "Dear " . $_SESSION['contact_name'] .",\n \n Thank you for registering with job2morrow!\n \n To confirm your registration, please click the following link.\n \n <a href='http://www.job2morrow.com/modules/clients/check_paramas.php?task=activate&type=client&rand_no=" . $random_no ."' class='link'>Activate Me ...</a>\n \n With thanks, \n \n www.job2morrow.com.";
		$subject = "Registration Confirmation";
	
		if(!send_email($subject, $from, $from_header, $contents,'', '', '', $email, '', '')){
			echo "<span style='color:#ff0000; font-size:16px; font-weight:bold;'>Email Send failed..</span>";
		}else{	
?>	
	<div class="space_div_height"><!-- --></div>
	<div id= "registerd_success" class="defaultFont" style="width:450px; margin-left:100px; margin-top:50px;">&quot; You Have Successfully registered to our system. Please <a href="http://<?php echo $mail_server; ?>" class="activation_mail">check your mail</a> to activate your account. Thank you... &quot;
    </div>
<?php	
		}
}
if ((!isset($_GET['step'])) && ($_GET['status'] != 'registered'))
{
?>
<table id="client_register_1" class="defaultFont" border="0" cellpadding="0" cellspacing="0" style="height:300px; width:120px; padding-left:80px;">
	<form name="client_register_1" action="" method="post">
	<tr>
    	<td colspan="2">
        	<div class="genaral_info defaultFont">Company General Information</div>        
        </td>
    </tr>
	<tr>
    	<td>Name of Company
        </td>
        <td><input type="text" name="txtCompanayName" id="txtCompanayName" /><span class="importantFeild">*</span>
        </td>
    </tr>
	<tr>
    	<td>Address
        </td>
        <td><textarea name="txtCompanyAddress" id="txtCompanyAddress"></textarea>
        </td>
    </tr>
	<tr>
    	<td>Country
        </td>
        <td>
        <select name="txtCompanayCountry" id="txtCompanayCountry">
        	<?php
				foreach($country_array as $key => $value){
					echo "<option value='{$value}'>{$value}</option>";
				}
			?>
        </select><span class="importantFeild">*</span>
        </td>
    </tr>        
	<tr>
    	<td>City
        </td>
        <td><input type="text" name="txtCompanayCity" id="txtCompanayCity" /><span class="importantFeild">*</span>
        </td>
    </tr>        
	<tr>
    	<td>Industry
        </td>
        <td>
        <select name="industryType" id="industryType" style="width:250px;">
			<?php
				foreach($industry_array as $key=>$value){
					echo "<option value='{$key}'>{$value}</option>";
				}
			?>	
        </select><span class="importantFeild">*</span>
        </td>
    </tr>            
    <tr>
    	<td colspan="2">
        	<input type="button" name="btn_Continue" id="btn_Continue" value="Continue >>" onclick="validateFirstStep();" />
        </td>
    </tr>
    <tr>
    	<td colspan="2"><div id="message_box_1" style="height:40px; width:200px; margin-right:80px; float:right;"></div>
        </td>
    </tr>
    </form>
</table>
<?php
}
else if ($_GET['step'] == '1')
{
?>
<table id="client_register_2" class="defaultFont" border="0" cellpadding="0" cellspacing="0" style="height:300px; width:120px; padding-left:80px;">
	<form name="client_register_2" action="" method="post">
	<tr>
    	<td colspan="2">
        	<div class="genaral_info defaultFont" style="padding-left:120px;">Company Contact Details</div>
        </td>
    </tr>
	<tr>
        <td>Contact Person
        </td>
        <td><input type="text" name="txtContactName" id="txtContactName" /><span class="importantFeild">*</span>
        </td>
    </tr>
	<tr>
    	<td>Salutation
        </td>
        <td>
        	<select name="salutation" id="salutation">
            	<option value="1">Mr.</option>
            	<option value="2">Miss.</option>
            	<option value="3">Mrs.</option>
            </select><span class="importantFeild">*</span>
        </td>
    </tr>                
	<tr>
    	<td>Designation
        </td>
        <td><input type="text" name="txtClDesignation" id="txtClDesignation" /><span class="importantFeild">*</span>
        </td>
    </tr>
	<tr>
    	<td>Phone No
        </td>
        <td><input type="text" name="txtClPhone" id="txtClPhone" /><span class="importantFeild">*</span>
        </td>
    </tr>        
	<tr>
    	<td>Alternative Phone No
        </td>
        <td><input type="text" name="txtAltPhone" id="txtAltPhone" />
        </td>
    </tr>        
	<tr>
    	<td>Fax No:
        </td>
        <td><input type="text" name="txtClFax" id="txtClFax" />
        </td>
    </tr>            
    <tr>
    	<td colspan="2"><input type="button" name="btn_Continue_2" id="btn_Continue_2" value="Continue >>" onclick="validateSecondStep();" />
        </td>
    </tr>
    <tr>
    	<td colspan="2"><div id="message_box_2" style="height:40px; width:200px; margin-right:80px; float:right;"></div>
        </td>
    </tr>    
    </form>
</table>
<?php
}
else if ($_GET['status'] != 'registered')
{
?>
<table id="client_register_3" class="defaultFont" border="0" cellpadding="0" cellspacing="0" style="height:300px; width:120px; padding-left:80px;">
	<form name="client_register_2" action="" method="post">
	<tr>
    	<td colspan="2">
        	<div class="genaral_info defaultFont" style="padding-left:130px;">Company Login Details</div>        
        </td>
    </tr>
	<tr>
        <td>User Name
        </td>
        <td><input type="text" name="txtClUserName" id="txtClUserName" /><span class="importantFeild">*</span>
        </td>
    </tr>
	<tr>
        <td>&nbsp;</td>
        <td><span><img src="../../images/site_Images/available.jpg" onClick="user_name_availability();" style="vertical-align:bottom; cursor:pointer; float:left;" /></span>
        <div id="user_available_chk"></div>
        </td>
    </tr>    
	<tr>
    	<td>Password
        </td>
        <td><input type="password" name="txtClPassword" id="txtClPassword" /><span class="importantFeild">*</span>
        </td>
    </tr>
	<tr>
    	<td>Confirm Password
        </td>
        <td><input type="password" name="txtClConfirmPass" id="txtClConfirmPass" /><span class="importantFeild">*</span>
        </td>
    </tr>        
	<tr>
    	<td>Email Address
        </td>
        <td><input type="text" name="txtClEmail" id="txtClEmail" /><span class="importantFeild">*</span>
        </td>
    </tr>        
	<tr>
        <td><a href="#" onclick="document.getElementById('image').src = '../../library/securimage/securimage_show.php?sid=' + Math.random(); return false">Reload Image</a></td>    
    	<td><img id="image" name="image" src="../../library/securimage/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>"></td>
    </tr>            
	<tr>
    	<td>Security Code
        </td>
        <td><input type="text" name="txtCaptchaCode" id="txtCaptchaCode" onmouseout="spam_check();" value="<?php if (isset($_GET['v_code'])) echo $_GET['v_code'];?>" /><span class="importantFeild">*</span>
        </td>
    </tr>                
    <tr>
    	<td colspan="2"><input type="button" name="btn_Continue_3" id="btn_Continue_3" value="Register" onclick="validateThirdStep();" />
        </td>
    </tr>
    <tr>
    	<td colspan="2"><div id="message_box_3" style="height:40px; width:300px; margin-right:80px; float:right;"></div>
        </td>
    </tr>        
    </form>
</table>
<?php
}
?>