<?php
	$includePath		= "./";
	
	include_once($includePath."bpCommon.php");
	
	$check = 0;
	
	if((isset($_SESSION['USERID'])) && ($_SESSION['USERID']!='')) {
		$check =1;
	}
	
	echo $check;
?>