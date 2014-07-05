<?php
	ob_start();
	header("Cache-Control: no-store, no-cache");
	set_time_limit (60);
	$includePath		= "./";
	
	include_once($includePath."bpCommon.php");
	
	include_once($includePath."bpSessionCheck.php");
	include_once($includePath."classes/bpPayment.cls.php");
	include_once($includePath."classes/bpFileDetails.cls.php");
	include_once($includePath."classes/bpRatings.cls.php");
	include_once($includePath."classes/bpMessages.cls.php");
	include_once($includePath."classes/bpAnnouncements.cls.php");
	include_once("classes/bpMailImport.cls.php");
	// 	error_reporting(E_ALL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>bopaboo - Your Place to Buy and Sell Digital Music</title><script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script><script type="text/javascript" src="animation.js"></script>
    <link rel="stylesheet" href="styles/thickbox.css" type="text/css"  />
    <link href="styles/bopaboov2.css" rel="stylesheet" type="text/css" />
    <link href="styles/mybopa.css" rel="stylesheet" type="text/css" />
    <link href="styles/custom.css" rel="stylesheet" type="text/css" />
    <link href="star_rating.css" rel="stylesheet" type="text/css" media="all">
    <script type="text/javascript" src="scripts/jquery.js"></script><script type="text/javascript" src="scripts/thickbox.js"></script><script src="scripts/jquery-1.2.3.min.js" type="text/javascript"></script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="styles/bopabox-ie7.css" />
<![endif]-->
<!--[if lt IE 7.]>
<script defer type="text/javascript" src="scripts/pngfix.js"></script>
<![endif]--><script>
	var xmlHttp;
	
	
	var timerID1 = 2;
	var timerID2 = 2;
	var timerID3 = 2;
	var timerID4 = 2;
	
	var t1;
	var t2;
	var t3;
	var t4;
	
	var ts1=0;
	var ts2=0;
	var ts3=0;
	var ts4=0;
	
	var mesCheck = 0;
	var mFlag1 =0;
	var mFlag2 =0;
	var mFlag3 =0;
	var mFlag4 =0;
	
	window.onload = (function(){
	try {  
		
		
		$(document.getElementById("announce")).click(function () {
			getDivContents("announcediv");
			if ($(document.getElementById("announcediv")).is(":hidden")) {
				$(document.getElementById("announcediv")).slideDown("slow");
				document.getElementById('announcediv').style.visibility = 'visible';
			} 
		}
		);
		$(document.getElementById("PromoteStore")).click(function () {
			
			if ($(document.getElementById("PromoteStoreContent")).is(":hidden")) {
					document.getElementById("PromoteStoreContent").style.display = '';
			} 
			else{
			document.getElementById("PromoteStoreContent").style.display = 'none';
			
			}
		}
		);
	}
	catch(e){
	}
	}
	);


	function doHide(val) {
		if(val ==1) {
			if(ts1==0) {
				hide(1);
				clearTimeout(t1);
				timerID1=2;
				return;
			}
		}
		
		else if(val ==2) {
			if(ts2==0) {
				hide(2);
				clearTimeout(t2);//alert(t);
				timerID2=2;
				return;
			}
		}
		
		else if(val ==3) {
			if(ts3==0) {
				hide(3);
				clearTimeout(t3);//alert(t);
				timerID3=2;
				return;
			}
		}
		
		else if(val ==4) {
			if(ts4==0) {
				hide(4);
				clearTimeout(t4);//alert(t);
				timerID4=2;
				return;
			}
		}
	
		
	}

	$(document).ready(function() { 
		$("div.mtest").mouseover(function(event){  /** Here starts the drop down div function. Invokes when user mouseovers on any of the DIVS */
			ts1=1;	
			show(1);
			
		}).mouseout(function(){
			ts1=0;
			setTimeout("doHide(1);",500);
		});
	
		$("div.selltest").mouseover(function(event){
			ts2=1;
			show(2);
		}).mouseout(function(){
			ts2=0;
			setTimeout("doHide(2);",500);
		});
	
		$("div.srchtest").mouseover(function(event){
			ts3=1;
			show(3);
		}).mouseout(function(){
			ts3=0;
			setTimeout("doHide(3);",500);
		});
	
		$("div.srch1test").mouseover(function(event){
			ts4=1;
			show(4);
		}).mouseout(function(){
			ts4=0;
			setTimeout("doHide(4);",500);
		});
	}); 


	function show(id)
	{
		document.getElementById("tab00"+id).style.backgroundColor="#fff";

		if(id==1)
		{	
// 			document.getElementById('mtest_val').value=timerID1;
// 			document.getElementById('mtest_val2').value=t1;
			if(timerID1==0)
			{	
				document.getElementById("tab00"+id).style.backgroundColor="#fff";
				showMessage();
				
				clearTimeout(t1);//alert(t);
				timerID1=2;
				return;
			}
			
			timerID1--;
			t1 = setTimeout("show(1)", 500);
		}
		
		else if(id==2)
		{	
	
// 			document.getElementById('mtest_val3').value=timerID2;
// 			document.getElementById('mtest_val4').value=t2;
			if(timerID2==0)
			{	
				document.getElementById("tab00"+id).style.backgroundColor="#fff";
				showSellers();
				clearTimeout(t2);//alert(t);
				timerID2=2;
				return;
			}
			
			timerID2--;
			t2 = setTimeout("show(2)", 500);
		}
		
		else if(id==3)
		{	
			
			if(timerID3==0) {	
			
				document.getElementById("tab00"+id).style.backgroundColor="#fff";
				showSearch();
				clearTimeout(t3);//alert(t);
				timerID3=2;
				return;
				
			}
			
			timerID3--;
			t3 = setTimeout("show(3)", 500)
			
		}
		
		else if(id==4) {	
			
			if(timerID4==0) {
				
				document.getElementById("tab00"+id).style.backgroundColor="#fff";
				ts=0;

				showSearch1();
				clearTimeout(t4);//alert(t);
				timerID4=2;
				return;
				
			}
			
			timerID4--;
			t4 = setTimeout("show(4)", 500)
		}
		
	}

	function hide(id)  {	
		document.getElementById("tab00"+id).style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab00"+id).style.background="transparent url(../images/bg-email.png) no-repeat scroll 50px 22px";
		
		
		if((id == 1) ) {
		
			hideMessages();
			clearTimeout(t1);//alert(t);
			//timerID1=2;
			return;
			
		}
		
		else if((id == 2) ) {
		
			hideSellers();
			clearTimeout(t2);//alert(t);
			//timerID2=2;
			return;
			
		}
		
		else if((id == 3) ) {
		
			hideSearch();
			clearTimeout(t3);//alert(t);
			//timerID3=2;
			return;
			
		}
		
		else if((id == 4) ) { 
		
			hideSearch1();
			clearTimeout(t4);//alert(t);
			//timerID4=2;
			return;
			
		}
		
		
	}


	function showMessage() {
				if(mFlag1==0) {
					getDivContents("messages");
				}
				
				$(document.getElementById("sellers")).slideUp();
				document.getElementById("tab002").style.borderBottom="1px solid #D6DBDE";
				document.getElementById("tab002").style.background="transparent url(../images/bg-savedsellers.png) no-repeat scroll 60px 22px";
				$(document.getElementById("search")).slideUp();
				document.getElementById("tab003").style.borderBottom="1px solid #D6DBDE";
				document.getElementById("tab003").style.background="transparent url(../images/bg-popsearch.png) no-repeat scroll 35px 14px";
				$(document.getElementById("search1")).slideUp();
				document.getElementById("tab004").style.borderBottom="1px solid #D6DBDE";
				document.getElementById("tab004").style.background="transparent url(../images/bg-savedsearch.png) no-repeat scroll 40px 14px";
				
				if ($(document.getElementById("messages")).is(":hidden")) {
					
					$(document.getElementById("messages")).slideDown("slow");
					document.getElementById("tab001").style.borderBottom=0;
					document.getElementById("tab001").style.backgroundColor="#fff";
					mFlag1=1;
				} 	
	}


	function hideMessages(){
	
		$(document.getElementById("messages")).slideUp();
		document.getElementById("tab001").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab001").style.background="transparent url(../images/bg-email.png) no-repeat scroll 50px 22px";
		mFlag1 = 0;	
	}
	
	function showSellers() {
	
		if(mFlag2==0) {
			getDivContents("sellers");
		}
		
		$(document.getElementById("messages")).slideUp();
		document.getElementById("tab001").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab001").style.background="transparent url(../images/bg-email.png) no-repeat scroll 50px 22px";
		$(document.getElementById("search")).slideUp();
		document.getElementById("tab003").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab003").style.background="transparent url(../images/bg-popsearch.png) no-repeat scroll 35px 14px";
		$(document.getElementById("search1")).slideUp();
		document.getElementById("tab004").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab004").style.background="transparent url(../images/bg-savedsearch.png) no-repeat scroll 40px 14px";
		
		if ($(document.getElementById("sellers")).is(":hidden")) {
		
			$(document.getElementById("sellers")).slideDown("slow");
			document.getElementById("tab002").style.borderBottom=0;
			document.getElementById("tab002").style.backgroundColor="#fff";
			mFlag2 = 1;
		} 
	}
	
	function hideSellers() {
	
		$(document.getElementById("sellers")).slideUp();
		document.getElementById("tab002").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab002").style.background="transparent url(../images/bg-savedsellers.png) no-repeat scroll 60px 22px";
		mFlag2 = 1;
	}
	
	function showSearch() {
		
		if(mFlag3==0) {
			getDivContents("search");
		}
		
		$(document.getElementById("messages")).slideUp();
		document.getElementById("tab001").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab001").style.background="transparent url(../images/bg-email.png) no-repeat scroll 50px 22px";
		$(document.getElementById("sellers")).slideUp();
		document.getElementById("tab002").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab002").style.background="transparent url(../images/bg-savedsellers.png) no-repeat scroll 60px 22px";
		$(document.getElementById("search1")).slideUp();
		document.getElementById("tab004").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab004").style.background="transparent url(../images/bg-savedsearch.png) no-repeat scroll 40px 14px";
		
		if ($(document.getElementById("search")).is(":hidden")) {
		
			$(document.getElementById("search")).slideDown("slow");
			document.getElementById("tab003").style.borderBottom=0;
			document.getElementById("tab003").style.backgroundColor="#fff";
			mFlag3 = 1;
		} 
	}
	
	function hideSearch() {
	
		$(document.getElementById("search")).slideUp();
		document.getElementById("tab003").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab003").style.background="transparent url(../images/bg-popsearch.png) no-repeat scroll 35px 14px";
		mFlag3 = 0;
	}
	
	function showSearch1() {
	
		if(mFlag4==0) {
			getDivContents("search1");
		}
		
		$(document.getElementById("messages")).slideUp();
		document.getElementById("tab001").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab001").style.background="transparent url(../images/bg-email.png) no-repeat scroll 50px 22px";
		$(document.getElementById("sellers")).slideUp();
		document.getElementById("tab002").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab002").style.background="transparent url(../images/bg-savedsellers.png) no-repeat scroll 60px 22px";
		$(document.getElementById("search")).slideUp();
		document.getElementById("tab003").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab003").style.background="transparent url(../images/bg-popsearch.png) no-repeat scroll 35px 14px";
		
		if ($(document.getElementById("search1")).is(":hidden")) {
		
			$(document.getElementById("search1")).slideDown("slow");
			document.getElementById("tab004").style.borderBottom=0;
			document.getElementById("tab004").style.backgroundColor="#fff";
			mFlag4 = 1;
			
		} 
	}
	
	function hideSearch1() {
	
		$(document.getElementById("search1")).slideUp();
		document.getElementById("tab004").style.borderBottom="1px solid #D6DBDE";
		document.getElementById("tab004").style.background="transparent url(../images/bg-savedsearch.png) no-repeat scroll 40px 14px";
		mFlag4 = 0;
		
	}
	
	function getDivContents(id) {
			xmlHttp=GetXmlHttpObject();
				if (xmlHttp==null) {
					alert ("Your browser does not support AJAX!");
					return;
				}
				switch(id) {
					
					case "messages": 
									var url="bpGetMessages.php";
									break;
					case "search1": 
									var url="getSavedSearches.php";
									break;
					case "search":
									var url="bpGetPopularSearches.php";
									break;
					case "sellers":	
									var url="getFavSellers.php";
									break;
					case "announcediv":	
									var url="getAnnouncement.php";
									//document.getElementById('announcediv').style.visibility = 'hidden'; 
									break;
					case "PromoteStoreContent":	
									var url="getPromoteStore.php";
									
									break;
					
				}
				xmlHttp.onreadystatechange=function(){ 
					if (xmlHttp.readyState==4){ 
						document.getElementById(id).innerHTML=xmlHttp.responseText;
				
					}
		}
				xmlHttp.open("GET",url,true);
				xmlHttp.send(null);
	}		
	
	
	function GetXmlHttpObject() {
		var xmlHttp=null;
		try{
			// Firefox, Opera 8.0+, Safari
			xmlHttp=new XMLHttpRequest();
		}
		catch (e){
			// Internet Explorer
			try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch (e){
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
		return xmlHttp;
	}
  	
	function deleteSearch(id) {
		xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null) {
				alert ("Your browser does not support AJAX!");
				return;
			} 
			var url="bpDeleteSearch.php?id="+id;
			xmlHttp.onreadystatechange=function(){ 
				if (xmlHttp.readyState==4){ 
					document.getElementById("search1").innerHTML=xmlHttp.responseText;
				}
			}
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);
	} 
	
	function deleteFav(id) {
		xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null) {
				alert ("Your browser does not support AJAX!");
				return;
			} 
			var url="bpDeleteFavSeller.php?id="+id;
			xmlHttp.onreadystatechange=function(){ 
				if (xmlHttp.readyState==4){ 
					document.getElementById("sellers").innerHTML=xmlHttp.responseText;
				}
			}
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);
	} 
	
	function deleteMessage(id) {
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null) {
			alert ("Your browser does not support AJAX!");
			return;
		} 
		var url="bpDeleteMessage.php?id="+id;
		xmlHttp.onreadystatechange=function(){ 
			if (xmlHttp.readyState==4){ 
				document.getElementById("messages").innerHTML=xmlHttp.responseText;
				changeMessageCount();
			}
		}
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	} 
	
	function changeMessageCount() {
		
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null) {
			alert ("Your browser does not support AJAX!");
			return;
		} 
		var url="bpGetMessageCount.php";
		xmlHttp.onreadystatechange=function(){ 
			if (xmlHttp.readyState==4){ 
				document.getElementById("countText").innerHTML=xmlHttp.responseText;
			}
		}
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
		
	}
	
	function readMessage(id) {
		var frm = document.frmMyBopa;
		frm.clsbpMessages_messageId.value = id;
		frm.action = "bpMyBopaMessageView.php";
		//alert(frm.clsbpMessages_messageId.value);
		frm.submit();
	}
	
	function searchItem(titleName, artistName) {
		var frm = document.frmTopList;
		frm.clsbpFileDetails_flagTopSearch.value = 1;
		frm.clsbpFileDetails_vc_title_nm_mod.value = titleName ;
		frm.clsbpFileDetails_vc_artists_nm_mod.value= artistName;
		frm.submit();
		return true;
	} 
	
	function getDivDefault() {
		xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null) {
				alert ("Your browser does not support AJAX!");
				return;
			} 
			var url="getAnnouncementDefault.php";
			xmlHttp.onreadystatechange=function(){ 
				if (xmlHttp.readyState==4){ 
					document.getElementById("announcediv").innerHTML=xmlHttp.responseText;
				}
			}
			xmlHttp.open("GET",url,true);
			xmlHttp.send(null);
	}
	
	function getAjaxLinkActive(){
		getDivContents("announcediv");
		if ($(document.getElementById("announcediv")).is(":hidden")) {
			$(document.getElementById("announcediv")).slideDown("slow");
			document.getElementById('announcediv').style.visibility = 'visible';
		} 
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
	
	$clsbpFileDetails	= new clsbpFileDetails($connect, $includePath,"clsbpFileDetails");
	$clsbpFileDetails->setPostVars();
	$clsbpFileDetails->setGetVars();

    	$clsbpFileDetails->submitted = 1;
    	$clsbpFileDetails->postFiles();
    	
    	/*----------------------------------------------------------------------------	
	 Created payment object*/
	$clsbpPayment	= new clsbpPayment($connect, $includePath,"clsbpPayment");
	$clsbpPayment->postPayment();
	$arrBank = $clsbpPayment->retrieveBankAmount();
	
	/*---------------------------------------------------------------------------*/
	
	/*--------------------------------------------------------------------------------*/
	
	$clsbpRatings	= new clsbpRatings($connect, $includePath,"clsbpRatings");
	$rating = $clsbpRatings->fn_showUserRatingsAsImage($_SESSION['USERID']);
	/*--------------------------------------------------------------------------------*/
	
	/*-------------Create Messaging object ----------------------*/
	$clsbpMessages	= new clsbpMessages($connect, $includePath,"clsbpMessages");
	$countMessages = $clsbpMessages->getNewMessageSentCount();
	/*--------------------------------------------- ----------------------*/
	
	
	/*-------------Create Announcement object ----------------------*/
	$clsbpAnnouncements	= new clsbpAnnouncements($connect, $includePath,"clsbpMessages");
	$clsbpAnnouncements->getLatestAnnouncementDetails();
	
// 	displayObject($clsbpAnnouncements);
	/*--------------------------------------------- ----------------------*/
	
	
 	$clsbpFileDetails->getUserMybopaCount($_SESSION['USERID']);	
 	$clsbpFileDetails->getUserMybopaSellCount($_SESSION['USERID']); 	
 	$clsbpFileDetails->getAllBopaCount();
 	$clsbpFileDetails->getCurrentYearStat($_SESSION['USERID']);
 	$arrDet = $clsbpFileDetails->getTopSellingSongsList();
//  	$arrObj = get_object_vars($clsbpFileDetails);
//  	
//  	echo "<pre>";
//  	print_r($arrMemDet );
//  	echo "</pre>";
$clsbpMailImport	= new clsbpMailImport($connect, $includePath,"clsbpMailImport");

	include_once($includePath."templates/bpMyBopa.tmpl.php");
}

ob_end_flush(); 
?>
