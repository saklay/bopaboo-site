<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";
include_once($includePath."bpCommon.php");

include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpEmailTemplate.cls.php");
include_once($includePath."classes/bpEmail.cls.php");
include_once($includePath."classes/bpBopaCart.cls.php");
$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link href="styles/bopabox.css" rel="stylesheet" type="text/css">
<link href="styles/signup.css" rel="stylesheet" type="text/css">

<link rel="SHORTCUT ICON" href="images/logo.ico">
</head>
<body>
<div id="wrapper">
<?php 
writeMain($connect, $includePath);
?>
</div>
</body>
</html>
<?php
function writeMain($connect, $includePath) {
global $clsbpUserLogin;
$clsbpUserLogin->setGetVars();
$clsbpUserLogin->postContactForUserDeatils();
}

ob_end_flush(); 
?>