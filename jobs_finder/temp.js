// JavaScript Document			if ((document.getElementById('search_by_min_years').value == 0) && (document.getElementById('search_by_max_years').value != 0)){
				search_query_dupl = '&min_years=0&max_years=' + document.getElementById('search_by_max_years').options[document.getElementById('search_by_max_years').selectedIndex].value;	
			}
			if ((document.getElementById('search_by_min_years').value == 0) && (document.getElementById('search_by_max_years').value == 0)){
				search_query_dupl = '&min_years=0';	
			}			
			if ((document.getElementById('search_by_min_years').value != 0) && (document.getElementById('search_by_min_years').value != '')){ 
				search_query_dupl = '&min_years=' + document.getElementById('search_by_min_years').options[document.getElementById('search_by_min_years').selectedIndex].value;								
			}
			if ((document.getElementById('search_by_max_years').value != 0) && (document.getElementById('search_by_min_years').value == -1)){ 
				search_query_dupl = '&min_years=no&max_years=' + document.getElementById('search_by_max_years').options[document.getElementById('search_by_max_years').selectedIndex].value;
			}			
			if ((document.getElementById('search_by_max_years').value == 0) && (document.getElementById('search_by_min_years').value == -1)){ 
				search_query_dupl = '';								
			}						
			if ((document.getElementById('search_by_min_years').value != 0) && (document.getElementById('search_by_max_years').value != 0) && (document.getElementById('search_by_min_years').value != -1)) { 
				search_query_dupl = '&min_years=' + document.getElementById('search_by_min_years').options[document.getElementById('search_by_min_years').selectedIndex].value + '&max_years=' + document.getElementById('search_by_max_years').options[document.getElementById('search_by_max_years').selectedIndex].value;												
			}			
