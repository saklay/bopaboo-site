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
	function valSubmit() {
		var frm = document.bpChangePref;
		var download;
		var Upload;
		//	if(frm.clsbpUserLogin_txtDownloadLocation.value == '') {
//			alert("Select An Arbitrary File For your Download Location");
//			return false;
//		}	
//		if(frm.clsbpUserLogin_txtUploadLocation.value == '') {
//		alert("Select An Arbitrary File For your Upload Location");
//			return false;
//		}
	
		var price = frm.clsbpUserLogin_txtDefaultPrice.value;
		if(price.charAt(0)=='$') {price = price.substr(1); var flag=1;}
		
		if(price < 0.25|| isNaN(price)==true)
		{
			alert("Enter a Valid Price Greater than or equal to $0.25.");
			return false;
		}
		frm.clsbpUserLogin_txtDefaultPrice.value = price;
		
		frm.clsbpUserLogin_returnUrl.value = "bpChangePreferences.php";
		frm.clsbpUserLogin_action.value="UPDATEPREFERENCES";
		return true;
	}
	
	function currencyFormat(fld, milSep, decSep, e) {
				var sep = 0;
				var key = '';
				var i = j = 0;
				var len = len2 = 0;
				var strCheck = '0123456789$';
				var aux = aux2 = '';
				var whichCode = (window.Event) ? e.which : e.keyCode;
				if (whichCode == 13) return true;  // Enter
				if (e.keyCode == 46 || e.keyCode ==37 || e.keyCode == 39 || e.keyCode == 35 ||e.keyCode == 66) return true; 
				if ((whichCode == 8)){
					return true;  // Delete (Bug fixed)
				}
				if(document.bpChangePref.flagNew.value==2)
				
				{
				document.bpChangePref.flagNew.value=1;
				document.bpChangePref.clsbpUserLogin_txtDefaultPrice.value="";
				
				}
				key = String.fromCharCode(whichCode);  // Get key value from key code
				if (strCheck.indexOf(key) == -1) return false;  // Not a valid key
				len = fld.value.length;
				for(i = 0; i < len; i++)
					if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
				aux = '';
				for(; i < len; i++)
					if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
						aux += key;
				len = aux.length;
				if (len == 0) fld.value = '';
				if (len == 1) fld.value = '0'+ decSep + '0' + aux;
				if (len == 2) fld.value = '0'+ decSep + aux;
				if (len > 2) {
					aux2 = '';
					for (j = 0, i = len - 3; i >= 0; i--) {
						if (j == 3) {
							aux2 += milSep;
							j = 0;
						}
						aux2 += aux.charAt(i);
						j++;
					}
					fld.value = '';
					len2 = aux2.length;
					for (i = len2 - 1; i >= 0; i--)
						fld.value += aux2.charAt(i);
					fld.value += decSep + aux.substr(len - 2, len);
				}
				
				var val = fld.value;
				if(val.charAt(0)=='$') {val = val.substr(1); var flag=1;}
				if(val>99.99) {
					val=99.99;
				}
				if(flag==1) {
					val='$'+val;
				}
				fld.value = val;
				
				return false;
	}
	function fnSelect()
				{
			
				
				document.bpChangePref.flagNew.value=2;
				
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
	
	$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
 	$clsbpUserLogin->setPostVars();
 	$clsbpUserLogin->setGetVars();
 	
 	if(!(isset($_POST['clsbpUserLogin_returnUrl']))){
 		$clsbpUserLogin->action = "GETPREFERENCES";	
 	}
 	
 	$clsbpUserLogin->postContactForUserDeatils();
 	
 	$objArray = get_object_vars($clsbpUserLogin);
 	
	
	include_once($includePath."templates/bpChangePreferences.tmpl.php");
}

ob_end_flush(); 
?>