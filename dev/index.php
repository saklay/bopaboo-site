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
$clsbpUserLogin->setPostVars();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITENAME; ?></title>
<meta name="title" content="<?php echo SITENAME; ?>">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<link rel="SHORTCUT ICON" href="<?php echo IMAGEPATH ?>logo.ico">
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/thickbox.js"></script>
<style type="text/css">
	@import url("styles/master.css");
</style>

<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="scripts/AC_RunActiveContent.js" language="javascript"></script>
</head>

<body>
  <div id="wrapper">
		<?php
		  include_once($includePath."includes/bpUserCommonBody.inc.php"); 
		  ?>
  </div>
</body>
</html>
<?php
function writeMain($connect, $includePath) {

	global $clsbpUserLogin;
	
	$clsbpUserLogin->postContactForUserDeatils();
	
		if ($clsbpUserLogin->returnUrl == "") {
			$clsbpUserLogin->returnUrl = "bpMyBopa.php";
	
	   }	

	include_once($includePath."templates/bpIndex.tmpl.php");
}
ob_end_flush(); 
?>