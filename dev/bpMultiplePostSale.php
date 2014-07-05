<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";
include_once($includePath."bpCommon.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpBopaCart.cls.php");
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
<link type="text/css" rel="stylesheet" href="styles/site.css" />

<link type="text/css" rel="stylesheet" href="styles/bopabox.css" />

<link type="text/css" rel="stylesheet" href="styles/bopabank.css" />

<link type="text/css" rel="stylesheet" href="styles/custom.css" />

<link type="text/css" rel="stylesheet" href="styles/bopaboov2.css" />
<script type="text/javascript" src="scripts/bpCommon.js"></script>

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script language="javascript">
	function fnPriceValidate() {
		var frm = document.frmSale;
		
		var objList = "clsbpFileDetails_txtPrice[]";
		var objList1 = "clsbpFileDetails_txaTags[]";
		for(var i=0;i<frm.elements[objList].length;i++) {
				var price = frm.elements[objList][i].value;
				
				if(price.charAt(0)=='$') {price = price.substr(1); var flag=1;}
				if (price=='')
				{
					alert("Price must be filled in!");
					frm.elements[objList][i].focus();
					return false;
				}
				else if(!(/^\$?(\d{1,3},?(\d{3},?)*\d{3}(\.\d{0,2})?|\d{1,3}(\.\d{0,2})?|\.\d{1,2}?)$/.test(price)))	{
					alert("Please enter a valid currency! Currency must be 44.44 format");
					frm.elements[objList][i].focus();
					return false;					
				}
				
				else if(parseFloat(price) < parseFloat(0.25) )	{
					alert("Enter a Valid Price Greater than or equal to $0.25.");
					frm.elements[objList][i].focus();
					return false;					
				}
				if(frm.elements[objList1][i].value =="")  {
					alert("Tags must be filled in!");
					frm.elements[objList1][i].focus();
					return false;					
				}
				frm.elements[objList][i].value = price;
		}	
		frm.clsbpFileDetails_action.value = "UPDATEALL";

		frm.submit();
		return true;
	}
	
	function deleteItem(fileId){
		var frm = document.frmSale;
		frm.clsbpFileDetails_deleteId.value = fileId;
		frm.submit();
	}

	function goBack(){
		window.location = "bpBopaBox.php"
		return false;
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
				key = String.fromCharCode(whichCode);  // Get key value from key code
				
				
		if(document.frmSale.flagNew.value==2)
						{	
						var objNew = "clsbpFileDetails_txtPrice[]";
						var frm = document.frmSale;
						frm.flagNew.value=1;
				
						for(var i=0;i<frm.elements[objNew].length;i++) {
							
				     		var price = frm.elements[objNew][i].value;
								
							}	
						
							   
								price = "";						
					
				}
				
				
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
			
				
				document.frmSale.flagNew.value=2;
				
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
	
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath);
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();
	$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
	$clsbpUserLogin->setPostVars();
	
	$memberid= $_SESSION['USERID'];
	 $clsbpUserLogin->retrieveUserNotificationDeatils($memberid); 
	if(isset($_POST['clsbpFileDetails_deleteId']) && $_POST['clsbpFileDetails_deleteId'] !='' ) {
		$delId = $_POST['clsbpFileDetails_deleteId'];
		foreach($_POST['clsbpFileDetails_txtFileId'] as $id) {
			if($delId != $id) {
				if($selIds !="") {
					$selIds=$selIds.",";	
				}
				$selIds.=$id;
			}
		}
		$clsbpFileDetails ->fileIds4sale = $selIds;
	}
	
	$clsbpFileDetails->postFiles();
	$arrSelectedItems = explode(",",$clsbpFileDetails ->fileIds4sale);
	
	include_once($includePath."templates/bpMultiplePostSale.tmpl.php");
}

ob_end_flush(); 
?>