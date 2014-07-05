<SCRIPT language="JavaScript">
var isOpera, isIE = false;if(typeof(window.opera) != 'undefined'){isOpera = true;}if(!isOpera && navigator.userAgent.indexOf('Internet Explorer')){isIE = true};//fix both IE and Opera (adjust when they implement this method properly)
if(isOpera || isIE){  document.nativeGetElementById = document.getElementById;  //redefine it!  
document.getElementById = function(id){    var elem = document.nativeGetElementById(id);    if(elem){      //verify it is a valid match!      
if(elem.attributes['id'] && elem.attributes['id'].value == id){        //valid match!       
 return elem;      } else {        //not a valid match!        //the non-standard, document.all array has keys for all name'd, and id'd elements        //start at one, because we know the first match, is wrong!        
 for(var i=1;i<document.all[id].length;i++){          if(document.all[id][i].attributes['id'] && document.all[id][i].attributes['id'].value == id){            return document.all[id][i];          }        }      }    }    return null;  };}
 
function fnshows (obje){

	if (obje.value=='Search All Music') {obje.value = '';}
	
	if (obje.value=='Search all') {obje.value = '';}
	
	if (obje.value=='Search artists') {obje.value = '';}
	if (obje.value=='Search albums') {obje.value = '';}
	if (obje.value=='Search songs') {obje.value = '';}
	if (obje.value=='Search sellers') {obje.value = '';}
	}
	function fnhides(obje)
	{
		if(document.getElementById('clsbpFileDetails_seach').value != ""){
			if (obje.value=='') {obje.value = 'Search '+document.getElementById('clsbpFileDetails_seach').value;}
		}
		else
		{
			if (obje.value=='') {obje.value = 'Search All Music'}
		
		}	
}

function fnDisps(obj){

document.getElementById('clsbpFileDetails_txtSea').value = 'Search ' + obj.innerHTML;
document.getElementById('clsbpFileDetails_seach').value = obj.innerHTML;

}

function fnsearchInformation(){
	var error="";
if(document.getElementById('clsbpFileDetails_txtSea').value.length <2 && document.getElementById('clsbpFileDetails_txtSea').value!="")
{

error = "search term should have two or more characters";

var url ="bpBuy.php";
window.location=url+"?msg="+error;	



return false;
}
	if((document.formheaderSearch.clsbpFileDetails_txtSea.value == "")){
		alert("Enter the keyword to search");
		return false;
	
	}
return true;
}




</SCRIPT>

<div id="header"> <a href="<?php if($_SESSION["USERID"]!=''){ echo "bpMyBopa.php";} else{ echo "index.php";}?>" id="logo">Bopaboo</a>
  <div id="topnav"> <a href="bpViewCart.php" target="_self"><img src="images/cart-icon.gif" width="20" height="15" border="0" alt="my cart" align="absmiddle"/>My Cart</a> <a href="bpChangeAccount.php" target="_self"> My Account</a> <a href="bpHelp.php" target="_self"> Help</a> </div>
  <div id="login">
    <?php if($_COOKIE['COOKIE_USERNAME']!="" && $_SESSION['USERID']!='') { print "Welcome&nbsp;".$_COOKIE['COOKIE_USERNAME']."!";?>
    <a href="bplogout.php" class="login">Sign-Out</a>
    <?php } else {  print  "Welcome!&nbsp;";?>
    <a href="bpSignIn.php?height=316&width=100px&modal=true&returnUrl=<?php $currentpageurl=getCurrentPage(); echo getCurrentPage();   ?>" class="thickbox">Sign-in</a>or<a href="bpUserSignup.php">Register</a>
    <?php } ?>
  </div>
  <form name="formheaderSearch" action="bpSearch.php" method="post" title="Search" id="searchbox" onsubmit="return fnsearchInformation();">
    <div id="listings">
      <ul>
        <li  class="top"><a href="#" id="1" onclick="fnDisps(this)">all</a></li>
        <li><a href="#" id="2" onclick="fnDisps(this)">artists</a></li>
        <li><a href="#" id="3" onclick="fnDisps(this)">albums</a></li>
        <li><a href="#" id="4" onclick="fnDisps(this)">songs</a></li>
        <li class="bottom"><a id="5" onclick="fnDisps(this)" href="#">sellers</a></li>
      </ul>
    </div>
    <input name="clsbpFileDetails_txtSearch" type="text" id="clsbpFileDetails_txtSea" value="Search All Music" onfocus="fnshows(this);" onblur="fnhides(this);"/>
    <input type="hidden"  name="clsbpFileDetails_seachCat" id="clsbpFileDetails_seach"/>
    <span class="spacing">
    <input type="image" src="images/go_btn.jpg" id="gobutton" />
    </span>
  </form>
  <a href="bpAdvSearch.php" class="advsearch"><img src="images/icon-arrow.png" alt="arrow" />&nbsp;&nbsp;Advanced Search</a>
  <div id="cls"></div>
  <?php
			  
			  	// To find current PHP page
			   	$script      =($_SERVER['SCRIPT_NAME']);
				$scriptArray = explode ("/",$script);
		
				if($_REQUEST['returnUrl']!=""){
				$scriptArray[2] = $_REQUEST['returnUrl']; }
			
			     // Arrays for holding tab selection values
				 $headerBuyArray     = array('bpBuy.php','bpSearch.php','bpViewCart.php','bpOrderDetails.php','bpPayment.php'); // Buy tab
				 $headerSellArray    = array('bpSell.php','bpSellLogged.php'); // Sell Tab
				 $headerMyBopaArray  = array('bpMyBopa.php','bpCreditEdit.php','bpCreditCardAdd.php','bpWithdraw.php','bpFeedback.php','bpBopaBank.php','bpWithdraw.php','bpAccountActivity.php','bpMyBopaMessageInbox.php','bpMyBopaMessageCompose.php'); // MyBopa tab
				 $headerBopaBoxArray = array('bpBopaBox.php','bpViewDetails.php'); // Bopabox tab
       
			  
              ?>
  <ul id="menu">
    <li id ="buytab"><a href="bpBuy.php" <?php	if(in_array($scriptArray[2],$headerBuyArray))echo 'class="current"'; ?> >Home</a></li>
    <li id="selltab"><a href="<?php if($_SESSION["USERID"]!=''){ echo "bpSellLogged.php";} else{ echo "bpSell.php";}?>" <?php if(in_array($scriptArray[2],$headerSellArray))echo 'class="current"'; ?>>Buy</a></li>
    <li id ="mybopatab"><a href="<?php if($_SESSION["USERID"]!=''){ echo "bpMyBopa.php";} else{ echo "bpBopaLogin.php?returnUrl=bpMyBopa.php";}?>"
					<?php if(in_array($scriptArray[2],$headerMyBopaArray))echo 'class="current"'; ?> >Sell</a></li>
    <li id ="bopaboxtab"><a href="<?php if($_SESSION["USERID"]!=''){ echo "bpBopaBox.php";} else{ echo "bpBopaLogin.php?returnUrl=bpBopaBox.php";}?>" 				                   <?php if(in_array($scriptArray[2],$headerBopaBoxArray))echo 'class="current"'; ?>>myBopa</a></li>
  </ul>
</div>