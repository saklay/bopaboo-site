<?
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
//include_once($includePath."classes/fmPaginate.cls.php");
//include_once($includePath."classes/fmSearchPages.cls.php");
include_once($includePath."classes/bptbl_mem_details.cls.php");

$pageTitle			= "User Registration";
$metaDescription	= "";
$metaKeywords		= "";

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>
<?=getTitle()?>
</title>
<meta name="title" content="<?=getTitle()?>">
<meta name="description" content="<?=getMetaDescription()?>">
<meta name="keywords" content="<?=getMetaKeywords()?>">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
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

	global $arrPageRange;
	//$clsfmSearchPages						= new clsfmSearchPages($connect, $includePath);
	$clsbpUserDetails= new clsbptbl_mem_details($connect, $includePath,"clsbptbl_mem_details");	
	
	$clsbpUserDetails->setPostVars();
	$clsbpUserDetails->setGetVars();
	
// To get Name of Category
	include_once($includePath."templates/bpUserDetails.tmpl.php");
}

ob_end_flush(); 
?>
