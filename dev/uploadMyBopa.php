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
	<title>bopaboo Music Upload Tool</title>
	<script language="javascript">AC_FL_RunContent = 0;</script>
	<script src="scripts/AC_RunActiveContent.js" language="javascript"></script>
	
	<script language="JavaScript">
	     function refresh() {
		 window.opener.location = 'bpBopaBox.php?submitted=1';
	     }
		 function closewindow(){
		 
		 window.close();
		 }
	</script>
</head>
<?php if($_REQUEST["ret"]=='2') { ?>
<body onunload="self.opener.location.href='bpBopaBox.php?tabName=All'">
<?php }
else { ?>
<body onunload="self.opener.location.href='bpMyBopa.php'">
<?php } ?>

<form name="frmflash" action="" method="post">

<script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '880',
			'height', '625',
			'src', 'mp3uploader',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'mp3uploader',
			'bgcolor', '#ffffff',
			'name', 'mp3uploader',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', 'mp3uploader?defaultSalePrice=<?php echo $clsbpUserLogin->defaultPrice;?>',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="880" height="625" id="mp3uploader" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="FlashVars" value="defaultSalePrice=<?php echo $clsbpUserLogin->defaultPrice; ?>" />
	<param name="movie" value="mp3uploader.swf" FlashVars="defaultSalePrice=<?php echo $clsbpUserLogin->defaultPrice;?>" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="mp3uploader.swf" quality="high" bgcolor="#ffffff" width="880" height="625" name="mp3uploader" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</noscript>
</form>
</body>
</html>