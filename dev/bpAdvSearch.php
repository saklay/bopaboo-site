<?php
ob_start();

header("Cache-Control: no-store, no-cache");
set_time_limit (60);
$includePath		= "./";

include_once($includePath."bpCommon.php"); 
//error_reporting(E_ALL);
include_once($includePath."classes/bpBopaCart.cls.php");
include_once($includePath."classes/bpUserLogin.cls.php");
include_once($includePath."classes/bpFileDetails.cls.php");
include_once($includePath."classes/bpGenre.cls.php");
include_once($includePath."classes/bpPaginate.cls.php");

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
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="JavaScript">
	function clearSearch(){
		document.frmsrch.reset();
	}
	
	function checkNumber() {	
		var error="";

		  
		  if(document.frmsrch.clsbpFileDetails_txtSearch.value.length < 2 && document.frmsrch.clsbpFileDetails_lstGenre.value==0 && document.frmsrch.clsbpFileDetails_txtMin.value=="" && document.frmsrch.clsbpFileDetails_txtMax.value=="" && document.frmsrch.clsbpFileDetails_txtSeller.value=="" &&  document.frmsrch.clsbpFileDetails_txtFav.value=="" ){
		error = "search term should have two or more characters";	
		
		document.getElementById("errormsg").innerHTML=error;
		  
			return false;
		}
		
		
		if((document.getElementById('txtMax').value!="" && document.getElementById('txtMin').value!="") && (document.getElementById('txtMin').value <.25 )&&(document.getElementById('txtMax').value <.25) )
		{
		
		document.getElementById('txtMin').style.backgroundColor= "#FF9F9F";
		document.getElementById('txtMax').style.backgroundColor= "#FF9F9F";
		}
	    if(document.getElementById('txtMin').value < 0.25 && document.getElementById('txtMin').value!=""){
		error = "* The minimum search price is $0.25";	
		document.getElementById('txtMin').style.backgroundColor= "#FF9F9F";
		document.getElementById("errmsg").innerHTML=error;
		  
			return false;
		}
		if(document.getElementById('txtMax').value < 0.25 && document.getElementById('txtMax').value!=""){
		error = "* The maximum search price is $0.25";	
		document.getElementById('txtMax').style.backgroundColor= "#FF9F9F";
		document.getElementById("errmsg").innerHTML=error;
		  
			return false;
		}
		
		if((document.getElementById('txtMin').value > document.getElementById('txtMax').value) && document.getElementById('txtMax').value!="" ){
			alert("Enter a  Minimum Price lesser than or equal to Maximum Prize.");
			return false;
		}
		if(!(/^\d+(?:\.\d{0,20})?$/.test(document.getElementById('txtMin').value)) && document.getElementById('txtMin').value!='' ){ 
			document.getElementById('txtMin').focus();
			alert("This is not a valid currency!!!");
			return false;
		}
		if(!(/^\d+(?:\.\d{0,20})?$/.test(document.getElementById('txtMax').value)) && document.getElementById('txtMax').value!='' ){ 
			document.getElementById('txtMax').focus();
			alert("This is not a valid currency!!!");
			return false;
		}
		error="";
	}
	function currencyFormat(fld, milSep, decSep, e) {
				var sep = 0;
				var key = '';
				var i = j = 0;
				var len = len2 = 0;
				var strCheck = '0123456789$';
				var aux = aux2 = '';
				var whichCode = (window.Event) ? e.which : e.keyCode;
				if (whichCode == 13) return true;  // Enter
				if (e.keyCode == 46) return true; 
				if ((whichCode == 8)){
					return true;  // Delete (Bug fixed)
				}
					if(document.frmsrch.flagNew.value==2)
				
				{
				document.frmsrch.flagNew.value=1;
				document.frmsrch.clsbpFileDetails_txtMin.value="";
				
				}
					if(document.frmsrch.flagSecond.value==2)
				
				{
				document.frmsrch.flagSecond.value=1;
				document.frmsrch.clsbpFileDetails_txtMax.value="";
				
				}
				key = String.fromCharCode(whichCode);  // Get key value from key code
				if (strCheck.indexOf(key) == -1) return false;  // Not a valid key
				len = fld.value.length;
				for(i = 0; i < len; i++)
					if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
				aux = '';
				for(; i < len; i++)
					if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
						aux += key;
				len = aux.length;
				if (len == 0) fld.value = '';
				if (len == 1) fld.value = '0'+ decSep + '0' + aux;
				if (len == 2) fld.value = '0'+ decSep + aux;
				if (len > 2) {
					aux2 = '';
					for (j = 0, i = len - 3; i >= 0; i--) {
						if (j == 3) {
							aux2 += milSep;
							j = 0;
						}
						aux2 += aux.charAt(i);
						j++;
					}
					fld.value = '';
					len2 = aux2.length;
					for (i = len2 - 1; i >= 0; i--)
						fld.value += aux2.charAt(i);
					fld.value += decSep + aux.substr(len - 2, len);
				}
				var val = fld.value;
				if(val.charAt(0)=='$') {val = val.substr(1); var flag=1;}
				if(flag==1) {
					val='$'+val;
				}
				fld.value = val;
				return false;
	}
		function fnSelect()
				{
			
				
				document.frmsrch.flagNew.value=2;
				
				}
				function fnSelectSecond()
				{
			
				
				document.frmsrch.flagSecond.value=2;
				
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
	//global $clsbpGenre;

	/*----------------------------------------------------------------------------	
	 For Sign In Popup*/
	$clsbpUserLogin	= new clsbpUserLogin($connect, $includePath,"clsbpUserLogin");

	$clsbpUserLogin->setGetVars(); 
	 $clsbpUserLogin->postContactForUserDeatils(); 
	
	/*---------------------------------------------------------------------------*/
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();
	$clsbpFileDetails->postFiles();
	
// 	$arryObj = get_object_vars($clsbpFileDetails);
// 	
// 	echo "<pre>";
// 	print_r($arryObj);
// 	echo "</pre>";
	/*if($clsbpFileDetails->searchMinAmount < 0.25 && $clsbpFileDetails->searchMinAmount!=0)
	{
		$_SESSION["BPMESSAGE"] = "* The minimum search price is $0.25";
	}*/ 
	if($clsbpFileDetails->saveId) {
		$clsbpFileDetails->populateAdvSearch();  // If the request is from edit saved searhes option in bpMyBopa, populate the advanced search fields from the saved query;
	}
	$pageRange	        = HTMLOptionKeyValArray($arrPageRange,$clsfmCategory->pageSize);
	
	$genreList	       = $clsbpFileDetails->getAllGenre(); // Gets all the music genere from database
	
	$GenreListControl  = HTMLOption2DArray($genreList, "bi_GenreId","vc_GenreName",$clsbpFileDetails->searchGenre);  // Converts the 2-diamentional Genere List array to HTML option control
	include_once($includePath."templates/bpAdvSearch.tmpl.php");
}

ob_end_flush(); 
?>
