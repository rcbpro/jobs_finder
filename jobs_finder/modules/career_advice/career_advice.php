<?php
	session_start();
	require("../pathway/header_title.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $header_title;?></title>
<script type="text/javascript" src="../../html/javascripts/BrowserDetect.js"></script>
<script language="javascript" type="text/javascript" src="../../html/javascripts/other_js.js"></script>
<link href="../../html/css/main.css" type="text/css" rel="stylesheet" media="all" />
<link href="../../html/css/module_css.css" type="text/css" rel="stylesheet" media="all" />
</head>
<body>
    <div id="main_content">

    	<?php require_once("html/header.php"); ?> 
        
        <!-- Start of the Total middel content -->
        <div id="tot_middle">
        
        <!-- Start of the Left Content -->
    	<?php require_once("html/left_content.php"); ?> 
        <!-- End of the Left Content -->    
            
        <!-- Start of the Middle Content -->    
    	<?php require_once("html/middle_content.php"); ?> 
		<!-- End of the Middele content -->        
            
        <!-- Start of the Right Content -->    
    	<?php require_once("html/right_content.php"); ?>             
        <!-- End of the Right Content -->        
        
        </div>
        <!-- End of the Total middle content -->
        
        <?php require_once("html/footer.php"); ?>
        
    </div>
</body>
</html>