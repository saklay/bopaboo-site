<?php
ob_start();

header("Cache-Control: no-store, no-cache");
    $includePath		= "./";

    include_once($includePath."bpCommon.php");
  //error_reporting(E_ALL);
	include_once($includePath."bpSessionCheck.php");
  	include_once($includePath."classes/bpPayment.cls.php");
	include_once($includePath."classes/bpBopaCart.cls.php");
	include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpCreditCard.cls.php");
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
<link href="styles/master.css" rel="stylesheet" type="text/css" />
<!--<link href="styles/main.css" rel="stylesheet" type="text/css" />
<link href="styles/custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/bpCommon.js"></script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
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


	


	/*----------------------------------------------------------------------------	
	Creates login class object. This is for login pop up section*/
    $clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
	
	$clsbpUserLogin->setPostVars();
	$clsbpUserLogin->postContactForUserDeatils();
	/*---------------------------------------------------------------------------*/
	
	
	/*----------------------------------------------------------------------------	
	 Created cart object*/
	$clsbpBopaCart	= new clsbpBopaCart($connect, $includePath,"clsbpBopaCart");
	$clsbpBopaCart->postCart();
	/*---------------------------------------------------------------------------*/
	
	/*----------------------------------------------------------------------------	
	 Created payment object*/
	$clsbpPayment	= new clsbpPayment($connect, $includePath,"clsbpPayment");
	
	$clsbpPayment->postPayment();
	$arrBank = $clsbpPayment->retrieveBankAmount();
	
	/*---------------------------------------------------------------------------*/
	
	include_once($includePath."templates/placeOrder.tmpl.php");
	
	
	
	
}

ob_end_flush(); 
?>