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
	
		$newLink = mysql_connect("localhost", "root", "Bop9i8u46") or die();;
		mysql_select_db("db_bopaboo_db", $newLink) or die();			
	   
	   for($i=1;$i<=$cartSize;$i++)
		{	
		$FileID = $_SESSION['bopaBasket']['song'][$i-1];
		//$clsbpBopaCart->fn_LockUnlockFile(0,$FileID);
		//$clsbpBopaCart->fn_DeleteItemfromCartTable($FileID);
		
		$query	= "	DELETE FROM tbl_cart WHERE bi_MemberId=".$_SESSION['USERID']." AND bi_FileID=$FileID";
		mysql_query($query,$newLink)or die();
		}
		mysql_close($newLink);	
}
								

$_COOKIE["COOKIE_USERNAME"] = "" ;
$_COOKIE["COOKIE_USERID"] = "" ;
setcookie("COOKIE_USERNAME");
setcookie("COOKIE_USERID");	
session_unset('bopaBasket');

header("Location:index.php");
ob_end_flush(); 
?>