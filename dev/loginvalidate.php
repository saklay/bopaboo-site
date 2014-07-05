<?php
ob_start();
header("Cache-Control: no-store, no-cache");

$includePath		= "./";

include_once($includePath."bpCommon.php");
	include_once($includePath."classes/bpBopaCart.cls.php");
	
	 $username=$_GET['user'];
	 $pass=$_GET['pass'];	
	 $password = base64_encode(base64_encode($pass));
	
	 $selUser = "Select vc_EmailId,vc_Password from tbl_mem_login where vc_EmailId ='$username' and vc_Password='$password' and ti_MemberStatus=1" ;
	$selquery = mysql_query($selUser) or die('error'.mysql_error());
			
	
		$loginFoundUser = mysql_num_rows($selquery);

		if($loginFoundUser == 0)
		{
		$htmlmake = "Invalid Username";
		$htmvalue = "false";
		
		
		}
		else
		{
	
		$htmvalue = "true";
		}
		echo $htmvalue;
	
?>
