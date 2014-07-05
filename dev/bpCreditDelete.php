<?php


$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
	include_once($includePath."classes/bpCreditCard.cls.php");


		$clsbpCreditCard	= new clsbpCreditCard($connect, $includePath,"clsbpCreditCard");
	
		$clsbpCreditCard->postCreditCardDetails();

?>