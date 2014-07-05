<?php
ob_start();
header("Cache-Control: no-store, no-cache");
set_time_limit (60);
$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpGenre.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."classes/bpRatings.cls.php");
//error_reporting(E_ERROR);
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>bopaboo - Your Place to Buy and Sell Digital Music</title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="SHORTCUT ICON" href="images/logo.ico">
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
<link href="styles/bopabox.css" rel="stylesheet" type="text/css" />
<link href="styles/custom.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
<link href="star_rating.css" rel="stylesheet" type="text/css" media="all">
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/thickbox.js"></script>
<script type="text/javascript" src="scripts/bpCommon.js"></script>

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<SCRIPT  type="text/javascript" language="javascript">
<!--

<!-- Begin
function fnSetAllCheckBoxes(FormName, FieldName, CheckValue)
{
	if(!document.forms[FormName])
		return;
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
		objCheckBoxes.checked = CheckValue;
	else
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
			objCheckBoxes[i].checked = CheckValue;
}

// End -->

function fn_cart(fileId)
{
var frm = document.frmsrch;
frm.clsbpBopaCart_action.value="ADDTOCART";
frm.action="bpBopaCart.php?fileId="+fileId+"&action=ADDTOCART&returnUrl=<?php echo "bpViewCart.php";  ?>";
frm.submit();

}
function fn_addcart()
{
var frmcart = document.frmsrch;
fileIds		= getCheckedItem(frmcart,"addtoCart[]");
if(fileIds==undefined || fileIds==''){
alert('Please select a song from list');
return false
}
else{

frmcart.clsbpBopaCart_action.value="ADDTOCART";
frmcart.action="bpBopaCart.php?fileIds="+fileIds+"&action=ADDTOCART&returnUrl=<?php echo "bpViewCart.php"; ?>";
frmcart.submit();
}
}

function fn_viewDetails(fileId)
{
	var frm = document.frmsrch;
	frm.action="bpViewFileDetails.php?clsbpFileDetails_bi_file_id="+fileId+"&returnUrl=<?php echo "bpAdvSearchResult.php";  ?>&extraparameters=<?php echo $extraParameters?>";
	frm.submit();
}

function fn_addCcart(val) {
	var chk = "add"+val;
	
	var elid = document.getElementById(chk);
	elid.checked=true;
	fn_addcart();
}

function submitForm() {
		var frm = document.frmsrch;
		switch(frm.sortMenu.value) {
				case '1':
					
						frm.clsbpFileDetails_sortColumn.value = "dt_FileUploaded";
						frm.clsbpFileDetails_sortDirection.value="DESC";
						break;
				case '2':
						frm.clsbpFileDetails_sortColumn.value = "dt_FileUploaded";
						frm.clsbpFileDetails_sortDirection.value="ASC";
						break;
				case '3':
						frm.clsbpFileDetails_sortColumn.value = "dbl_price";
						frm.clsbpFileDetails_sortDirection.value="DESC";
						break;
				case '4':
						frm.clsbpFileDetails_sortColumn.value = "dbl_price";
						frm.clsbpFileDetails_sortDirection.value="ASC";
						break;
				case '5':
						frm.clsbpFileDetails_sortColumn.value = "avgRating";
						frm.clsbpFileDetails_sortDirection.value="DESC";
						break;
				case '6':
						frm.clsbpFileDetails_sortColumn.value = "avgRating";
						frm.clsbpFileDetails_sortDirection.value="ASC";
						break;
		}
		frm.action="bpAdvSearchResult.php";
		frm.submit();
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
	//global $clsbpGenre;
				
	/*--------------------------------------------------------------------------------*/
	
	$clsbpRatings	= new clsbpRatings($connect, $includePath,"clsbpRatings");
	/*--------------------------------------------------------------------------------*/
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$pageRange	        = HTMLOptionKeyValArray($arrPageRange,$clsfmCategory->searchSize);
	$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
    	
    	$clsbpUserLogin->setGetVars(); 
	$clsbpUserLogin->postContactForUserDeatils();
	   
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();
    	$clsbpFileDetails->submitted = 1;
    	
// 	displayObject($clsbpFileDetails);
	if($clsbpFileDetails->flagTopSearch!=1) {
		$arrfileDetails = $clsbpFileDetails->retrieveAdvFileArray(); 
	}
	else {
		$arrfileDetails = $clsbpFileDetails->retrieveAdvFileTopArray($clsbpFileDetails->vc_title_nm_mod, $clsbpFileDetails->vc_artists_nm_mod); 
	}
		
	
	$arraySize=sizeof($arrfileDetails);
	if($arraySize == 0){
	
	$_SESSION["BPMESSAGE"]	= "No records found!";	
	}
	
	/*
	$arrObj = get_object_vars($clsbpFileDetails);
	
	echo "<pre>";
	print_r($arrObj);
	echo "</pre>";
	*/
	
	
	$extraParameters .= "searchSize=$clsbpFileDetails->searchSize&submitted=$clsbpFileDetails->submitted";
	if($clsbpFileDetails->searchCat!="") {
		$extraParameters .= "&clsbpFileDetails_lstSeachCat=$clsbpFileDetails->searchCat";
	}
	if($clsbpFileDetails->searchType!="") {
		$extraParameters  .= "&clsbpFileDetails_optSearchType=$clsbpFileDetails->searchType";
	}
	if($clsbpFileDetails->searchGenre!="") {
		$extraParameters .= "&clsbpFileDetails_lstGenre=$clsbpFileDetails->searchGenre";
	}
	if($clsbpFileDetails->searchGenre!="") {
		$extraParameters .= "&clsbpFileDetails_txtMin=$clsbpFileDetails->searchGenre";
	}
	if($clsbpFileDetails->searchMinAmount!="") {
		$extraParameters .= "&clsbpFileDetails_txtMin=$clsbpFileDetails->searchMinAmount";
	}
	if($clsbpFileDetails->searchMaxAmount!="") {
		$extraParameters .= "&clsbpFileDetails_txtMax=$clsbpFileDetails->searchMaxAmount";
	}
	if($clsbpFileDetails->searchIfSeller!="") {
		$extraParameters .= "&clsbpFileDetails_optSeller=$clsbpFileDetails->searchIfSeller";
	}
	if($clsbpFileDetails->searchAction!="") {
		$extraParameters .= "&clsbpFileDetails_lstAct=$clsbpFileDetails->searchAction";
	}
	if($clsbpFileDetails->searchSeller!="") {
		$extraParameters .= "&clsbpFileDetails_txtSeller=$clsbpFileDetails->searchSeller";
	}
	if($clsbpFileDetails->searchSaveCheck!="") {
		$extraParameters .= "&clsbpFileDetails_chkSave= $clsbpFileDetails->searchSaveCheck";
	}
	if($clsbpFileDetails->searchSaveFav!="") {
		$extraParameters .= "&clsbpFileDetails_txtFav=$clsbpFileDetails->searchSaveFav";
	}

	include_once($includePath."templates/bpAdvSearchResult.tmpl.php");
}

ob_end_flush(); 
?>
