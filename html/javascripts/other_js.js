// JavaScript Document

var OPERATION_PATH = "http://localhost/jobs_finder/system/system.php";
var error = false;
var errMessage = "";

//Browser Detection 
//<![CDATA[
if ((BrowserDetect.browser == "Explorer" ) && (BrowserDetect.version == "6.0"))
	document.write("<link rel='stylesheet' type='text/css' href='html/css/ie6.css' />");
		   
if ((BrowserDetect.browser == "Explorer" ) && (BrowserDetect.version == "7.0"))
	document.write("<link rel='stylesheet' type='text/css' href='html/css/ie7.css' />");
//]]>	

function validateandsubmit(){	
	var error = "";
	
	if (document.login_page.username.value == "")
		error += "Please enter your username.\r\n";
	if (document.login_page.password.value == "")
		error += "Please enter your password.\r\n";
	if (error.length > 0)
		alert(error);
	else
		document.login_page.submit();
}

function go_to_the_selected_page(task, type, id){
	
	var go_to_page = document.getElementById('go_to_page').value -1;
	if (task == 'show'){
		location.href = 'industries.php?task=show&type=' + type + "&" + type + "_id=" + id + "&page_no=" + go_to_page;
	}
	if (task == 'show_all'){
		location.href = 'industries.php?task=show_all&type=' + type + "&page_no=" + go_to_page;
	}
	if (task == ''){
		location.href = 'industries.php?page_no=' + go_to_page;		
	}
}

function go_to_search_page(type, search_keyword){
	
	var go_to_page = document.getElementById('go_to_page').value -1;
	location.href = 'search.php?task=search&type=' + type + "&search_query=" + search_keyword + "&page_no=" + go_to_page;
}

function validateFirstStep(){	
	
	var message_box_1 = '#message_box_1';
	var txtCompanayName = '#txtCompanayName';
	var txtCompanyAddress = '#txtCompanyAddress';
	var txtCompanayCity = '#txtCompanayCity';
	var btn_Continue = '#btn_Continue';
	var industryType = '#industryType';	
	var companyCountry = '#txtCompanayCountry';
	
	// Validate the First form	
	if ($(txtCompanayName).val() == ''){
		window.error = true;
		window.errMessage += "<li>Please enter the company name ...</li>";
		$(message_box_1).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);						
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_1).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}
	if ($(txtCompanayCity).val() == ''){
		window.error = true;
		window.errMessage += "<li>Please enter the City located ...</li>";
		$(message_box_1).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);									
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_1).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}
	if ($(industryType).val() == 0){
		window.error = true;
		window.errMessage += "<li>Please Select the Country ...</li>";
		$(message_box_1).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);									
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_1).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}
	if ($(companyCountry).val() == 'All'){
		window.error = true;
		window.errMessage += "<li>Please Select the Industry type ...</li>";
		$(message_box_1).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);									
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_1).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}	
	
	if(window.error == false){
		window.errorMessage="Data you have been entered will be processed.. please wait..";
		$(message_box_1).html(window.errorMessage).removeClass().addClass('MessageBoxWarning').fadeIn(1000);
		$(btn_Continue).attr('disabled',true);
		
		window.errorMessage = "Getting you registered .... Step 1";				
		$(message_box_1).html(window.errorMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);

		$.post(OPERATION_PATH,{action:'validate_first_step',company_name:$(txtCompanayName).val(),address:$(txtCompanyAddress).val(), company_city:$(txtCompanayCity).val(), industry:$(industryType).val(), country:$(companyCountry).val()},function(data)
		{
				
			if(data=='yes'){
				window.errorMessage = "Validation Success....";				
				$(message_box_1).html(window.errorMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);
				$(btn_Continue).attr('disabled',true);				
				window.location.href = 'my_account.php?task=cl_reg&step=1';									
			}
			else{ 
				window.error=true;
				window.errorMessage = "<li> Data registration error occured ! .. Try again...</li>";
				$(message_box_1).html(window.errorMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);
				$(btn_Continue).attr('disabled',true);
			}
		});			
			
	}else{
		$(message_box_1).html(window.errorMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);
		$(btn_Continue).attr('disabled',false);
		window.errorMessage="";
	}
}

function validateSecondStep(){	
	
	var message_box_2 = '#message_box_2';
	var txtContactName = '#txtContactName';
	var txtClDesignation = '#txtClDesignation';
	var txtClPhone = '#txtClPhone';
	var txtAltPhone = '#txtAltPhone';
	var txtClFax = '#txtClFax';	
	var salutation = '#salutation';
	var btn_Continue_2 = '#btn_Continue_2';
	
	// Validate the Second form	
	if ($(txtContactName).val()== ''){
		window.error = true;
		window.errMessage += "<li>Please enter the company name ...</li>";
		$(message_box_2).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);						
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_2).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}
	if ($(txtClDesignation).val() == ''){
		window.error = true;
		window.errMessage += "<li>Please enter the City located ...</li>";
		$(message_box_2).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);									
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_2).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}
	if ($(txtClPhone).val() == ''){
		window.error = true;
		window.errMessage += "<li>Please Select the Country ...</li>";
		$(message_box_2).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);									
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_2).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}
	if ($(salutation).val() == ''){
		window.error = true;
		window.errMessage += "<li>Please Select the Salutation ...</li>";
		$(message_box_2).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);									
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_2).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}
	
	if(window.error == false){
		window.errorMessage="Data you have been entered will be processed.. please wait..";
		$(message_box_2).html(window.errorMessage).removeClass().addClass('MessageBoxWarning').fadeIn(1000);
		$(btn_Continue_2).attr('disabled',true);
		
		window.errorMessage = "Getting you registered .... Step 2";				
		$(message_box_2).html(window.errorMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);

		$.post(OPERATION_PATH,{action:'validate_second_step',contact_name:$(txtContactName).val(),designation:$(txtClDesignation).val(), phone_no:$(txtClPhone).val(), alt_phone_no:$(txtAltPhone).val(), fax_no:$(txtClFax).val(), sal:$(salutation).val()},function(data)
		{

			if(data=='yes'){
				window.errorMessage = "Validation Success....";				
				$(message_box_2).html(window.errorMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);
				$(btn_Continue_2).attr('disabled',true);				
				window.location.href = 'my_account.php?task=cl_reg&step=2';									
			}
			else{ 
				window.error=true;
				window.errorMessage = "<li> Data registration error occured ! .. Try again...</li>";
				$(message_box_2).html(window.errorMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);
				$(btn_Continue_2).attr('disabled',false);
			}
		});
	}
}

function validateThirdStep(){	
	
	var message_box_3 = '#message_box_3';
	var txtClUserName = '#txtClUserName';
	var txtClPassword = '#txtClPassword';
	var txtClConfirmPass = '#txtClConfirmPass';
	var txtClEmail = '#txtClEmail';
	var txtCaptchaCode = '#txtCaptchaCode';
	var btn_Continue_3 = '#btn_Continue_3';
	
	// Validate the Second form	
	if ($(txtClUserName).val()== ''){
		window.error = true;
		window.errMessage += "<li>Please enter the User name ...</li>";
		$(message_box_3).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);						
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_3).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}
	if ($(txtClUserName).length < 6){
		window.error = true;
		window.errMessage += "<li>User name must be more than 6 characters ...</li>";				
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_3).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}	
	if ($(txtClPassword).val() == ''){
		window.error = true;
		window.errMessage += "<li>Please enter the Password ...</li>";
		if ($(txtClPassword).length < 6){
			window.error = true;
			window.errMessage += "<li>Password must be more than 6 charactoers ...</li>";				
		}
		$(message_box_3).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);									
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_3).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}
	if ($(txtClConfirmPass).val() == ''){
		window.error = true;
		window.errMessage += "<li>Please enter the password again to confirm ...</li>";		
		if ($(txtClConfirmPass).val() != $(txtClPassword).val()){
			window.error = true;
			window.errMessage += "<li>Password mismatch !</li>";				
		}		
		$(message_box_3).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);									
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_3).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}
	
	var EmailTest = (!/.+@.+\.[a-zA-Z]{2,4}$/.test($(txtClEmail).val()));

	if($(txtClEmail).val() == '' && EmailTest){ 
		window.error = true;
		window.errMessage += "<li> Invalid Email Address ...</li>";	
		$(message_box_3).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);											
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_3).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}
	if ($(txtCaptchaCode).val() == ''){
		window.error = true;
		window.errMessage += "<li> Invalid Security Code ...</li>";	
		$(message_box_3).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);														
	}else{
		window.error = false;
		window.errMessage = "";
		$(message_box_3).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);	
	}

	if(window.error == false){
		window.errorMessage="Data you have been entered will be processed.. please wait..";
		$(message_box_3).html(window.errorMessage).removeClass().addClass('MessageBoxWarning').fadeIn(1000);
		$(message_box_3).attr('disabled',true);
		
		window.errorMessage = "Getting you registered .... Steps Completed...";				
		$(message_box_3).html(window.errorMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);

		$.post(OPERATION_PATH,{action:'validate_third_step',u_name:$(txtClUserName).val(),password:$(txtClPassword).val(), email:$(txtClEmail).val(), security_code:$(txtCaptchaCode).val()},function(data)
		{

			if(data=='yes'){
				window.errorMessage = "Validation Success....";				
				$(message_box_3).html(window.errorMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);
				$(btn_Continue_3).attr('disabled',true);				
				window.location.href = 'my_account.php?task=cl_reg&status=registered';									
			}
			else{ 
				window.error=true;
				window.errorMessage = "<li> Data registration error occured ! .. Try again...</li>";
				$(message_box_3).html(window.errorMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);
				$(btn_Continue_3).attr('disabled',false);
			}
		});
	}
}

function user_name_availability(){
	
	var userName = document.client_register_2.txtClUserName.value;

	if (userName != '')	{

		new Ajax.Request('../clients/check_paramas.php?task=chk_uname&user_name=' + userName ,
		{
			method:'GET',
			onSuccess: function(transport){ 
			
				var response = transport.responseText;

				var divUserName = document.getElementById('user_available_chk');

				if (response=="1"){
					divUserName.style.color="#ff0000";
					divUserName.innerHTML = "User Name Not Availabale";
				}
				else{
					divUserName.style.color="#008800";
					divUserName.innerHTML = "User Name Availabale";
				}

			},
			onFailure: function(){ alert('Something went wrong...') }
		});
	}
}

function spam_check(){
	
	var verification_code = document.client_register_2.txtCaptchaCode.value;

	if (verification_code != ''){

		new Ajax.Request('../clients/check_paramas.php?task=spam_chk&v_code=' + verification_code ,
		{
			method:'GET',
			onSuccess: function(transport){ 
			
				var response = transport.responseText;

				var div_message_box = document.getElementById('message_box_3');
				var div_v_code = document.getElementById('txtCaptchaCode');	

				if (response=="1"){
					div_message_box.style.color="#008800";
					div_message_box.innerHTML = "Verification Code succes";
					div_v_code.value = "";
				}else{
					div_message_box.style.color="#ff0000";
					div_message_box.innerHTML = "Verification code Incorrect !";
				}

			},
			onFailure: function(){ alert('Something went wrong...') }

		});
	}	
}

function get_details_for_sign_up(task){
	
	if ((document.getElementById('login_type_1').checked == false) || (document.getElementById('login_type_2').checked == false)){
		if (task == ''){
			alert("Please select the user type !");
		}
		location.href = 'my_account.php?task=reg';
	}
}

function submit_login_value(type){	
	
	if (type == 'job_log'){
		location.href = 'my_account.php?task=job_log';
	}else{
		location.href = 'my_account.php?task=cl_log';		
	}
}

function submit_the_request(){
		location.href = 'my_account.php?task=log';
}

function submit_reg_value(type, task){
	
	if (type == 'job_reg'){
		location.href = 'my_account.php?task=job_reg';
	}else{
		location.href = 'my_account.php?task=cl_reg';		
	}	
}

function check_login(type){
	
	var uname = '#user_name';
	var pass = '#password';
	var login_info_div = '#login_info_div';
	var login_button = '#login_button';
	
	if (type == 'cl_log')
		var action_status = 'check_user_cli';
	if (type == 'job_log')
		var action_status = 'check_user_job';		

	if ($(uname).val() == ''){
		window.error = true;
		window.errMessage +=  "<li>Please Enter the name</li><br />";
	}else{
		window.error = false;
		window.errMessage +=  "";
	}
	if ($(pass).val() == ''){
		window.error = true;
		window.errMessage +=  "<li>Please Enter the Password</li>";
	}else{
		window.error = false;
		window.errMessage +=  "";
	}
	
	if(window.error==false){
		
		$(login_info_div).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);

		window.errMessage="Validating your Username & password from the database.. please wait..";
		$(login_info_div).html(window.errMessage).removeClass().addClass('MessageBoxWarning').fadeIn(1000);
		$(login_button).attr('disabled',true);
		
		$.post(OPERATION_PATH,{action:action_status,User_Name:$(uname).val(),Password:$(pass).val()},function(data){ 
			if(data=='yes'){ 
				window.errMessage = "Login Success....";				
				$(login_info_div).html(window.errMessage).removeClass().addClass('MessageBoxOk').fadeIn(1000);
				$(login_button).attr('disabled',true);				
				if (type == 'cl_log'){
					window.location.href = 'my_account.php?task=logged_in&type=cli_user';									
				}
				if (type == 'job_log'){
					window.location.href = 'my_account.php?task=logged_in&type=job_user';														
				}
			}
			else{ 
				window.error=true;
				window.errMessage = "<li> Username Or Password Incorrect..</li>";
				$(login_info_div).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);
				$(login_button).attr('disabled',false);
			}
		});
	}
	else{
		$(login_info_div).html(window.errMessage).removeClass().addClass('MessageBoxError').fadeIn(1000);
		window.errMessage="";			
	}
}

function display_content(type){
	
	if (type == 'basic'){
		location.href = 'search.php?search_type=basic';
	}else{
		location.href = 'search.php?search_type=advance';		
	}	
}

function search_jobs(type){
	
	var search_type = type;
	var search_query = '';	
	var search_query_dupl = '';
	var redirection_page = '';	
	
	if (type == ''){
		search_type = 'basic';
	}else{
		search_type = type;		  
	}	
	
	redirection_page += 'search.php?task=search&type=' + search_type;				
	
	if (search_type == 'basic'){ 
			search_keyword = document.getElementById('search_query').value;							
		if (search_keyword != ''){ 
			search_query = '&search_query=' + search_keyword;	
		}else{
			redirection_page = 'search.php';				
		}
	}else{
			if (document.getElementById('search_by_industry').value != 0){
				search_query += '&industry_id=' + document.getElementById('search_by_industry').value;				
			}
			if (document.getElementById('search_by_company').value != 0){
				search_query += '&company_id=' + document.getElementById('search_by_company').value;				
			}			
			if (document.getElementById('search_by_job_cat').value != 0){
				search_query += '&job_cat_id=' + document.getElementById('search_by_job_cat').value;				
			}
			if (document.getElementById('search_by_location').value != 0){
				search_query += '&city=' + document.getElementById('search_by_location').value;				
			}
			if ((document.getElementById('search_by_min_years').value == -1) && (document.getElementById('search_by_max_years').value == 0)){
				search_query += '';				
			}
			if ((document.getElementById('search_by_min_years').value == 0) && (document.getElementById('search_by_max_years').value == 0)){
				search_query_dupl += '&min_years=0';				
			}			
			if ((document.getElementById('search_by_min_years').value != 0) && (document.getElementById('search_by_min_years').value != -1) && (document.getElementById('search_by_max_years').value == 0)){
				search_query_dupl += '&min_years=' + document.getElementById('search_by_min_years').options[document.getElementById('search_by_min_years').selectedIndex].value;				
			}			
			if ((document.getElementById('search_by_min_years').value != 0) && (document.getElementById('search_by_min_years').value != -1) && (document.getElementById('search_by_max_years').value != 0)){
				search_query_dupl += '&min_years=' + document.getElementById('search_by_min_years').options[document.getElementById('search_by_min_years').selectedIndex].value + '&max_years=' + document.getElementById('search_by_max_years').options[document.getElementById('search_by_max_years').selectedIndex].value;				
			}			
			if ((document.getElementById('search_by_min_years').value == 0) && (document.getElementById('search_by_max_years').value != 0)){
				search_query_dupl += '&min_years=0&max_years=' + document.getElementById('search_by_max_years').options[document.getElementById('search_by_max_years').selectedIndex].value;				
			}			
			if ((document.getElementById('search_by_min_years').value == -1) && (document.getElementById('search_by_max_years').value != 0)){
				search_query_dupl += '&min_years=0&max_years=' + document.getElementById('search_by_max_years').options[document.getElementById('search_by_max_years').selectedIndex].value;				
			}			
			if (document.getElementById('search_query_advance').value != ''){
				search_query += '&search_query=' + document.getElementById('search_query_advance').value;				
			}else{ 
					if ((search_query_dupl == '') && (search_query == '')){ 
						redirection_page = 'search.php?search_type=advance';								
					}
			}
	}
	location.href = redirection_page + search_query + search_query_dupl;
}

function apply_vacancy_box(URL){
	
	window.open('modules/industries/apply_vacancies.php?'+URL,'apply_vacancy_box','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=600,height=300,left=350,top=200');
}