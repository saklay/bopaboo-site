<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");

//error_reporting(E_ALL);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITENAME; ?></title>
<style type="text/css">
@import "styles/master.css";
</style>
<!--[if IE]>
	<style type="text/css">
		@import "styles/ie.css";
    </style>    
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script src="scripts/bpCommon.js" type="text/javascript"></script>

</head>

<body>
 <?php 
 	writeMain($connect, $includePath);
 ?>
</body>
</html>
<?php
function writeMain($connect, $includePath) {

// 	echo "<pre>";
// 	print_r($_GET);
// 	echo "</pre>";
	
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();


    	$clsbpFileDetails->submitted = 1;
    	$clsbpFileDetails->postFiles();
		
	$arrDetails = get_object_vars($clsbpFileDetails);
	
	
	include_once($includePath."templates/bpSongDelete.tmpl.php");
}
ob_end_flush(); 
?>