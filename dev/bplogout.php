<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);
$includePath		= "./";
$pageTitle			= "www.bopaboo.com";
$metaDescription	= "";
$metaKeywords		= "";

include_once($includePath."bpCommon.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpBopaCart.cls.php");

$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
$clsbpBopaCart	= new clsbpBopaCart($connect, $includePath,"clsbpBopaCart");

$clsbpUserLogin->logout();
$clsbpUserLogin->deleteCookie();
$cartSize = count($_SESSION['bopaBasket']['song']);
 if(isset($_SESSION['bopaBasket']['song'])){		
	   
	   for($i=1;$i<=$cartSize;$i++)
		{	
		$FileID = $_SESSION['bopaBasket']['song'][$i-1];
		//$clsbpBopaCart->fn_LockUnlockFile(0,$FileID);
		//$clsbpBopaCart->fn_DeleteItemfromCartTable($FileID);
		
		$query	= "	DELETE FROM tbl_cart WHERE bi_MemberId=".$_SESSION['USERID']." AND bi_FileID=$FileID";
		
		mysql_query($query)or die();
		
		$queryNew	= "UPDATE tbl_bopabox SET ti_lock=0 WHERE bi_file_id=$FileID";
		mysql_query($queryNew)or die(mysql_error());;
		}
}
								


	setcookie("COOKIE_USERNAME","", time() - 1*24*3600,"/");
		setcookie("COOKIE_USERID","", time() - 1*24*3600,"/");	
session_unset('bopaBasket');

header("Location:index.php");
ob_end_flush(); 
?>