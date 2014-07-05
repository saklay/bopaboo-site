<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpPaginateCOPY.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpRatings.cls.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>bopaboo – Your Place to Buy and Sell Digital Music</title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="SHORTCUT ICON" href="images/logo.ico">
<link href="styles/custom.css" rel="stylesheet" type="text/css" />
<link href="styles/bopaboov2.css" rel="stylesheet" type="text/css" />
<link href="styles/feedback.css" rel="stylesheet" type="text/css" />
<link href="star_rating.css" rel="stylesheet" type="text/css" media="all">
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/pagingajax.js"></script>
<script type="text/javascript" src="scripts/thickbox.js"></script>
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="scripts/bpCommon.js" type="text/javascript"></script>
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
	global $rates;
	
	$pageRange	        = HTMLOptionKeyValArray($arrPageRange,$clsbpFileDetails->pageSize);


	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	
	
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();
	$clsbpFileDetails->submitted = 1;
	//$clsbpFileDetails->postFiles();
	
	
	
	
/*	if ($clsbpFileDetails->action == "provided") {	

	$arrfileDetails = $clsbpFileDetails->retrieveFeedbackProvidedArray();
	
	}
	else if ($clsbpFileDetails->action == "received") {	
	
	
	$arrfileDetails1 = $clsbpFileDetails1->retrieveFeedbackReceivedArray();
	
	}
	else {
	
	 	$arrfileDetails = $clsbpFileDetails->retrieveFeedbackProvidedArray();
		
		$arraySize=sizeof($arrfileDetails);
	
		if($arraySize == 0){
		
		//$_SESSION["BPMESSAGE"]	= "No records found!";	
		}
		
		
		$arrfileDetails1 = $clsbpFileDetails1->retrieveFeedbackReceivedArray();
	
		$arraySize1=sizeof($arrfileDetails1);
	
		if($arraySize1 == 0){
		
	//	$_SESSION["BPMESSAGE"]	= "No records found!";	
		}
	
	
	}*/
	
	
	
	
	

	 $clsbpRatings	= new clsbpRatings($connect, $includePath,"clsbpRatings");
	
	 $clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
	
	
	
	
	
	
	include_once($includePath."templates/bpFeedback.tmpl.php");
	
}


ob_end_flush(); 
?>