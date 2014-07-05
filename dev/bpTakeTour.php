<?php
ob_start();
header("Cache-Control: no-store, no-cache");

set_time_limit (60);

$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."bpFunctions.php");

include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpEmailTemplate.cls.php");
include_once($includePath."classes/bpEmail.cls.php");

$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");
$clsbpUserLogin->setPostVars();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITENAME; ?></title>
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script src="scripts/bpCommon.js" type="text/javascript"></script>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script language="javascript">
	function clstext(){
		document.form2.textfield.value="";
		}
		
	function display(id)
	{	
		tourNo = "tabTour" + id;
		identity = document.getElementById(tourNo);		
		identity.className = "tab";
		
		for(i = 1;i <=5 ; i++)
		{
			
			//hide everything except the selected id
			if(id != i)
			{
				tourNo = "tabTour" + i;
				identity=document.getElementById(tourNo);
				identity.className="tabOff";
				document.getElementById('contentTour'+i).style.display="none";
				document.getElementById('rightContentTour'+i).style.display="none";
				document.getElementById('step'+i).src="<?php echo IMAGEPATH ?>step0"+i+".gif";
			}
		}
		
		document.getElementById('contentTour'+id).style.display="block";
		document.getElementById('rightContentTour'+id).style.display="block";
		document.getElementById('step'+id).src="<?php echo IMAGEPATH ?>step0"+id+"Off.gif";
		
		btNext = id + 1;
		if (btNext > 5) {
			document.getElementById('takeTourButtonsNext').style.display="none";
		} else {
			document.getElementById('takeTourButtonsNext').style.display="block";
			document.getElementById('buttonNext').href="javascript:display("+btNext+")";
		}		
		
		btPrev = id - 1;
		if (btPrev < 1) {
			document.getElementById('takeTourButtonsPrevious').style.display="none";
		} else {
			document.getElementById('takeTourButtonsPrevious').style.display="block";
			document.getElementById('buttonPrev').href="javascript:display("+btPrev+")";
		}
		
	}
</script>
<style type="text/css">
@import "styles/master.css";
</style>
<!--[if lt ie 8]>
	<style type="text/css">
		@import url("styles/ie.css");
    </style> 
<![endif]-->
<!--[if lt ie 7]>   
	<script src="scripts/IE8.js" type="text/javascript"></script>
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


	global $clsbpUserLogin;
	$clsbpUserLogin->setPostVars();
	$clsbpUserLogin->setGetVars();
	$clsbpUserLogin->postContactForUserDeatils();
	
	include_once($includePath."templates/bpTakeTour.tmpl.php");
}

ob_end_flush(); 
?>