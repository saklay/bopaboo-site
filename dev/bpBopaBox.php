<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
//error_reporting(E_ALL);
include_once($includePath."bpSessionCheck.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITENAME; ?></title>
<meta name="title" content=">">
<meta name="description" content="">
<meta name="keywords" content=">">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<link rel="SHORTCUT ICON" href="<?php echo IMAGEPATH ?>logo.ico">
<link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
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
<script type="text/javascript" src="scripts/jqueryboxbopabox.js"></script>
<script type="text/javascript" src="scripts/thickboxbopabox.js"></script>
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="scripts/bpCommon.js" type="text/javascript"></script>
<script language="javascript">
	function clstext(){
		document.form2.textfield.value="";
		}
		
	function checkSessionBeforePopup() {
		xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null) {
				alert ("Your browser does not support AJAX!");
				return;
			} 
			var url="getSessionStatus.php";
			xmlHttp.onreadystatechange=function(){ 
				if (xmlHttp.readyState==4){ 
					if(xmlHttp.responseText =="0") {
						window.location.href= "<?php echo HTTPS . 'bpBopaLogin.php?returnUrl=bpBopaBox.php'; ?>";
					}
					else{
						window.open("uploadMyBopa.php?ret=2","bopaboo","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,screenX=150,screenY=150,top=150,left=150,height=640,width=880");
					}
				}
			}
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);
	}
</script>
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

	global $arrPageRange;
	
	
	
	$pageRange	        = HTMLOptionKeyValArray($arrPageRange,$clsbpFileDetails->pageSize);


	
	
	include_once($includePath."templates/bpBopaBox.tmpl.php");
	
}


ob_end_flush(); 
?>