<?php
	include_once($includePath."bpCommon.php");
	include_once($includePath."bpFunctions.php");
	include_once($includePath."classes/bpUserLogin.cls.php");
	include_once($includePath."classes/bpBopaCart.cls.php");
	include_once($includePath."classes/bpUserLogin.cls.php");
	include_once($includePath."classes/bpMessages.cls.php");
	include_once($includePath."classes/bpPaginate.cls.php");

	/*-------------Create Messaging object ----------------------*/
	$clsbpMessages	= new clsbpMessages($connect, $includePath,"clsbpMessages");
	$countMessages = $clsbpMessages->getNewMessageSentCount();
	/*--------------------------------------------- ----------------------*/
	if($countMessages) {
		echo $countMessages." New ";
	}
?>