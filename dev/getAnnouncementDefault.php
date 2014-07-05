<?php
	ob_start();
	header("Cache-Control: no-store, no-cache");
	set_time_limit (60);
	$includePath		= "./";
	
	include_once($includePath."bpCommon.php");
	include_once($includePath."bpSessionCheck.php");

	include_once($includePath."classes/bpAnnouncements.cls.php");
	error_reporting(E_ALL);
	
	/*-------------Create Announcement object ----------------------*/
	$clsbpAnnouncements	= new clsbpAnnouncements($connect, $includePath,"clsbpMessages");
	$clsbpAnnouncements->getLatestAnnouncementDetails();
	
 	//displayObject($clsbpAnnouncements);
 	
	/*--------------------------------------------- ----------------------*/
	
	$html = "<span class=\"hdg\">".$clsbpAnnouncements->strSubject."</span><span class=\"date\">". convertDateToString($clsbpAnnouncements->dtInsertedDate)."</span><p>".substr(nl2br($clsbpAnnouncements->strAnnouncement),0,300)."&nbsp;&nbsp;&nbsp;(<a href=\"javascript: void(0);\" class=\"link\" id=\"announce\" onclick=\"javascript: getAjaxLinkActive();\">more...</a>)</p>";
	
	echo $html; 
?>