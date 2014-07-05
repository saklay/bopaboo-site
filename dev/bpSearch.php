<?php
ob_start();
header("Cache-Control: no-store, no-cache");
set_time_limit (60);
$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpGenre.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpRatings.cls.php");
 error_reporting(E_All);
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
<link rel="SHORTCUT ICON" href="<?php echo IMAGEPATH ?>logo.ico">
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/thickbox.js"></script>
<script type="text/javascript" src="scripts/bpCommon.js"></script>
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
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
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
/*----------------------------------------------------------------------------	
	 For Sign In Popup*/
	$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");

	$clsbpUserLogin->setGetVars(); 
	 $clsbpUserLogin->postContactForUserDeatils(); 
	
	/*---------------------------------------------------------------------------*/
		
	/*--------------------------------------------------------------------------------*/
	
	$clsbpRatings	= new clsbpRatings($connect, $includePath,"clsbpRatings");
	/*--------------------------------------------------------------------------------*/
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$pageRange	        = HTMLOptionKeyValArray($arrPageRange,$clsfmCategory->searchSize);
	
        
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();
	$clsbpFileDetails->submitted = 1;
   
   
   	if($clsbpFileDetails->flagAdvSearch=="OFF") {
		$arrfileDetails = $clsbpFileDetails->retrieveFileArray(); 
	}
	else  if($clsbpFileDetails->flagAdvSearch=="ON") {
		if($clsbpFileDetails->flagTopSearch!=1) {

			$arrfileDetails = $clsbpFileDetails->retrieveAdvFileArray(); 
		}
		else {
			$arrfileDetails = $clsbpFileDetails->retrieveAdvFileTopArray($clsbpFileDetails->vc_title_nm_mod, $clsbpFileDetails->vc_artists_nm_mod); 
		}
	}
	
	$arraySize=sizeof($arrfileDetails);
	
	if($clsbpFileDetails->flagAdvSearch=="OFF") {
		if($arraySize == 0){
			$_SESSION["BPMESSAGE"]	= "We were unable to find anything for ".'<strong>'.'('.stripslashes($clsbpFileDetails->txtSearch).stripslashes($clsbpFileDetails->SearchGenreName).stripslashes($clsbpFileDetails->Searchtags).stripslashes($clsbpFileDetails->artistname).stripslashes($clsbpFileDetails->albumname).')'.'</strong>'.'<center>'.'Please try another search.'.'<center>';		
		}
	}
	else {
		$_SESSION["BPMESSAGE"]	= $clsbpFileDetails->flagAdvSearch . "<strong>No records found.</strong>";
	}
	
	$extraParameters	.= "searchSize=$clsbpFileDetails->searchSize&submitted=$clsbpFileDetails->submitted";
	
	if($clsbpFileDetails->bi_GenreId!="") {
		$extraParameters .= "&clsbpFileDetails_bi_GenreId=$clsbpFileDetails->bi_GenreId";
	}
	
	if($clsbpFileDetails->vc_tags!="") {
		$extraParameters .= "&clsbpFileDetails_vc_tags=$clsbpFileDetails->vc_tags";
	}
	
	if($clsbpFileDetails->seachCat!="") {
		$extraParameters .= "&clsbpFileDetails_seachCat=$clsbpFileDetails->seachCat";
	}
	
	if($clsbpFileDetails->SearchGenreId!="") {
		$extraParameters .= "&clsbpFileDetails_SearchGenreId=$clsbpFileDetails->SearchGenreId";
	}
	
	if($clsbpFileDetails->SearchGenreName!="") {
		$extraParameters .= "&clsbpFileDetails_SearchGenreName=$clsbpFileDetails->SearchGenreName";
	}
	
	if($clsbpFileDetails->Searchtags!="") {
		$extraParameters .= "&clsbpFileDetails_Search_tags=$clsbpFileDetails->Searchtags";
	}
	
	
	if($clsbpFileDetails->artistname!="") {
		$extraParameters .= "&clsbpFileDetails_artist=$clsbpFileDetails->artistname";
	}
	
	if($clsbpFileDetails->albumname!="") {
		$extraParameters .= "&clsbpFileDetails_album=$clsbpFileDetails->albumname";
	}
	
	if($clsbpFileDetails->vc_Tags!="") {
		$extraParameters .= "&clsbpFileDetails_vc_Tags=$clsbpFileDetails->vc_Tags";
	}
	
	
	
	if($clsbpFileDetails->txtSearch!="") {
		$extraParameters .= "&clsbpFileDetails_txtSearch=$clsbpFileDetails->txtSearch";
	}
	
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
	
	if($clsbpFileDetails->flagAdvSearch!="") {
		$extraParameters .= "&clsbpFileDetails_advSearchFlag=$clsbpFileDetails->flagAdvSearch";
	}
	if($clsbpFileDetails->vc_artists_nm_mod!="") {
		$extraParameters .= "&clsbpFileDetails_vc_artists_nm_mod=$clsbpFileDetails->vc_artists_nm_mod";
	}
	
	if($clsbpFileDetails->vc_title_nm_mod!="") {
		$extraParameters .= "&clsbpFileDetails_vc_title_nm_mod=$clsbpFileDetails->vc_title_nm_mod";
	}

// 	echo $extraParameters;
	
	include_once($includePath."templates/bpsearch.tmpl.php");
}

ob_end_flush(); 
?>
