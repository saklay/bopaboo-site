<?
	$includePath		= "../";
	include_once($includePath."bpCommon.php");
	include_once($includePath."bpSessionCheck.php");
	include_once($includePath."bpFunctions.php");
	include_once($includePath."classes/bpPayment.cls.php");
	include_once($includePath."classes/bpCreditCard.cls.php");
	
	$clsbpCreditCard	= new clsbpCreditCard($connect, $includePath,"clsbpCreditCard");
	$clsbpCreditCard->setPostVars();
	$clsbpCreditCard->setGetVars();
	$clsbpCreditCard->postCreditCardDetails();
	$addresslist=$clsbpCreditCard->getAddress();
	
	$addresslist		= HTMLOption2DArray($addresslist, "vc_addr","vc_addr");
	$noofcards = $clsbpCreditCard->getNoofCards();
	$clsbpCreditCard->num = count($noofcards);
	$valcheck =$clsbpCreditCard->validate($clsbpCreditCard->bi_card_num,$clsbpCreditCard->optMonth,$clsbpCreditCard->optYear);
	$clsbpCreditCard->returnUrl;
	if ($clsbpCreditCard->returnUrl == "") {
		$clsbpCreditCard->returnUrl = "bpBopaBank.php";
	}
	$monthList		= HTMLOptionKeyValArray($MonthArray,$clsbpCreditCard->optMonth);
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
		<link href="../styles/bopabox.css" rel="stylesheet" type="text/css">
		<link href="../styles/signup.css" rel="stylesheet" type="text/css">
		<link href="../styles/custom.css" rel="stylesheet" type="text/css" />

		<link href="../styles/bopaboov2.css" rel="stylesheet" type="text/css" />
		<link href="../styles/bopabank.css" rel="stylesheet" type="text/css" />
	</head>
     <body>
    		<?
    			include("./bpCreditCardAdd.iframe.php");
    		?>
     </body>
</html>