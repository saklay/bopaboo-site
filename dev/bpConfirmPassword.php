<?php
ob_start();

header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."classes/bpEmail.cls.php");
include_once($includePath."classes/bpEmailTemplate.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpBopaCart.cls.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITENAME; ?></title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="SHORTCUT ICON" href="images/logo.ico">
<style type="text/css">
@import "styles/master.css";
</style>
<!--[if lt ie 8]>
	<style type="text/css">
		@import url("styles/ie.css");
    </style> 
<![endif]-->
<!--[if lt ie 7]>   
	<script src="scripts/IE8.js" type="text/javascript"></script>
    <script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
</head>
<body>
    <div id="wrapper">
	<?php 
        include_once($includePath."includes/bpUserCommonBody.inc.php"); 
    ?>
</div>
</body>
</html>
<?php
function writeMain($connect, $includePath) {

	$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
		$clsbpUserLogin->setGetVars();
	 $clsbpUserLogin->postContactForUserDeatils();
	
	include_once($includePath."templates/bpConfirmPassword.tmpl.php");
	
}

ob_end_flush(); 
?>
