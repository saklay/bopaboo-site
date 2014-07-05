<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";
error_reporting(0);
include_once($includePath."bpCommon.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");

?>

 
		<?php 
       writeMain($connect, $includePath);
        ?>
  

<?php
function writeMain($connect, $includePath) {
	
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath);
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();
	$clsbpFileDetails->postFiles();
	
	
	include_once($includePath."templates/bpSongNotForSale.tmpl.php");
}

ob_end_flush(); 
?>