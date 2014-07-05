<?php

ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
//include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpEmail.cls.php");
include_once($includePath."classes/bpEmailTemplate.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once("classes/bpMailImport.cls.php");


$clsbpMailImport	= new clsbpMailImport($connect, $includePath,"clsbpMailImport");
$clsbpMailImport->setPostVars();
//print_r($clsbpMailImport->contactList);
$clsbpMailImport->sendMailToFriends();

$_SESSION['friendList']="";
session_unregister('friendList');
header("location:".stripslashes('bpMyBopa.php'));				
exit();
?>