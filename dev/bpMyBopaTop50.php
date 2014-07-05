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
// error_reporting(E_ALL);

include_once($includePath."classes/bpUserLogin.cls.php");
$extraParameters	.= "searchSize=$clsbpFileDetails->searchSize&submitted=$clsbpFileDetails->submitted&ms=$clsbpFileDetails->mS";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>bopaboo – Your Place to Buy and Sell Digital Music</title>
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />


<link href="styles/custom.css" rel="stylesheet" type="text/css" />
<link href="styles/bopaboov2.css" rel="stylesheet" type="text/css" />

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
<script language="JavaScript" language="text/javascript">
	function searchItem(titleName, artistName) {
		var frm = document.frmTopList;
		frm.clsbpFileDetails_flagTopSearch.value = 1;
		frm.clsbpFileDetails_vc_title_nm_mod.value = titleName ;
		frm.clsbpFileDetails_vc_artists_nm_mod.value= artistName;
		frm.submit();
		return true;
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
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$arrDet = $clsbpFileDetails->getTopSellingSongsList();
// 	displayArray($arrDet);
	include_once($includePath."templates/bpMyBopaTop50.tmpl.php");
}
ob_end_flush(); 
?>