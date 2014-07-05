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
	
	$html = "<span class=\"hdg\">".$clsbpAnnouncements->strSubject."</span><span class=\"date\">". convertDateToString($clsbpAnnouncements->dtInsertedDate)."</span><p>".nl2br($clsbpAnnouncements->strAnnouncement)."<br/>(<a href=\"javascript: void(0);\" class=\"link\" id=\"announce\" onclick=\"javascript: return getDivDefault();\">close</a>)</p>";
	
	echo $html;
?>