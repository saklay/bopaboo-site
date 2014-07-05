<?
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";
$pageTitle			= "www.bopaboo.com";
$metaDescription	= "";
$metaKeywords		= "";

include_once($includePath."fmCommon.php");
include_once($includePath."classes/bpHeader.cls.php");
include_once($includePath."classes/bpEmail.cls.php");
include_once($includePath."classes/bpEmailTemplate.cls.php");
include_once($includePath."classes/bptbl_mem_login.cls.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=getTitle()?></title>
<meta name="title" content="<?=getTitle()?>">
<meta name="description" content="<?=getMetaDescription()?>"> 
<meta name="keywords" content="<?=getMetaKeywords()?>">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<script language="javascript" src="<? echo $includePath?>scripts/bpCommon.js"></script>
<link href="<?=$includePath?>css/style.css" rel="stylesheet" type="text/css">
<link rel="SHORTCUT ICON" href="<?=$includePath?>images/logo.ico">
</head>
<body>
<? 
include_once($includePath."includes/bpCommonBody.inc.php"); 
?>
</body>
</html>
<?
function writeMain($connect, $includePath) {

	$clsbpPassreset	=  new clsbpPassreset($connect, $includePath);	
	$clsbpPassreset->postContact();
	
	include_once($includePath."templates/bpPassreset.tmpl.php");
}
ob_end_flush(); 
?>