<?php

ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);
define("SRC_DB", "database"); 
define("SRC_WEB", "Internet"); 

$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpFileDetails.cls.php");


//did we post?
if ($_POST['submitted'] == '1') {
	echo 'Updating data from ' $_POST['dataSRC'];
}

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
<link rel="SHORTCUT ICON" href="images/logo.ico">
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
<link href="styles/bopabox.css" rel="stylesheet" type="text/css" />
<link href="styles/bopaboov2.css" rel="stylesheet" type="text/css" />
<link href="styles/signup.css" rel="stylesheet" type="text/css" />
<link href="styles/custom.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
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


	
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");

    	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();
	$clsbpFileDetails->postFiles();
	
	$genreList	       = $clsbpFileDetails->getAllGenre();
	$extraParameters = "pageSize=$clsbpFileDetails->pageSize&submitted=$clsbpFileDetails->submitted";	
	$GenreListControl  = HTMLOption2DArray($genreList, "bi_GenreId","vc_GenreName",$clsbpFileDetails->vc_genre_mod);
	
	include_once($includePath."templates/bpViewDetails.tmpl.php");
}

ob_end_flush(); 
?>