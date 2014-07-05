<?php


$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
	include_once($includePath."classes/bpBopaCart.cls.php");


		$clsbpBopaCart	= new clsbpBopaCart($connect, $includePath,"clsbpBopaCart");
	
		
		
		$clsbpBopaCart->postCart();

		
	
?>