<?php
ob_start();

header("Cache-Control: no-store, no-cache");
set_time_limit (60);
$includePath		= "./";

include_once($includePath."bpCommon.php"); 
include_once($includePath."bpSessionCheck.php");
//  error_reporting(E_ALL);
include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpMessages.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>bopaboo Your Place to Buy and Sell Digital Music</title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="SHORTCUT ICON" href="images/logo.ico">
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
	function sendMessage() {
		var frm = document.frmMessage;
		if(frm.clsbpMessages_toId.value== '-1') {
			alert("No receipients selected!!!");
			return false;
		}
		frm.clsbpMessages_action.value="SENDMSG";
		frm.clsbpMessages_returnUrl.value = "bpMyBopaMessageInbox.php";
		frm.submit();
	}
	
	
	function changeIcon() {
		
		if((document.frmMessage.clsbpMessages_messageContent.value!="") ) {
			document.getElementById('sendContainer').innerHTML = '<a href="javascript: void(0);" onclick="javascript: sendMessage();"><img src="images/icon-sentMail1.png" alt="Sent Mail" width="38" height="26" border="0" align="absmiddle" /></a>&nbsp;<a href="javascript: void(0);" onclick="javascript: sendMessage();">Send</a>';
		}
		else {
			document.getElementById('sendContainer').innerHTML = '<img src="images/icon-sentMailinactive.png" alt="Sent Mail" width="38" height="26" border="0" align="absmiddle" />&nbsp;<a href="javascript: void(0);" onclick="javascript: sendMessage();">Send</a>';
		}
	}
</script>

<link href="styles/header-footer.css" rel="stylesheet" type="text/css" />
<link href="styles/bopaboov2.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />
<link href="styles/custom.css" rel="stylesheet" type="text/css" />
<link href="styles/mybopa.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
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
	
// 	displayArray($_POST);
	
	$clsbpMessages->setPostVars();
	$clsbpMessages->setGetVars();
	
	$clsbpMessages->postMessages();
	
	$arraySentDetails = $clsbpMessages->getMemberSentHistory();
	$arrayReceivedDetails = $clsbpMessages->getMemberReceivedHistory();
	
	$arrayResult = array_merge($arraySentDetails, $arrayReceivedDetails);
	
// 	displayObject($clsbpMessages);
		
	if($clsbpMessages->newToId!=0){
		$newArray = $clsbpMessages->getNewContactDetails($clsbpMessages->newToId);
		$arrayResult = array_merge($arrayResult, $newArray);
	}

	$arrayResult = multi_unique($arrayResult); // REMOVES DUPLICATE ENTRIES FROM THE ARRAY
	
	if($clsbpMessages->newToId==0) {
		$ToListControl  = HTMLOption2DArray($arrayResult, "bi_MemberId","vc_DisplayName"); //No items to select
	}
	else {
		$ToListControl  = HTMLOption2DArray($arrayResult, "bi_MemberId","vc_DisplayName",$clsbpMessages->newToId);  // Item present to select
	}
	

	include_once($includePath."templates/bpMyBopaMessageAll.tmpl.php");
}

ob_end_flush(); 
?>