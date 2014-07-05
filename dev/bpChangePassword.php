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
$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
$clsbpUserLogin->setPostVars();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>bopaboo – Your Place to Buy and Sell Digital Music</title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<head>
<!--<link rel="SHORTCUT ICON" href="images/logo.ico">-->
	
<link rel="stylesheet" href="styles/master.css" type="text/css"  />

<!--<link href="styles/custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
<link href="styles/my-account-settings.css" rel="stylesheet" type="text/css" />
<link href="styles/bopabank-myaccount-settings.css" rel="stylesheet" type="text/css" />-->
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/thickbox.js"></script>
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="scripts/bpCommon.js" type="text/javascript"></script>
<script language="javascript">
function fnValidate()
	{
		var errorlist = "";
		var emailID=document.frmChngUserPasswd.clsbpUserLogin_txtEmail
		
		
	
		if(document.frmChngUserPasswd.clsbpUserLogin_txtOldPassword.value == '') {
			errorlist +="\n Enter your current password";
		}	
		if(document.frmChngUserPasswd.clsbpUserLogin_txtPassword.value == '') {
			errorlist +="\n Enter the new password";
		}
		if(document.frmChngUserPasswd.clsbpUserLogin_txtConfirmation.value == '') {
			errorlist +="\n Enter the confirmation password";
		}
		
		if(document.frmChngUserPasswd.clsbpUserLogin_txtPassword.value !=document.frmChngUserPasswd.clsbpUserLogin_txtConfirmation.value) {
			errorlist +="\n Passwords do not match";
		}

		if(errorlist =="") {
			document.frmChngUserPasswd.clsbpUserLogin_returnUrl.value = "bpChangePassword.php";
			document.frmChngUserPasswd.clsbpUserLogin_action.value="UPDATEPWD";
			return true;
		} 
		else {
			alert(errorlist);
			return false;
		}
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

	
// 	echo "<pre>";
// 	print_r($_POST);
// 	echo "</pre>";

	global $clsbpUserLogin;
	$clsbpUserLogin->setPostVars();
	$clsbpUserLogin->setGetVars();
	$clsbpUserLogin->postContactForUserDeatils();
	//$arrobj = get_object_vars($clsbpUserLogin);
// 	echo "<pre>";
// 	print_r($arrobj);
// 	echo "</pre>";
	//include_once($includePath."templates/bpChangePassword.tmpl.php");
	include_once($includePath."templates/myPassword.tmpl.php");
}

ob_end_flush(); 
?>