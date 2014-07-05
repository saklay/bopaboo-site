<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."bpSessionCheck.php");
include_once($includePath."bpFunctions.php");
include_once($includePath."classes/bpPayment.cls.php");
include_once($includePath."classes/bpCreditCard.cls.php");
/*NIL
$clsbpCreditCard	= new clsbpCreditCard($connect, $includePath,"clsbpCreditCard");
$clsbpCreditCard->setPostVars();
$clsbpCreditCard->setGetVars();
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<link href="styles/custom.css" rel="stylesheet" type="text/css" />

<link href="styles/bopaboov2.css" rel="stylesheet" type="text/css" />
<link href="styles/bopabank.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<link rel="SHORTCUT ICON" href="images/logo.ico">
</head>
<body onload="return fnEnterNewBilling();">
<div id="wrapper">
<?php 
include_once($includePath."includes/bpUserCommonBody.inc.php"); 
?>
</div>
</body>
</html>
<?php
function writeMain($connect, $includePath) {

	global $clsbpCreditCard;
	global $arrMM_TO_MMM,$yearArray,$MonthArray;
	/*----------------------------------------------------------------------------	
	 Created payment object*/
	$clsbpPayment	= new clsbpPayment($connect, $includePath,"clsbpPayment");
	$clsbpPayment->postPayment();
	$arrBank = $clsbpPayment->retrieveBankAmount();
	
	/*---------------------------------------------------------------------------*/

/*NIL	$clsbpCreditCard->postCreditCardDetails();
	$addresslist=$clsbpCreditCard->getAddress();
	
	$addresslist		= HTMLOption2DArray($addresslist, "vc_addr","vc_addr");
	$noofcards = $clsbpCreditCard->getNoofCards();
	$clsbpCreditCard->num = count($noofcards);
	$valcheck =$clsbpCreditCard->validate($clsbpCreditCard->bi_card_num,$clsbpCreditCard->optMonth,$clsbpCreditCard->optYear);
NIL*/	
	/*if($valcheck != 0)
	{
		$_SESSION["BPMESSAGE"] .= "* Invalid Date of Birth <BR>";
	
	}*/
/*NIL	
	$clsbpCreditCard->returnUrl;	
	if ($clsbpCreditCard->returnUrl == "") {
		$clsbpCreditCard->returnUrl = "bpBopaBank.php";
	}
	

	

	
	$monthList		= HTMLOptionKeyValArray($MonthArray,$clsbpCreditCard->optMonth);
	
		//$yearList		= HTMLOptionKeyValArray($yearArray,$clsbpCreditCard->optYear);
	
NIL*/
	include_once($includePath."templates/bpCreditCardAdd.tmpl.php");
}

ob_end_flush(); 
?>