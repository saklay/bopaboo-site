<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
include_once($includePath."bpSessionCheck.php");
include_once("classes/bpCSVImport.cls.php");

	/*--------------------------------------------------------------------------------*/
	
	$clsbpCSVImport	= new clsbpCSVImport($connect, $includePath,"clsbpCSVImport");

	$clsbpCSVImport->postCSV();
	/*--------------------------------------------------------------------------------*/

 // header("location:".stripslashes('bpMyBopa.php'));				
  exit();


?>