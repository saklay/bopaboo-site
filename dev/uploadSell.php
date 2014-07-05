<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";
include_once($includePath."bpCommon.php");

include_once($includePath."classes/bpUserLogin.cls.php");
$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
$clsbpUserLogin->retrieveUserNotificationDeatils($_SESSION['USERID']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>mp3uploader</title>
</head>
<script language="JavaScript">
     function refresh() {
       //  self.opener.location.href='bpBopaBox.php';
	  // self.opener.document.frmflash.action = 'bpBopaBox.php';
	  // self.opener.document.frmflash.submit();
	  
	// window.opener.locaton.href='bpBopaBox.php';
	// self.opener.location.reload();
	 window.opener.location = 'bpBopaBox.php?submitted=1';
     }
	 function closewindow(){
	 
	 window.close();
	 }
</script>


<body onunload="self.opener.location.href='bpSellLogged.php'">
<form name="frmflash" action="" method="post">

<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="880" height="725">
  <param name="movie" value="mp3uploader.swf">
  <param name="quality" value="high">
  <param name="allowScriptAccess" value="sameDomain" />
  <param name="FlashVars" value="defaultSalePrice=<?php echo $clsbpUserLogin->defaultPrice; ?>" />
  <embed src="mp3uploader.swf" FlashVars="defaultSalePrice=<?php echo $clsbpUserLogin->defaultPrice;?>"  quality="high" allowScriptAccess="sameDomain" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="880" height="725"></embed>
</object>
</form>
</body>
</html>