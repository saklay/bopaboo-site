<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");

include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");

?>
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
		<?php 
       writeMain($connect, $includePath);
        ?>
 
<?php
function writeMain($connect, $includePath) {
	
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath);
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();
	 $clsbpFileDetails->postFiles(); 
$arrObj = get_object_vars( $clsbpFileDetails);

	include_once($includePath."templates/bpSongStatusForSale.tmpl.php");
}

ob_end_flush(); 
?>