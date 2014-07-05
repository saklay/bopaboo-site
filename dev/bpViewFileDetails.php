<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."classes/bpRatings.cls.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITENAME; ?></title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="SHORTCUT ICON" href="<?php echo IMAGEPATH; ?>logo.ico">
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
	 For Sign In Popup*/
	$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");

	$clsbpUserLogin->setGetVars(); 
	 $clsbpUserLogin->postContactForUserDeatils(); 
	
	/*---------------------------------------------------------------------------*/

	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");

    	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();
	
	$tempObject = new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	
	$tempObject = $clsbpFileDetails;
	
	$temp = serialize($tempObject );
	
	
	$clsbpFileDetails->postFiles();
	
	
// 	displayObject($clsbpFileDetails);
	
	/*--------------------------------------------------------------------------------*/
	
	$clsbpRatings	= new clsbpRatings($connect, $includePath,"clsbpRatings");
	$rating = $clsbpRatings->fn_showUserRatingsAsImage($clsbpFileDetails->bi_MemberId);
	/*--------------------------------------------------------------------------------*/

	$tempObject = unserialize($temp);
	
// 	displayObject($tempObject);
// 	$arrObj = get_object_vars($clsbpFileDetails); 
// 	echo "<pre>";
// 	print_r($arrObj);
// 	echo "</pre>";
// 	echo($_SESSION["USERID"]);
if($_SESSION["USERID"] !="")
{
  $numOfFavSellors = $clsbpFileDetails->checkFavSeller($clsbpFileDetails->bi_MemberId); 
}
	$clsbpFileDetails->submitted = 1;
	
	$genreList	       = $clsbpFileDetails->getAllGenre();
		
	$extraParameters = "searchSize=$clsbpFileDetails->searchSize&submitted=$clsbpFileDetails->submitted";
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
	
	include_once($includePath."templates/bpViewFileDetails.tmpl.php");
}

ob_end_flush(); 
?>