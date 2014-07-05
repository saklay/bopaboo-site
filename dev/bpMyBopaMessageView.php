<?php
ob_start();

header("Cache-Control: no-store, no-cache");
set_time_limit (60);
$includePath		= "./";

include_once($includePath."bpCommon.php"); 
include_once($includePath."bpSessionCheck.php");
//error_reporting(E_ALL);
include_once($includePath."classes/bpBopaCart.cls.php");

include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpMessages.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITENAME; ?></title>
<meta name="title" content="">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="SHORTCUT ICON" href="<?php echo IMAGEPATH ?>logo.ico">
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
	function viewMessage(id) {
		var frm = document.msgForm;
		frm.clsbpMessages_newToId.value = id;
		//alert(frm.clsbpMessages_messageId.value);
		frm.submit();
	}
	
	function deleteFile(fId, check) {
		var frmMsg = document.msgForm;
		if(check==0)
			frmMsg.action="bpMyBopaMessageInbox.php";
		else
			frmMsg.action="bpMyBopaMessageOutbox.php";
		frmMsg.clsbpMessages_delId.value = fId;
		frmMsg.clsbpMessages_action.value = "DELETES";
		frmMsg.submit();
	}
</script>
<style type="text/css">
@import "styles/master.css";
</style>
<!--[if IE]>
	<style type="text/css">
		@import "styles/ie.css";
    </style>    
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]-->
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
	$clsbpMessages	= new clsbpMessages($connect, $includePath,"clsbpMessages");
 	$clsbpMessages->setPostVars();
 	$clsbpMessages->setGetVars();
 	if($_REQUEST['chkIfFromOutbox']!=1) {
 		$clsbpMessages->setMessageAsRead();  
 	}
 	$clsbpMessages->postMessages();
 	
//  	displayArray($_POST);
 	
	include_once($includePath."templates/bpMyBopaMessageView.tmpl.php");
}

ob_end_flush(); 
?>