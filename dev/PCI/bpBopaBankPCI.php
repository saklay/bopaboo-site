<?php

$includePath		= "../";
$pageTitle			= "www.bopaboo.com";
$metaDescription	= "";
$metaKeywords		= "";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpCreditCard.cls.php");
include_once($includePath."classes/bpPayment.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");



//$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
//$clsbpUserLogin->setPostVars();

$clsbpCreditCard	= new clsbpCreditCard($connect, $includePath);
$objArry=get_object_vars($clsbpCreditCard);

$clsbpCreditCard->setPostVars();
$clsbpCreditCard->setGetVars();

	$pageRange	        = HTMLOptionKeyValArray($arrPageRange,$clsbpCreditCard->pageSize);
	$clsbpCreditCard->postCreditCardDetails();
	$clsbpCreditCard->returnUrl;	

    	$clsbpCreditCard->submitted = 1;

	$arrfileDetails = $clsbpCreditCard->retrieveCreditCardDetailsArray();

	$arraySize=sizeof($arrfileDetails);

	$extraParameters	.= "pageSize=$clsbpCreditCard->pageSize&submitted=$clsbpCreditCard->submitted";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>bopaboo  Your Place to Buy and Sell Digital Music</title>
<link href="../styles/site.css" rel="stylesheet" type="text/css" />
<link rel="../stylesheet" href="styles/thickbox.css" type="text/css"  />
<link href="../styles/bopabox.css" rel="stylesheet" type="text/css" />
<link href="../styles/bopabank.css" rel="stylesheet" type="text/css" />
<link href="../styles/custom.css" rel="stylesheet" type="text/css" />
<link href="../styles/bopaboov2.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script src="../scripts/bpCommon.js" type="text/javascript"></script>
<script src="../scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" src="../scripts/thickbox.js"></script>
	</head>
     <body>
    	<!--<div id="container">-->
    		<?
    			include("./bpBopaBankPCI.iframe.php");
    		?>
     	<!--</div>-->
	 </body>
</html>
