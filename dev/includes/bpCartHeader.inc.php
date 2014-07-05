<?php
	if($_COOKIE['COOKIE_USERNAME']!="" && $_SESSION['USERID']!='') {
		include_once($includePath."classes/bpMessages.cls.php");
		include_once($includePath."classes/bpRatings.cls.php");
		$clsbpMessages		= new clsbpMessages($connect, $includePath,"clsbpMessages");
		$countNewMessages	= $clsbpMessages->getNewMessageSentCount();
		$clsbpRatings			= new clsbpRatings($connect, $includePath,"clsbpRatings");
	}
?>
<SCRIPT language="JavaScript">
var isOpera, isIE = false;if(typeof(window.opera) != 'undefined'){isOpera = true;}if(!isOpera && navigator.userAgent.indexOf('Internet Explorer')){isIE = true};//fix both IE and Opera (adjust when they implement this method properly)
if(isOpera || isIE){  document.nativeGetElementById = document.getElementById;  //redefine it!  
document.getElementById = function(id){    var elem = document.nativeGetElementById(id);    if(elem){      //verify it is a valid match!      
if(elem.attributes['id'] && elem.attributes['id'].value == id){        //valid match!       
 return elem;      } else {        //not a valid match!        //the non-standard, document.all array has keys for all name'd, and id'd elements        //start at one, because we know the first match, is wrong!        
 for(var i=1;i<document.all[id].length;i++){          if(document.all[id][i].attributes['id'] && document.all[id][i].attributes['id'].value == id){            return document.all[id][i];          }        }      }    }    return null;  };}
 
function fnshows (obje){

	if (obje.value=='search all music') {obje.value = '';}
	if (obje.value=='search all') {obje.value = '';}
	if (obje.value=='search artists') {obje.value = '';}
	if (obje.value=='search albums') {obje.value = '';}
	if (obje.value=='search songs') {obje.value = '';}
	if (obje.value=='search sellers') {obje.value = '';}
	document.getElementById('clsbpFileDetails_seachError').value = "";
	}
	function fnhides(obje)
	{
		if(document.getElementById('clsbpFileDetails_seach').value != ""){
			if (obje.value=='') {obje.value = 'search '+document.getElementById('clsbpFileDetails_seach').value;}
		}
		else
		{
			if (obje.value=='') {obje.value = 'search all music'}
		
		}	
}

function fnDisps(obj){

document.getElementById('clsbpFileDetails_txtSea').value = 'search ' + obj.innerHTML;
document.getElementById('clsbpFileDetails_seach').value = obj.innerHTML;

}

function fnsearchInformation(obje){
	var error="";
	var searcharray = new Array();	
	searcharray[0] ="search all music"; 
	searcharray[1] ="search all"; 
	searcharray[2] ="search artists";
	searcharray[3] ="search albums";
	searcharray[4] ="search sellers"; 
   for(i=0;i<searcharray.length;i++)
  
   {
 
   if(document.getElementById('clsbpFileDetails_txtSea').value ==  searcharray[i] && document.getElementById('clsbpFileDetails_seachError').value=="")
   {
   error = "search term should have two or more characters";
   alert(error);
   //var url ="bpBuy.php";
   //window.location=url+"?msg="+error;	
   return false;
   }
   }
if(document.getElementById('clsbpFileDetails_txtSea').value.length <3 && document.getElementById('clsbpFileDetails_txtSea').value != ""){

error = "search term should have two or more characters";
alert(error);
//var url ="bpBuy.php";
//window.location=url+"?msg="+error;	

return false;
}

return true;
}
</SCRIPT>

	
	<!-- start header -->
	<div id="header">
		
		<a href="<?php if($_SESSION["USERID"]!=''){ echo HTTP."bpMyBopa.php";} else{ echo HTTP."index.php";}?>" id="logo">bopaboo – Your Place to Buy and Sell Digital Music</a>
		
		<ul id="accountMenu">
			<?php if($_COOKIE['COOKIE_USERNAME']!="" && $_SESSION['USERID']!='') { ?>
			<li>Welcome <?php print $_COOKIE['COOKIE_USERNAME'] ?></li>
			<li><a href="<?php echo HTTP; ?>bpViewCart.php" class="cart">my cart</a></li>
			<li><a href="<?php echo HTTP; ?>bpMyBopaMessageInbox.php" class="mail">(<?php if($countNewMessages>0){ echo $countNewMessages; } else { echo "0"; } ?>)</a></li>
			<li><a href="bpFeedback.php?feedbacklist=provided" class="favourite">(<?php if($clsbpRatings->totalReviews>0){ echo $clsbpRatings->totalReviews; } else { echo "0"; } ?>)</a></li>
			<li><a href="<?php echo HTTP; ?>bpChangeAccount.php">account</a></li>
			<li><a href="<?php echo HTTP; ?>bpHelp.php">help</a></li>
			<li class="rightEnd"><a href="bplogout.php">logout</a></li>
			<?php } else {  ?>
			<li><a href="<?php echo HTTPS; ?>bpUserSignup.php"><strong>register</strong></a></li>
			<li><a href="<?php echo HTTP; ?>bpViewCart.php" class="cart">my cart</a></li>
			<li><a href="<?php echo HTTP; ?>bpTakeTour.php">take a tour</a></li>
			<li><a href="<?php echo HTTPS; ?>bpBopaLogin.php?returnUrl=<?php echo "bpMyBopa.php"; ?>">login</a></li>
			<li class="rightEnd"><a href="<?php echo HTTP; ?>bpHelp.php">help</a></li>
			<?php } ?>
		</ul>

<?php
			  
	// To find current PHP page
	$script      =($_SERVER['SCRIPT_NAME']);
	$scriptArray = explode ("/",$script);
		
	if($_REQUEST['returnUrl']!=""){
		$scriptArray[2] = $_REQUEST['returnUrl']; }
			
	// Arrays for holding tab selection values
	$homeArray					= array('bpMyBopa.php'); // Home Tab
	$headerBuyArray     = array('bpBuy.php','bpSearch.php','bpViewCart.php','bpOrderDetails.php','bpPayment.php'); // Buy tab
	$headerSellArray    = array('bpSell.php','bpSellLogged.php'); // Sell Tab
	$headerMyBopaArray  = array('bpCreditEdit.php','bpCreditCardAdd.php','bpWithdraw.php','bpBopaBank.php','bpWithdraw.php','bpAccountActivity.php'); // MyBopa tab
	$headerBopaBoxArray = array('bpBopaBox.php','bpViewDetails.php'); // Bopabox tab
?>
		
		<!-- start main nav menu -->
		<div id="menu">
			<ul id="topNav">
				<li class="navHome"><a href="<?php if($_SESSION["USERID"]!=''){ echo HTTP."bpMyBopa.php";} else{ echo HTTP."index.php";}?>" <?php	if(in_array($scriptArray[2],$homeArray))echo 'class="currentsel"'; ?>>home</a></li>
				<li class="navBuy"><a href="bpBuy.php" <?php	if(in_array($scriptArray[2],$headerBuyArray))echo 'class="currentsel"'; ?> >buy</a></li>
				<li class="navSell"><a href="<?php if($_SESSION["USERID"]!=''){ echo HTTP."bpSellLogged.php";} else{ echo HTTP."bpSell.php";}?>" <?php if(in_array($scriptArray[2],$headerSellArray))echo 'class="currentsel"'; ?>>sell</a></li>
				<li class="navBopabox"><a href="<?php if($_SESSION["USERID"]!=''){ echo HTTP."bpBopaBox.php?tabName=All";} else{ echo HTTPS."bpBopaLogin.php?returnUrl=bpBopaBox.php";}?>" 				                   <?php if(in_array($scriptArray[2],$headerBopaBoxArray))echo 'class="currentsel"'; ?>>bopabox</a></li>
				<li class="navBopabank"><a href="<?php if($_SESSION["USERID"]!=''){ echo HTTP."bpMyBopa.php";} else{ echo HTTPS."bpBopaLogin.php?returnUrl=bpMyBopa.php";}?>" <?php if(in_array($scriptArray[2],$headerMyBopaArray))echo 'class="currentsel"'; ?> >bopaBank</a></li>
				<li class="navUpload"><a href="<?php if($_SESSION["USERID"]!=''){ echo HTTP."#";} else{ echo HTTP."bpBopaLogin.php";}?>"><span>upload</span></a></li>
			</ul>
		</div>
		<!-- end main nav menu -->
		
		<!-- start search -->
		<div id="topSearch">
			<form name="formheaderSearch" action="<?php echo HTTP; ?>bpSearch.php" method="post" title="Search" id="searchbox" onsubmit="return fnsearchInformation();">
			    <div id="listings">
			      <ul>
				<li  class="top"><a href="#" id="1" onclick="fnDisps(this)">all</a></li>
				<li><a href="#" id="2" onclick="fnDisps(this)">artists</a></li>
				<li><a href="#" id="3" onclick="fnDisps(this)">albums</a></li>
				<li><a href="#" id="4" onclick="fnDisps(this)">songs</a></li>
				<li class="bottom"><a id="5" onclick="fnDisps(this)" href="#">sellers</a></li>
			      </ul>
			    </div>
				<input name="clsbpFileDetails_txtSearch" type="text" id="clsbpFileDetails_txtSea" value="search all music" onfocus="fnshows(this);" onblur="fnhides(this);"/>
				<input type="hidden"  name="clsbpFileDetails_seachCat" id="clsbpFileDetails_seach"/>
				<input type="hidden" name="clsbpFileDetails_seachError" id="clsbpFileDetails_seachError" value="1" />
			</form>
		</div>
		<!-- end search -->
		
	</div>
	<!-- end header -->
	