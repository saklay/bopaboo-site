<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);
$includePath		= "./";
$pageTitle			= "www.bopaboo.com";
$metaDescription	= "";
$metaKeywords		= "";

include_once($includePath."bpCommon.php");
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpCreditCard.cls.php");
include_once($includePath."classes/bpPayment.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");

$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
$clsbpUserLogin->setPostVars();
$clsbpUserLogin->setGetVars();


$clsbpCreditCard	= new clsbpCreditCard($connect, $includePath,"clsbpCreditCard");
$objArry=get_object_vars($clsbpCreditCard);

$clsbpCreditCard->setPostVars();
$clsbpCreditCard->setGetVars();

$minwithraw =constant("MINWITHDRAW");
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
<!--<link href="styles/bopabox.css" rel="stylesheet" type="text/css" />
<link href="styles/custom.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
-->
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/thickbox.js"></script>
<script type="text/javascript" src="scripts/bpCommon.js"></script>
<!--<link href="styles/bopaboov2.css" rel="stylesheet" type="text/css" />
<link href="styles/bopabank.css" rel="stylesheet" type="text/css" />-->

<script language="javascript">
	function fnEcheck(str) {
	
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
			var email="";
		if (str.indexOf(at)==-1){
			email = " Please enter a valid Email address. ";
		}
	
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
			email = " Please enter a valid Email address. ";
			
		}
	
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
			email = " Please enter a valid Email address. ";
			
		}
	
		if (str.indexOf(at,(lat+1))!=-1){
			email = " Please enter a valid Email address. ";
		
		}

		if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
			email = " Please enter a valid Email address. ";
		
		}

		if (str.indexOf(dot,(lat+2))==-1){
			email = " Please enter a valid Email address. ";
		
		}
	
		if (str.indexOf(" ")!=-1){
			email = " Please enter a valid Email address. ";
		
		}
	
		return email;					
	}

function fnValWithdraw()
{
	var email ="";
	var errorlist = "";
	var emailID=document.frmWithdraw.classname_email;
	var cEmailId = document.frmWithdraw.classname_conf_email;
	var amount = document.frmWithdraw.classname_amount;
	var available_withdraw = document.frmWithdraw.available_withdraw;
	var minwithraw=<?php echo $minwithraw;?>;
	
	//alert("MINWITHDRAW:"+minwithraw);

	if(emailID.value!=cEmailId.value){
		alert("The emails do not match. Please re-enter");
		document.frmWithdraw.classname_email.focus();
		return false;
	}
	
	if ((emailID.value==null)||(emailID.value=="")||(cEmailId.value==null)||(cEmailId.value=="")||(amount.value==null)||(amount.value=="")){
		alert(" Please enter all the details");
		document.frmWithdraw.classname_email.focus();
		return false;
	}
	
	var priceExp =/^\$?([0-9]{1,3},([0-9]{3},)*[0-9]{3}|[0-9]+)(.[0-9][0-9])?$/;
	
	if (!(priceExp.test(amount.value))){
		alert("Please enter a valid price");
		document.frmWithdraw.classname_amount.focus();
		return false;
	}
	if (parseFloat(amount.value) > parseFloat(available_withdraw.value) || parseFloat(amount.value) < parseFloat(minwithraw)){
		alert("Please enter a valid price");
		document.frmWithdraw.classname_amount.focus();
		return false;
	}
		
	errorlist = fnEcheck(emailID.value);
	
	
	if(errorlist =="")
	{
		saveForm();
		return false;
	} 
	else
	{	
		alert(errorlist);
		return false;
	}

	function saveForm() {
		var frm = document.frmWithdraw;
		frm.action = "bpProcessWithdraw.php";
		frm.submit();
	}

}
</script>

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
	global $clsbpCreditCard;
	global $arrMM_TO_MMM,$yearArray,$MonthArray;

	
	/*----------------------------------------------------------------------------	
	 Created payment object*/
	$clsbpPayment	= new clsbpPayment($connect, $includePath,"clsbpPayment");
	$clsbpPayment->postPayment();
	$arrBank = $clsbpPayment->retrieveBankAmount();
	
	/*---------------------------------------------------------------------------*/

	/*---------------------------------------------------------------------------
		User Details object*/
		$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
		$clsbpUserLogin->setPostVars();
		$clsbpUserLogin->setGetVars();

		$clsbpUserLogin->postContactForUserDeatils();
		//$clsbpUserLogin->retrieveLogin();
		//echo 
		//$clsbpUserLogin->postContactForUserDeatils();

		//$memberid= $_SESSION['USERID'];
		//$dbque="select * from tbl_mem_login where bi_MemberId=".$memberid;
	//	$clsbpUserLogin->retrieveLoginRow($dbque); 
	//	echo "emailid:". $row['vc_EmailId'];
	/*---------------------------------------------------------------------------*/		

	$pageRange	        = HTMLOptionKeyValArray($arrPageRange,$clsbpCreditCard->pageSize);
	$clsbpCreditCard->postCreditCardDetails();
	$clsbpCreditCard->returnUrl;	

    	$clsbpCreditCard->submitted = 1;

//	$arrfileDetails = $clsbpCreditCard->retrieveCreditCardDetailsArray(); // NIL 07/21/08

	$arraySize=sizeof($arrfileDetails);

	$extraParameters	.= "pageSize=$clsbpCreditCard->pageSize&submitted=$clsbpCreditCard->submitted";
	
	include_once($includePath."templates/withdraw.tmpl.php");
}

ob_end_flush(); 
?>
