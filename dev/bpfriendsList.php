<?php

ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once("classes/bpMailImport.cls.php");

	/*--------------------------------------------------------------------------------*/
	
	$clsbpMailImport	= new clsbpMailImport($connect, $includePath,"clsbpMailImport");

	
	
	$friendList = $_POST['addtoContact'];
	//print_r($friendList);
	$count = count($friendList);
	for ($i = 1; $i <= $count; $i++) {
	
		 $frndStr .= $friendList[$i-1].",";
	}
	/*--------------------------------------------------------------------------------*/

  $_SESSION['friendList'] .=$frndStr;
  //$clsbpMailImport->setPostVars();
  header("location:".stripslashes('bpMyBopa.php'));				
  exit();
?>