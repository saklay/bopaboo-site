<script>
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

var emailID=document.frmRegistration.clsbpUserLogin_txtEmail
	
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



if(document.frmRegistration.clsbpUserLogin_txtPassword.value == "")
{
alert("Enter Password");
document.frmRegistration.clsbpUserLogin_txtPassword.focus();
return false;
}
if(document.frmRegistration.clsbpUserLogin_txtPassword.value != document.frmRegistration.clsbpUserLogin_txtConfirmation.value) {
    alert('Your passwords do not match. Please type more carefully.');
	document.frmRegistration.clsbpUserLogin_txtConfirmation.focus();
    return false;
  }
 
if(document.frmRegistration.clsbpUserLogin_txtDisname.value == "")
{
alert("Enter Display Name");
document.frmRegistration.clsbpUserLogin_txtDisname.focus();
return false;
}
if(document.frmRegistration.clsbpUserLogin_txtFname.value == "")
{
alert("Enter First Name");
document.frmRegistration.clsbpUserLogin_txtFname.focus();
return false;
}
if(document.frmRegistration.clsbpUserLogin_txtLname.value == "")
{
alert("Enter Last Name");
document.frmRegistration.clsbpUserLogin_txtLname.focus();
return false;
}
if(document.frmRegistration.recaptcha_response_field.value == "")
{
alert("Enter Captcha");
document.frmRegistration.recaptcha_response_field.focus();
return false;
}
if(!document.frmRegistration.clsbpUserLogin_chkTerms.checked)
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
</script>
<div id="container">
    <ul id="breadcrumb-links">
        <li><a href="#">Home</a></li>
        <li><img src="../images/arrow-breadcrumb.gif" alt="breadcrumb" />&nbsp;&nbsp;Sign Up</li>
    </ul>

            

<div id="LARGECOL_LEFT">
         <div id="signup-box-top-menu">
            <dl>
            <dt>Already a member? <a href="portfolio.htm" title="Portfolio">Click Here to Log In </a></dt>
            </dl>
        </div>
                                        <div id="signup-box">
                                            <div id="signup-box-top"></div>
                                                    <div id="signup-box-mid">
                                                    <h1>Sign Up</h1> 
                                                    <form  method="post" name="frmRegistration" onsubmit="return fnValidate();">
                                                    <label for="textfield">Email</label>
                                                    <input id="name" name="clsbpUserLogin_txtEmail" value="<?php $clsbpUserDetails->txtEmail; ?>" class="inputstyle"><br />
                                                    
                                                    <label for="textfield2">Password</label>
                                                    <input type="text" name="clsbpUserLogin_txtPassword" id="phone"  class="inputstyle" /><br />
                                                    
                                                    <label for="textfield3">Confirm Password</label>
                                                    <input id="clsbpUserLogin_txtConfirmation" name="confirmpassowrd" class="inputstyle"/> <br /> 
                                                    
                                                    
                                                    <hr />
                                                    
                                                    <label for="textfield4">Display Name</label>
                                                    <input id="displayname" name="clsbpUserLogin_txtDisname" value="<?php $clsbpUserDetails->txtEmail; ?>"  class="inputstyle"/><br />
                                                    <label for="textfield5">First Name</label>
                                                    <input id="FirstName" name="clsbpUserLogin_txtFname" value="<?php echo $clsbpUserDetails->vc_FirstName; ?>" class="inputstyle"/><br />
                                                    
                                                    <label for="textfield6">Last Name</label>
                                                    <input id="LastName" name="clsbpUserLogin_txtLname" value="<?php  echo $clsbpUserDetails->vc_LastName; ?>"  class="inputstyle"/>
                                                    <br />
                                                    
                                                    <label for="select">Country</label>
                                                    
                                                    <select name="clsbpUserLogin_optCountry" id="querrytype" class="inputstyle_month">
                                                    <option>Please select your country</option>
                                                    <?php echo $coutryList	; ?>
                                                    </select>
                                                    
                                                    <br />
                                                    
                                                    
                                                    <label for="month">Date of Birth</label>
                                                    <select name="month" size="1" class="inputstyle_month" id="month">
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                    </select>
                                                    
                                                    
                                                    <select name="clsbpUserLogin_optDay" size="1" class="inputstyle_month" id="month2">
                                                    <option>Date</option>
                                                    <?php echo $dayList; ?>
                                                    </select>
                                                    <select name="clsbpUserLogin_optYear" size="1" class="inputstyle_month" id="month3">
                                                    <option>Year</option>
                                                    <?php echo $yearList; ?>
                                                    </select>
                                                    
                                                    
                                                    <br />
                                                    <label for="Gender">Gender</label>
                                                    <input type="radio" name="clsbpUserLogin_optGender" id="radio-male" value="1" />
                                                    Male
                                                    <input type="radio" name="clsbpUserLogin_optGender" id="radio-male2" value="0" />
                                                    Female <br />
                                                    <label for="areyouahuman">Are You a Human?</label>
                                                    <input id="LastName" name="LastName" class="inputstyle">
                                                    <br />
                                                    <div id="captcha">Captcha here!!</div>
                                                    <label for="confirmpassowrd">Do You Agree</label>
                                                    <input name="clsbpUserLogin_checkbox" type="checkbox" class="checkboxYes"/>
                                                    <div class="doyouagreetext">By signing up, you accept the terms of use and confirm you're 13 or older.</div>
                                                    <br />
                                                    <br />
                                                    <div id="submitbutton">
                                                    <input type="image" align="top" name="form_submitted" src="images/register1.jpg" value="Send Email"  width="131px" height="26px"/>
                                                    </div>
                                                    </form>
                                                    </div>
                                        <div id="signup-box-bottom"></div>
                                        
                            </div>
                            
                            
                            </div>
    <div id="SMALLCOL_RIGHT">
            <div class="smallcol-right-box-top-img"></div>
            <div class="smallcol-right-box-top-img-body">TBD</div>
            <div class="smallcol-right-box-bottom-img"></div>
            <div class="smallcol-right-box-top-img"></div>
                <div class="smallcol-right-box-top-img-body">
        <p><span class="bluecolored">Your privacy is important to us </span>bopaboo does not rent or sell your personal information to third parties without your consent. To learn more, read our <a href="#">privacy policy</a>.</p>
        <p>&nbsp;</p>
        <p><img src="images/trustee-logo-big.jpg" width="79" height="109" /></p>
                </div>
            <div class="smallcol-right-box-bottom-img"></div>
    </div>
</div>