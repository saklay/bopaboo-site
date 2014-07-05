<?php



$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
	include_once($includePath."classes/bpRatings.cls.php");
	global $rates;

		$clsbpRatings	= new clsbpRatings($connect, $includePath,"clsbpRatings");
	
		
		
		$clsbpRatings->postRating();
		
	
?>
