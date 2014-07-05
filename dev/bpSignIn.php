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



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITENAME; ?></title>
<link rel="SHORTCUT ICON" href="<?php echo IMAGEPATH ?>logo.ico">

<style type="text/css">
@import "styles/signInPopUp.css";
@import "styles/master.css";
</style>

</head>

<body>

		<?php
	
		
		 writeMain($connect, $includePath);
        ?>
 
</body>
</html>
<?php
function writeMain($connect, $includePath) {

	$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");

	$clsbpUserLogin->setGetVars(); 
	 $clsbpUserLogin->postContactForUserDeatils(); 
	

		
	   
		if ($clsbpUserLogin->returnUrl == "index.php") {
			$clsbpUserLogin->returnUrl = "bpMyBopa.php";
	
		
	   }
	  if ($clsbpUserLogin->returnUrl == "bpUserSignup.php") {
			$clsbpUserLogin->returnUrl = "bpMyBopa.php";
	
		
	   }
	    if ($clsbpUserLogin->returnUrl == "bpTermsOfService.php") {
			$clsbpUserLogin->returnUrl = "bpMyBopa.php";
	
		
	   }
	    if ($clsbpUserLogin->returnUrl == "bpSell.php") {
			$clsbpUserLogin->returnUrl = "bpSellLogged.php";
	
		
	   }
	   if (strstr($clsbpUserLogin->returnUrl,"bpViewCart.php")) {
			
			$clsbpUserLogin->returnUrl = "bpPayment.php";
	
		
	   }
	   if ($clsbpUserLogin->returnUrl == "bpForgotPassword.php") {
			$clsbpUserLogin->returnUrl = "bpMyBopa.php";
	
		
	   }
	   if(strstr($clsbpUserLogin->returnUrl,"bpSetPassword.php")) {
			$clsbpUserLogin->returnUrl = "bpMyBopa.php";
		
	   }
	 if(strstr($clsbpUserLogin->returnUrl,"bpConfirmPassword.php")) {
			$clsbpUserLogin->returnUrl = "bpMyBopa.php";		
	   }
	        if(strstr($clsbpUserLogin->returnUrl,"bpReConfirmPassword.php")) {
			$clsbpUserLogin->returnUrl = "bpMyBopa.php";
	
		
	   }
	
	   if ($clsbpUserLogin->returnUrl == "bpConfirmSignup.php") {
			$clsbpUserLogin->returnUrl = "bpMyBopa.php";
	
		
	   }
	   
	   if ($clsbpUserLogin->returnUrl == "bpAdvSearchResult.php") {
			$clsbpUserLogin->returnUrl = "bpAdvSearch.php";
	
		
	   }

	   
	   if ($clsbpUserLogin->returnUrl == "bpBopaLogin.php?returnUrl=bpBopaBox.php") {
			
			
			$clsbpUserLogin->returnUrl = "bpBopaBox.php";
	
		
	   }
	   
	   if ($clsbpUserLogin->returnUrl == "bpBopaLogin.php?returnUrl=bpMyBopa.php") {
			$clsbpUserLogin->returnUrl = "bpMyBopa.php";
	
		
	   }	   
	   
	   if(strstr($clsbpUserLogin->returnUrl,"bpSearch.php")) {
			$clsbpUserLogin->returnUrl = "bpBuy.php";
	
		
	   }
	   if(strstr($clsbpUserLogin->returnUrl,"bpPageNotFound.php")) {
			$clsbpUserLogin->returnUrl = "bpMyBopa.php";
	
		
	   }
	    if(strstr($clsbpUserLogin->returnUrl,"bpMemberStore.php")) {
			$uname = explode("=",$clsbpUserLogin->returnUrl);
			
			$clsbpUserLogin->returnUrl = $uname[1];
	
		
	   }
	 
	   
	   else
	   {
	 $clsbpUserLogin->returnUrl = "$clsbpUserLogin->returnUrl"; 
	   }
	
	
	include_once($includePath."templates/bpSignIn.tmpl.php");
}
ob_end_flush(); 
?>