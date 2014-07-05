<script  language="javascript">
function fnEchecks(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("You have not entered a valid email address. Please try again.")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("You have not entered a valid email address. Please try again.")
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("You have not entered a valid email address. Please try again.")
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("You have not entered a valid email address. Please try again.")
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("You have not entered a valid email address. Please try again.")
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("You have not entered a valid email address. Please try again.")
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		    alert("You have not entered a valid email address. Please try again.")
		    return false
		 }

 		 return true					
	}
	



function fnValidates()
{
  
  	
    var emailID=document.form1.clsbpMailImport_username;

	if ((emailID.value==null)||(emailID.value=="")){
		alert("You have not entered a valid email address. Please try again.")
		emailID.focus()
		return false
	}
	if (fnEchecks(emailID.value)==false){
		emailID.value=""
		emailID.focus()
		return false
	}
	
	if(document.form1.clsbpMailImport_password.value == "")
	{
	alert("Enter Password");
	document.form1.clsbpMailImport_password.focus();
	return false;
	}
	 
	ajaxFunction(document.form1.clsbpMailImport_username.value,document.form1.clsbpMailImport_password.value,document.form1.clsbpMailImport_provider.value);

	return false;
}

function ajaxFunction(username,password,provider)
{

var xmlHttp;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  xmlHttp.onreadystatechange=function()
    {

	document.getElementById("content1").style.display = 'none';
	document.getElementById("content2").style.display = '';

 
    if(xmlHttp.readyState==4)
      {
      var s = xmlHttp.responseText;
	
		  if(s=="") {
		  
		 // alert('null');
		 	  document.getElementById("content1").style.display = '';
			  document.getElementById("content2").style.display = 'none';
		  	  document.getElementById("importEmailAddressGmail").style.display = '';
			  document.getElementById("importEmailAddressGmailImported").style.display = 'none';
			  document.getElementById('errordisplay').innerHTML ="Invalid username or password.";
		  }
			  
		  else if(s!=""){
		
			document.getElementById("importEmailAddressGmail").style.display = 'none';
			document.getElementById("importEmailAddressGmailImported").style.display = '';
			document.getElementById('importEmailAddressGmailImported').innerHTML =s;
			
		  }
      }
     
    }
  xmlHttp.open("GET","bpPostAccount.php"+"?user="+username+"&pass="+password+"&provider="+provider,true); 
  xmlHttp.send(null);
  }

/* Function to select check boxes*/
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
  
/* Function to grab friends list*/ 
function fn_GrabList(){

	var frm = document.frmGrab;
	frm.action="bpfriendsList.php";

	frm.submit();
} 
</script>
<div id="importEmailAddressGmail" style="display:">
  <form id="form1" name="form1" method="post" action="" onsubmit="return fnValidates();">
  <div class="top">
  	<h1>Import Email Addresses</h1>
    <a href="#" onClick="tb_remove();"><img src="images/btn-close1.jpg" alt="close" width="19" height="19" border="0" class="closenow" /></a>
   </div>
   
   
	<div class="contents" id="content1" style="display:">
    	<span class="hdimg">
        	<img src="images/icon-gmail.jpg" alt="Loading... Please wait" width="94" height="40" align="absmiddle" />         </span>
            <div id="errordisplay"></div>
         <span class="login">
   	  <label><span class="hdr">Username</span>
      <input name="clsbpMailImport_username" type="text" id="username" /></label>
            <label><span class="hdr">Password</span><input name="clsbpMailImport_password" type="password" id="password" /></label>
         	<label><span class="hdr">&nbsp;</span><input type="image" src="images/btn-signin.jpg" class="signin" /></label>
            <span class="hdr">&nbsp;</span><span class="forgotpass"><a target="_blank" href="https://www.google.com/accounts/ForgotPasswd?service=mail&fpOnly=1" >Forgot your Password?</a></span>
            <span class="commontext">We will not store your login. It will only be temporarily used to access your Gmail address book.</span>
         </span>
    </div>
    	<div class="contents" id="content2" style="display:none"><br /><br /><br /><img  src="images/loading.gif" alt="Loading... Please wait" width="74" height="59" align="absmiddle" /> Loading...<br /><br /><br /><br /><br /><br /><br /><br /></div>
        
        
    
    
<div class="bottom">Switch Accounts:<br />
    <a href="bpGmailImport.php?height=450&width=419px&modal=true&returnUrl=" class="thickbox">Gmail</a> | <a  href="bpYahooImport.php?height=450&width=419px&modal=true&returnUrl=" class="thickbox">Yahoo</a> | <a href="bpHotmailImport.php?height=450&width=419px&modal=true&returnUrl=" class="thickbox">Hotmail</a> | <a href="bpAOLImport.php?height=450&width=419px&modal=true&returnUrl=" class="thickbox">AOL</a> | <a href="bpOutlookImport.php?height=770&width=419px&modal=true&returnUrl=" class="thickbox">Outlook</a> | <a href="bpOutlookImport.php?height=770&width=419px&modal=true&returnUrl=" class="thickbox">Other</a></div>
<input name="clsbpMailImport_provider" type="hidden" value="G"/>
 <input type="hidden" name="clsbpMailImport_action" value=""/>
  </form>
</div>

<div id="importEmailAddressGmailImported" style="display:none">
</div>