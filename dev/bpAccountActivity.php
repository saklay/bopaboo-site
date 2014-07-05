<?php
ob_start();
header("Cache-Control: no-store, no-cache");
set_time_limit (60);
$includePath		= "./";

include_once($includePath."bpCommon.php");

include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpBopaCart.cls.php");
//error_reporting(E_ALL);
include_once($includePath."classes/bpBopaBank.cls.php");
include_once($includePath."classes/bpPayment.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpCreditCard.cls.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>bopaboo Your Place to Buy and Sell Digital Music</title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="SHORTCUT ICON" href="images/logo.ico">

<link href="styles/custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />


<link href="styles/bopaboov2.css" rel="stylesheet" type="text/css" />
<link href="styles/bopabank.css" rel="stylesheet" type="text/css" />
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/thickbox.js"></script>
<script src="scripts/bpCommon.js" type="text/javascript"></script>


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
/*----------------------------------------------------------------------------	
	 Created payment object*/
	 global $arrMM_TO_MMM,$MonthNewArray,$yearNewArray;
	 global $arrPageRange;
	 global $clsbpBopaBank;
 
	$pageRange	        = HTMLOptionKeyValArray($arrPageRange,$clsbpBopaBank->pageSize);
	 
	$clsbpPayment	= new clsbpPayment($connect, $includePath,"clsbpPayment");
	$clsbpPayment->postPayment();
	$arrBank = $clsbpPayment->retrieveBankAmount();

	/*---------------------------------------------------------------------------*/
	$clsbpBopaBank	= new clsbpBopaBank($connect, $includePath,"clsbpBopaBank");
	
	$clsbpBopaBank->setPostVars();
	$clsbpBopaBank->setGetVars();

	//$arrfileDetails = $clsbpBopaBank->retrieveAllOrderArray(); 
/*----------------- For transaction Tab ------------------------*/
	   
		 $arrfileDetails = $clsbpBopaBank->retrieveAllOrderArray(); 
	
/*----------------- end oftransaction Tab ------------------------*/	

	include_once($includePath."templates/bpAccountActivity.tmpl.php");
}

ob_end_flush(); 
?>
