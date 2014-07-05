<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."bpFunctions.php");
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpEmailTemplate.cls.php");
include_once($includePath."classes/bpEmail.cls.php");
require_once('recaptchalib.php');

// error_reporting(E_ALL);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITENAME; ?></title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="SHORTCUT ICON" href="<?php echo IMAGEPATH ?>logo.ico">
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
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
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/thickbox.js"></script>
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="scripts/bpCommon.js" type="text/javascript"></script>

<script>	
	function valSubmit() {	
		var frm = document.frmNotifications;
		frm.clsbpUserLogin_returnUrl.value = "bpChangeNotifications.php";
		frm.clsbpUserLogin_action.value="UPDATENOTIFICATION";
		return true;
	}
	
</script>
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
 	$clsbpUserLogin->setPostVars();
 	$clsbpUserLogin->setGetVars();
 	
 	if(!(isset($_POST['clsbpUserLogin_returnUrl']))){
 		$clsbpUserLogin->action = "GETNOTIFICATION";	
 	}
 	
 	$clsbpUserLogin->postContactForUserDeatils();
 	
 	if($clsbpUserLogin->flagNotification == 1) {
 		$checkStatus1 = "checked=\"true\"";
 	}
 	else {
 		$checkStatus1 = "";
 	}
 	
 	if($clsbpUserLogin->flagNotifyFeatures == 1) {
 		$checkStatus2 = "checked=\"true\"";
 	}
 	else {
 		$checkStatus2 = "";
 	}
 	
 	if($clsbpUserLogin->flagNotifyPromos == 1) {
 		$checkStatus3 = "checked=\"true\"";
 	}
 	else {
 		$checkStatus3 = "";
 	}
 	//die($checkStatus1."-".$checkStatus2."-".$checkStatus3 );
	include_once($includePath."templates/bpChangeNotifications.tmpl.php");
}

ob_end_flush(); 
?>