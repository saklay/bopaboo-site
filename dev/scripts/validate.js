function fnEcheck(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("You have not entered a valid email address.  Your email will be used to login and to confirm this account.  Please try again.")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("You have not entered a valid email address.  Your email will be used to login and to confirm this account.  Please try again.")
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("You have not entered a valid email address.  Your email will be used to login and to confirm this account.  Please try again.")
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("You have not entered a valid email address.  Your email will be used to login and to confirm this account.  Please try again.")
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("You have not entered a valid email address.  Your email will be used to login and to confirm this account.  Please try again.")
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("You have not entered a valid email address.  Your email will be used to login and to confirm this account.  Please try again.")
		    return false
		 }
		
		 if (str.indexOf(" ")!=-1){
		    alert("You have not entered a valid email address.  Your email will be used to login and to confirm this account.  Please try again.")
		    return false
		 }

 		 return true					
	}

function fnValidate()
{

var emailID=document.frmRegistration.txtEmail
	
	if ((emailID.value==null)||(emailID.value=="")){
		alert("You have not entered a valid email address.  Your email will be used to login and to confirm this account.  Please try again.")
		emailID.focus()
		return false
	}
	if (fnEcheck(emailID.value)==false){
		emailID.value=""
		emailID.focus()
		return false
	}



if(document.frmRegistration.txtPassword.value == "")
{
alert("Enter Password");
document.frmRegistration.txtPassword.focus();
return false;
}
if(document.frmRegistration.txtPassword.value != document.frmRegistration.txtConfirmation.value) {
    alert('Your passwords do not match. Please type more carefully.');
	document.frmRegistration.txtConfirmation.focus();
    return false;
  }
 
if(document.frmRegistration.txtDisname.value == "")
{
alert("Enter Display Name");
document.frmRegistration.txtDisname.focus();
return false;
}
if(document.frmRegistration.txtFname.value == "")
{
alert("Enter First Name");
document.frmRegistration.txtFname.focus();
return false;
}
if(document.frmRegistration.txtLname.value == "")
{
alert("Enter Last Name");
document.frmRegistration.txtLname.focus();
return false;
}
if(document.frmRegistration.recaptcha_response_field.value == "")
{
alert("Enter Captcha");
document.frmRegistration.recaptcha_response_field.focus();
return false;
}
if(!document.frmRegistration.chkTerms.checked)
{
alert("Please read the guidelines and check the box below");
return false; 
}

return true;
}
var xmlHttp

function validate(str,value)
{
if (str.length==0)
  { 
  document.getElementById("txtDisnameResponse").innerHTML=""
  return
  }
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  } 
var url="./ajax/validate.php"
url=url+"?q="+str
url=url+"&v="+value
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChangedDname;
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
} 

function stateChangedDname() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 document.getElementById("txtDisnameResponse").innerHTML=xmlHttp.responseText 
 } 
}

function GetXmlHttpObject()
{
var xmlHttp=null;
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
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}

