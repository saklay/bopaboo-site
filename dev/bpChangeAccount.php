<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."bpFunctions.php");
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpEmailTemplate.cls.php");
include_once($includePath."classes/bpEmail.cls.php");
require_once('recaptchalib.php');
// error_reporting(E_ALL);
$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
$clsbpUserLogin->setPostVars();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITENAME; ?></title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="SHORTCUT ICON" href="<?php echo IMAGEPATH ?>logo.ico">
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
<style type="text/css">
@import "styles/master.css";
</style>
<!--[if IE]>
	<style type="text/css">
		@import "styles/ie.css";
    </style>    
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/thickbox.js"></script>
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="scripts/bpCommon.js" type="text/javascript"></script>

<script>
	function fnEcheck(str) {
	
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		var email="";
		if (str.indexOf(at)==-1){
			email = " Please enter a valid Email address.";
		}
	
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
			email = " Please enter a valid Email address.";
		}
	
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
			email = " Please enter a valid Email address.";
			
		}
	
		if (str.indexOf(at,(lat+1))!=-1){
			email = " Please enter a valid Email address.";
		}
	
		if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
			email = " Please enter a valid Email address.";
		}
	
		if (str.indexOf(dot,(lat+2))==-1){
			email = " Please enter a valid Email address.";
		}
			
		if (str.indexOf(" ")!=-1){
			email = " Please enter a valid Email address.";
		}
	
		return email;					
	}
	
	 function isCheckNumeric(str){
		var re = /[^a-zA-Z\s\.]/g
			if (re.test(str)) return false;

	}

	function fnValidate()
	{
	
		var email ="";
		var errorlist = "";
		var emailID=document.frmCngAc.clsbpUserLogin_txtEmail
		
		if ((emailID.value==null)||(emailID.value=="")){
			errorlist =  " Please enter a valid Email address as this will be used as your login id.";
		}
		
		errorlist = fnEcheck(emailID.value);
		
	
		if(document.frmCngAc.clsbpUserLogin_txtFname.value=='' || isCheckNumeric(document.frmCngAc.clsbpUserLogin_txtFname.value)==false)	{
			errorlist +="\n Please enter a valid First Name";
		}
	
		if(document.frmCngAc.clsbpUserLogin_txtLname.value=='' || isCheckNumeric(document.frmCngAc.clsbpUserLogin_txtLname.value)==false){
			errorlist +="\n Please enter a  valid Last Name";
		}
	
		if(document.frmCngAc.clsbpUserLogin_optMonth.value == 0) {
			errorlist +="\n Please select a Month";
		}
	
		if(document.frmCngAc.clsbpUserLogin_optDay.value == 0) {
			errorlist +="\n Please select a  Date";
		}	
		if(document.frmCngAc.clsbpUserLogin_optYear.value == 0) {
			errorlist +="\n Please select a Year";
		}
	
		var months = document.frmCngAc.clsbpUserLogin_optMonth.value;
		var days = document.frmCngAc.clsbpUserLogin_optDay.value;
		var years = document.frmCngAc.clsbpUserLogin_optYear.value;
		if ((months==04 || months==06 || months==09 || months==11) && days==31) {
			errorlist +="\n Please enter a valid date!";
		}
		
		if (months == 02) { // check for february 29th
			var isleap = (years % 4 == 0 && (years % 100 != 0 || years % 400 == 0));
			if (days>29 || (days==29 && !isleap)) {
				errorlist +="\n Please enter a valid date!";
			}
		}
		
		if(errorlist =="") {
			document.frmCngAc.clsbpUserLogin_returnUrl.value = "bpChangeAccount.php";
			document.frmCngAc.clsbpUserLogin_action.value="UPDATE";
			return true;
		} 
		else {
			alert(errorlist);
			return false;
		}
	}	
</script>
<!--<link href="styles/header-footer.css" rel="stylesheet" type="text/css" />-->
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

	global $clsbpUserLogin;
	global $arrGende,$arrMM_TO_MMM,$yearArray,$dayArray,$MonthArray;
	

	$clsbpUserLogin->setPostVars();
	$clsbpUserLogin->setGetVars();
	$clsbpUserLogin->postContactForUserDeatils();
	
	
	$coutriesList	= $clsbpUserLogin->getCountry();
	
	$yob = trim(substr($clsbpUserLogin->d_DateOfBirth,0,4));
	$month = substr($clsbpUserLogin->d_DateOfBirth,5,2);	
	$dob = substr($clsbpUserLogin->d_DateOfBirth,8,2);
	
	$coutryList		= HTMLOption2DArray($coutriesList, "i_CountriesId","vc_CountriesName",$clsbpUserLogin->i_CountriesId);
	$yearList		= HTMLOptionKeyValArray($yearArray, $yob);
	$monthList		= HTMLOptionKeyValArray($MonthArray, $month);
	$dayList		= HTMLOptionKeyValArray($dayArray, $dob);
	
	$arr_obj = get_object_vars($clsbpUserLogin);
	
	

	//include_once($includePath."templates/bpChangeAccount.tmpl.php");
		include_once($includePath."templates/myAccount.tmpl.php");
}

ob_end_flush(); 
?>