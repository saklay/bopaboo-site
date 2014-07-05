<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);
$includePath		= "./";
$pageTitle			= "www.bopaboo.com";
$metaDescription	= "";
$metaKeywords		= "";

include_once($includePath."bpCommon.php");
// error_reporting(E_ALL);

include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpBopaCart.cls.php");

include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpRatings.cls.php");
include_once($includePath."classes/bpMemberStore1.cls.php");
$extraParameters	.= "searchSize=$clsbpFileDetails->searchSize&submitted=$clsbpFileDetails->submitted&ms=$clsbpFileDetails->mS";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>bopaboo – Your Place to Buy and Sell Digital Music</title>
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
<link href="styles/bopabox.css" rel="stylesheet" type="text/css" />
<link href="styles/signup.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
<link href="styles/custom.css" rel="stylesheet" type="text/css" />
<link href="star_rating.css" rel="stylesheet" type="text/css" media="all">
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/thickbox.js"></script>
<script src="scripts/bpCommon.js" type="text/javascript"></script>
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>


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
var frm = document.frmMemberStore;
frm.clsbpBopaCart_action.value="ADDTOCART";
frm.action="bpBopaCart.php?fileId="+fileId+"&action=ADDTOCART&returnUrl=<?php echo "bpViewCart.php?clsbpFileDetails_txtSearch=$clsbpFileDetails->txtSearch";  ?>";
frm.submit();

}
function fn_addcart()
{

var frmcart = document.frmMemberStore;
fileIds		= getCheckedItem(frmcart,"addtoCart[]");

if(fileIds==undefined || fileIds==''){
alert('Please select a song from list');
return false
}
else{

frmcart.clsbpBopaCart_action.value="ADDTOCART";
frmcart.action="bpBopaCart.php?fileIds="+fileIds+"&action=ADDTOCART&returnUrl=<?php echo "bpViewCart.php?clsbpFileDetails_txtSearch=$clsbpFileDetails->txtSearch"; ?>";
frmcart.submit();
}
}

function fn_viewDetails(fileId)
{
	var frm = document.frmMemberStore;
	frm.action="bpViewFileDetails.php?clsbpFileDetails_bi_file_id="+fileId+"&returnUrl=<?php echo "bpMemberStore.php";  ?>&extraparameters=<?php echo $extraParameters?>";
	frm.submit();
}

function fn_addCcart(val) {
	var chk = "add"+val;	
	var elid = document.getElementById(chk);
	elid.checked=true;
	fn_addcart();
}

function submitForm() {
		var frm = document.frmMemberStore;
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
		}
		frm.action="bpMemberStore.php?mS=<?php echo $_REQUEST['mS'];?>";
		frm.submit();
}

</script>

</head>

<body>
  <div id="wrapper">
		<?php
		 $includePath		= "./";
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
	 For Sign In Popup*/
	$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");

	$clsbpUserLogin->setGetVars(); 
	 $clsbpUserLogin->postContactForUserDeatils(); 
	
	/*---------------------------------------------------------------------------*/

	
	$pageRange	        = HTMLOptionKeyValArray($arrPageRange,$clsbpCreditCard->pageSize);
	

	//$extraParameters	.= "pageSize=$clsbpCreditCard->pageSize&submitted=$clsbpCreditCard->submitted";
	
	
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();
	$query = "SELECT * FROM tbl_mem_login WHERE vc_DisplayName = '".$clsbpFileDetails->mS."'";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	
		if(count($row)>1){

				/*--------------------------------------------------------------------------------*/
				
				$clsbpRatings	= new clsbpRatings($connect, $includePath,"clsbpRatings");
				$rating = $clsbpRatings->fn_showUserRatingsAsImage($row[0]);
				/*--------------------------------------------------------------------------------*/
				
				$arrfileDetails = $clsbpFileDetails->retrieveMemberStoreArray();
				$clsbpFileDetails->retrieveMember();
				
				$arraySize=sizeof($arrfileDetails);
				
			
				
				if($_SESSION["USERID"] !="")
				{
				  $numOfFavSellors = $clsbpFileDetails->checkFavSellerForMemberStore($clsbpFileDetails->bi_sellerId);
				}

				$extraParameters	.= "searchSize=$clsbpFileDetails->searchSize&submitted=$clsbpFileDetails->submitted&ms=$clsbpFileDetails->mS";
	
	
				include_once($includePath."templates/bpMemberStore.tmpl.php");
	} 
	else{
	
	include_once($includePath."templates/bpPageNotFound.tmpl.php");
	
	}
} // end of functio0n
ob_end_flush(); 
?>