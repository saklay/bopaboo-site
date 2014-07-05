<?php
ob_start();
header("Cache-Control: no-store, no-cache");
set_time_limit (60);
$includePath		= "./";

include_once($includePath."bpCommon.php");
include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."classes/bpGenre.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
$clsbpGenre	= new clsbpGenre($connect, $includePath,"clsbpGenre");
$clsbpGenre->setPostVars();

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
<script language="javascript">
	function display(id)
	{	
		buyNo = "buyTab" + id;
		identity = document.getElementById(buyNo);		
		identity.className = "tab";
		
		for(i = 1;i <=4 ; i++)
		{
			//hide everything except the selected id
			if(id != i)
			{
				buyNo = "buyTab" + i;
				identity=document.getElementById(buyNo);
				identity.className="tabOff";
				document.getElementById('buyContent'+i).style.display="none";
			}
		}
		
		document.getElementById('buyContent'+id).style.display="block";		
	}
	
	function searchItem(titleName, artistName) {
		var frm = document.frmTopList;
		frm.clsbpFileDetails_flagTopSearch.value = 1;
		frm.clsbpFileDetails_vc_title_nm_mod.value = titleName ;
		frm.clsbpFileDetails_vc_artists_nm_mod.value= artistName;
		frm.submit();
		return true;
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

	global $clsbpGenre;
	global $clsbpFileDetails ;
	/*----------------------------------------------------------------------------	
	 For Sign In Popup*/
	$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");

	$clsbpUserLogin->setGetVars(); 
	 $clsbpUserLogin->postContactForUserDeatils(); 
	
	/*---------------------------------------------------------------------------*/
	$clsbpGenre->postCategory();
 	$arrfileDetails = $clsbpGenre->retrieveGenreNameArray();  

	 $arraySize=sizeof($arrfileDetails);
	if($arraySize == 0){
	
	$_SESSION["BPMESSAGE"]	= "No records found!";	
	}
	$clsbpGenre->returnUrl = "";
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->postFiles();
	$clsbpFileDetails->sortColumn = "vc_tags";
	$clsbpFileDetails->sortDirection = "DESC";
	$arrTagname = $clsbpFileDetails->retrieveTagNameArray();  
	$top25Files = $clsbpFileDetails->getTopSellingSongsList();

	$arrayTagSize=sizeof($arrTagname);
	
	include_once($includePath."templates/bpBuy.tmpl.php");
}

ob_end_flush(); 
?>
