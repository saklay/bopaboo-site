<?php
ob_start();
header("Cache-Control: no-store, no-cache");
set_time_limit (60);
$includePath		= "./";
include_once($includePath."bpCommon.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."classes/bpHelp.cls.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITENAME; ?></title>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="javascript">

	var xmlHttp

	function showAnswerDiv(id, catId, flag){
		
		document.getElementById('loadImage').style.display="block";
		
		for(i=0; i<list.length;i++)
		{
			nId = list[i];
			document.getElementById('main'+nId).style.visibility="hidden"; 
			document.getElementById('main'+nId).style.display="none";
			
			document.getElementById('hdr'+nId).style.visibility="hidden"; 
			document.getElementById('hdr'+nId).style.display="none";
			
			document.getElementById('ftr'+nId).style.visibility="hidden"; 
			document.getElementById('ftr'+nId).style.display="none"; 				
			
		}
		
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null) {
			alert ("Your browser does not support AJAX!");
			return;
		} 
		var url="bpGetAnswer.php?id="+id+"&catId="+catId+"&flag="+flag;
		xmlHttp.onreadystatechange=stateChanged;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	} 
	
	function stateChanged() { 
		if (xmlHttp.readyState==4) { 
			document.getElementById('hdrAns').style.visibility="visible"; 
			document.getElementById('hdrAns').style.display="block"; 
			document.getElementById('ftrAns').style.visibility="visible"; 
			document.getElementById('ftrAns').style.display="block"; 
			document.getElementById('mainAns').style.visibility="visible"; 
			document.getElementById('mainAns').style.display="block"; 
			document.getElementById("mainAns").innerHTML=xmlHttp.responseText;
			document.getElementById('loadImage').style.display="none";
		}		
	}
	
	function GetXmlHttpObject(){
		var xmlHttp=null;
		try{
			// Firefox, Opera 8.0+, Safari
			xmlHttp=new XMLHttpRequest();
		}
		catch (e) {
			// Internet Explorer
			try
			{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e)
			{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
		return xmlHttp;
	}

	function clstext(){
		document.frmHelp.clsbpHelp_SearchKeyword.value="";
	}
	function chktext(){ 
		if(document.frmHelp.clsbpHelp_SearchKeyword.value=="") {
			document.frmHelp.clsbpHelp_SearchKeyword.value="search help";
		}
	}
	
	function showDiv(id, obj) {
		temp=id;
		for(i=0; i<list.length;i++)
		{
			nId = list[i];
			/* document.getElementById('link'+nId).style.background="#8DC740 none repeat scroll 0%"; */
			document.getElementById('tablink'+nId).className="tabOff";
			
		}
		document.getElementById('tablink'+id).className="tab";
		/* obj.style.background="#0066CC none repeat scroll 0%" */

		
		document.getElementById('hdrAns').style.visibility="hidden"; 
		document.getElementById('hdrAns').style.display="none"; 
		document.getElementById('ftrAns').style.visibility="hidden"; 
		document.getElementById('ftrAns').style.display="none"; 
		document.getElementById('mainAns').style.visibility="hidden"; 
		document.getElementById('mainAns').style.display="none";
		
		for(i=0; i<list.length;i++)
		{
			nId = list[i];
			if(id!=nId) {
				document.getElementById('main'+nId).style.visibility="hidden"; 
				document.getElementById('main'+nId).style.display="none";
				
				document.getElementById('hdr'+nId).style.visibility="hidden"; 
				document.getElementById('hdr'+nId).style.display="none";
				
				document.getElementById('ftr'+nId).style.visibility="hidden"; 
				document.getElementById('ftr'+nId).style.display="none"; 				
			}
			
		}
		document.getElementById('main'+id).style.visibility="visible"; 
		document.getElementById('main'+id).style.display="block";
	
		document.getElementById('hdr'+id).style.visibility="visible"; 
		document.getElementById('hdr'+id).style.display="block";
	
		document.getElementById('ftr'+id).style.visibility="visible"; 
		document.getElementById('ftr'+id).style.display="block"; 
	}
	
	function displayMain(id) {
		for(i=0; i<list.length;i++)
		{
			nId = list[i];
			document.getElementById('link'+nId).style.background="#8DC740 none repeat scroll 0%";
		}
		document.getElementById('link0').style.background ="#0066CC none repeat scroll 0%";
		document.getElementById('main').style.visibility="visible"; 
		document.getElementById('main').style.display="block";
				
		document.getElementById('hdr').style.visibility="visible"; 
		document.getElementById('hdr').style.display="block";
		
		document.getElementById('ftr').style.visibility="visible"; 
		document.getElementById('ftr').style.display="block"; 
		
		
		for(i=0; i<list.length;i++)
		{
			nId = list[i];
			document.getElementById('main'+nId).style.visibility="hidden"; 
			document.getElementById('main'+nId).style.display="none";
			
			document.getElementById('hdr'+nId).style.visibility="hidden"; 
			document.getElementById('hdr'+nId).style.display="none";
			
			document.getElementById('ftr'+nId).style.visibility="hidden"; 
			document.getElementById('ftr'+nId).style.display="none"; 				
			
		}
	}
		
	function submitForm() {
 		var frm = document.frmHelp;
 	
		var keyword = frm.clsbpHelp_SearchKeyword.value;
		
		
		
		for(i=0; i<list.length;i++)
		{
			nId = list[i];
			// document.getElementById('link'+nId).style.background="#8DC740 none repeat scroll 0%";
			document.getElementById('tablink'+nId).className="tabOff";
		}
		
		for(i=0; i<list.length;i++)
		{
			nId = list[i];
			document.getElementById('main'+nId).style.visibility="hidden"; 
			document.getElementById('main'+nId).style.display="none";
			
			document.getElementById('hdr'+nId).style.visibility="hidden"; 
			document.getElementById('hdr'+nId).style.display="none";
			
			document.getElementById('ftr'+nId).style.visibility="hidden"; 
			document.getElementById('ftr'+nId).style.display="none"; 				
			
		}
		
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null) {
			alert ("Your browser does not support AJAX!");
			return;
		} 
		var url="bpFaqSearchResults.php?kw="+keyword;
		xmlHttp.onreadystatechange=stateChangedSearch;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
		return false;
	} 
	
	function stateChangedSearch() { 
		if (xmlHttp.readyState==4) { 
			document.getElementById('hdrAns').style.visibility="visible"; 
			document.getElementById('hdrAns').style.display="block"; 
			document.getElementById('ftrAns').style.visibility="visible"; 
			document.getElementById('ftrAns').style.display="block"; 
			document.getElementById('mainAns').style.visibility="visible"; 
			document.getElementById('mainAns').style.display="block"; 
			document.getElementById("mainAns").innerHTML=xmlHttp.responseText;
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
<noscript>
	<h3>You have a browser with javascript disabled. You'll not be able to work on bopaboo until you change your browser settings. </h3>
</noscript>
    <div id="wrapper">
	<?php
        include_once($includePath."includes/bpUserCommonBody.inc.php"); 
        ?>
</div>
</body>
</html>
<?php
function writeMain($connect, $includePath) {

/*----------------------------------------------------------------------------	
	 For Sign In Popup*/
	$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");

	$clsbpUserLogin->setGetVars(); 
	 $clsbpUserLogin->postContactForUserDeatils(); 
	
	/*---------------------------------------------------------------------------*/
	$clsbpHelp	= new clsbpHelp($connect, $includePath,"clsbpHelp");
	$clsbpHelp->setPostVars();
	$clsbpHelp->setGetVars();
	$catArray = $clsbpHelp->getAllHelpCategory();
	
	include_once($includePath."templates/bpHelp.tmpl.php");
}

ob_end_flush(); 
?>
