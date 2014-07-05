<?php

ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
include_once($includePath."bpSessionCheck.php");

$_SESSION['friendList'] .= $_SESSION['friendListOutLook'];

 header("location:".stripslashes('bpMyBopa.php'));				
exit();
?>