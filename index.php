<?php
	session_start();
	require("modules/pathway/header_title.php");
	require("library/path_config.php");	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $header_title;?></title>
<script language="javascript" type="text/javascript" src="<?php echo BROWSER_DETECT;?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo OTHER_JSCRIPT_PATH;?>"></script>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo SYSTEM_CSS_PATH;?>" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo MAIN_CSS_PATH;?>" />
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