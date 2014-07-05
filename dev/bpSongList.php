<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";
error_reporting(0);
include_once($includePath."bpCommon.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>bopaboo – Your Place to Buy and Sell Digital Music</title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="SHORTCUT ICON" href="images/logo.ico">
<link href="<?php echo $includePath; ?>styles/bopabox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $includePath; ?>scripts/bpCommon.js"></script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script language="javascript">
	function clstext(){
		document.form2.textfield.value="";
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

	global $arrPageRange;
	
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$pageRange			= HTMLOptionKeyValArray($arrPageRange,$clsfmCategory->searchSize);
	$clsbpFileDetails->setPostVars();
    	$clsbpFileDetails->submitted = 1;

	$arrfileDetails = $clsbpFileDetails->retrieveFileArray();

	$arraySize=sizeof($arrfileDetails);
	if($arraySize == 0){
	
	$_SESSION["BPMESSAGE"]	= "No records found!";	
	}
	$extraParameters	.= "pageSize=$clsbpFileDetails->searchSize&submitted=$clsbpFileDetails->submitted";
	
	include_once($includePath."templates/bpSongList.tmpl.php");
}

ob_end_flush(); 
?>