<?php
ob_start();
header("Cache-Control: no-store, no-cache");
set_time_limit (60);
$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."classes/bpGenre.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpRatings.cls.php");

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
<link href="styles/custom.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
<link href="styles/bopaboov2.css" rel="stylesheet" type="text/css" />
<link href="star_rating.css" rel="stylesheet" type="text/css" media="all">
<link href="styles/sell.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script src="../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="scripts/jqueryboxbopabox.js"></script>
<script type="text/javascript" src="scripts/thickboxbopabox.js"></script>
<script type="text/javascript" src="scripts/bpCommon.js"></script>
<script language="javascript">
	function clstext(){
		document.form2.textfield.value="";
		} 
	function fn_viewDetails(fileId) {
		var frm = document.frmDetails;
		frm.action="bpViewFileDetails.php?clsbpFileDetails_bi_file_id="+fileId+"&returnUrl=<?php echo "bpAdvSearchResult.php";  ?>&extraparameters=<?php echo $extraParameters?>";
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
	
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();

    	$clsbpFileDetails->submitted = 1;
    	$clsbpFileDetails->postFiles();
		/*--------------------------------------------------------------------------------*/
	
	$clsbpRatings	= new clsbpRatings($connect, $includePath,"clsbpRatings");
	$rating = $clsbpRatings->fn_showUserRatingsAsImage($_SESSION['USERID']);
	/*--------------------------------------------------------------------------------*/
 	$clsbpFileDetails->getUserMybopaCount($_SESSION['USERID']);	
 	$clsbpFileDetails->getUserMybopaSellCount($_SESSION['USERID']); 	
 	$clsbpFileDetails->getAllBopaCount();
 	//$arrMemDet = $clsbpFileDetails->getMemberFileArray($_SESSION['USERID']);
 	$arrMemDet = $clsbpFileDetails->getSellPageDet($_SESSION['USERID']);
 	
 	$arraySize=sizeof($arrMemDet);
 	if($arraySize == 0){
			if($clsbpFileDetails->checkSongsinSale($_SESSION['USERID']))
			{
			$_SESSION["BPMESSAGE"]	= "You're in luck! No one else is selling your song.";	
			
			}
			else{
			$_SESSION["BPMESSAGE"]	= "You need to have songs for sale to be in the game! So click the Upload button and Get your bopaboo on!";	
	        
			}
			
	}
	$extraParameters	.= "pageSize=$clsbpFileDetails->pageSize&submitted=$clsbpFileDetails->submitted";
 	
//  	$arrObj = get_object_vars($clsbpFileDetails);
//  	
//  	echo "<pre>";
//  	print_r($arrMemDet );
//  	echo "</pre>";
include_once($includePath."templates/bpSellLogged.tmpl.php");
}

ob_end_flush(); 
?>
