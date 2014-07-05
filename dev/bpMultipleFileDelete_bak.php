<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");

error_reporting(E_ALL);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bopaboo</title>
<link href="styles/site.css" rel="stylesheet" type="text/css" />
<link href="styles/bopabox.css" rel="stylesheet" type="text/css" />
<link href="styles/bopabank.css" rel="stylesheet" type="text/css" />
<link href="styles/custom.css" rel="stylesheet" type="text/css" />
<link href="styles/bopaboov2.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
<link rel="stylesheet" href="styles/signup.css" type="text/css"  />

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
<script src="scripts/bpCommon.js" type="text/javascript"></script>
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/thickbox.js"></script>
<script type="text/javascript" language="JavaScript">
	function fnDeleteSongs(ids) {
		var frmVar = document.frmDelFile;
		frmVar.clsbpFileDetails_delete_list.value = ids;
// 		frmVar.clsbpFileDetails_returnURL.value = "bpBopaBox.php";
		frmVar.clsbpFileDetails_action.value = "DELETEFILES";
		frmVar.submit();
		return true;
	}
</script>

</head>

<body>
 <?php 
 	writeMain($connect, $includePath);
 ?>
</body>
</html>
<?php
function writeMain($connect, $includePath) {
	
	
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();

    	$clsbpFileDetails->submitted = 1;
    	
    	
	
    	
    	$clsbpFileDetails->postFiles();
// 	$arrObj = get_object_vars($clsbpFileDetails);
//     	
//     	echo "<pre>";
//     	print_r($arrObj);
//     	echo "</pre>";
	
	include_once($includePath."templates/bpMultipleFileDelete.tmpl.php");
}
ob_end_flush(); 
?>