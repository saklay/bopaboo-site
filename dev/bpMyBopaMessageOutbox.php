<?php
ob_start();

header("Cache-Control: no-store, no-cache");
set_time_limit (60);
$includePath		= "./";

include_once($includePath."bpCommon.php"); 
include_once($includePath."bpSessionCheck.php");
//   error_reporting(E_ALL);
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
<script type="text/javascript" src="scripts/bpCommon.js"></script>
<script language="javascript" type="text/javascript">
	function readMessage(id) {
		var frm = document.frmOutbox;
		frm.clsbpMessages_messageId.value = id;
		frm.chkIfFromOutbox.value= 1;
		//alert(frm.clsbpMessages_messageId.value);
		frm.submit();
	}
	
	function fnSetAllCheckBoxes(FormName, FieldName, CheckValue)
	{
		if(!document.forms[FormName])
			return;
		var objCheckBoxes = document.forms[FormName].elements[FieldName];
		if(!objCheckBoxes)
			return;
		var countCheckBoxes = objCheckBoxes.length;
		if(!countCheckBoxes)
			objCheckBoxes.checked = CheckValue;
		else
			// set the check value for all check boxes
			for(var i = 0; i < countCheckBoxes; i++)
				objCheckBoxes[i].checked = CheckValue;
	}
	
	
	function fn_delMesgs()
	{
		var frmMsg = document.frmOutbox;

		msgIds		= getCheckedItem(frmMsg,"toDelete[]");
		
		if(msgIds==undefined || msgIds==''){
			alert('Please select at least one messaeg to delete');
			return false
		}
		else{
			
			frmMsg.action = "bpMyBopaMessageOutbox.php";
			frmMsg.clsbpMessages_delIds.value = msgIds;
			
			
			frmMsg.clsbpMessages_action.value = "DELETEM";
			
			frmMsg.submit();
			
		}
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
	$clsbpMessages->postMessages();
	$arrMessages = $clsbpMessages->getMessageSentList();
	include_once($includePath."templates/bpMyBopaMessageOutbox.tmpl.php");
}

ob_end_flush(); 
?>