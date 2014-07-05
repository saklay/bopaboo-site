<script>
		var RecaptchaOptions = {
		theme: 'custom',
		lang: 'en',
		custom_theme_widget: 'recaptcha_widget'
		};
</script>
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

function fnValidate() {
	
	// var email ="";
	// var errorlist = "";
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
	
	if(document.frmRegistration.clsbpUserLogin_txtPassword.value == "") {
		alert("Enter Password");
		document.frmRegistration.clsbpUserLogin_txtPassword.focus();
		return false;
	}

	if(document.frmRegistration.clsbpUserLogin_txtPassword.value != document.frmRegistration.clsbpUserLogin_txtConfirmation.value) {
		alert('Your passwords do not match. Please type more carefully.');
		document.frmRegistration.clsbpUserLogin_txtConfirmation.focus();
    return false;
	}
	
	if(document.frmRegistration.clsbpUserLogin_txtDisname.value == "") {
		alert("Enter Display Name");
		document.frmRegistration.clsbpUserLogin_txtDisname.focus();
		return false;
	}

	if(document.frmRegistration.clsbpUserLogin_txtFname.value == "") {
		alert("Enter First Name");
		document.frmRegistration.clsbpUserLogin_txtFname.focus();
		return false;
	}

	if(document.frmRegistration.clsbpUserLogin_txtLname.value == "") {
		alert("Enter Last Name");
		document.frmRegistration.clsbpUserLogin_txtLname.focus();
		return false;
	}

	if(document.frmRegistration.clsbpUserLogin_optMonth.value == 0) {
		alert("Enter Month of Birth");
		document.frmRegistration.clsbpUserLogin_optMonth.focus();
		return false;
	}
	
	if(document.frmRegistration.clsbpUserLogin_optDay.value == 0) {
 		alert("Enter Day of Birth");
		document.frmRegistration.clsbpUserLogin_optDay.focus();
		return false;
	}

	if(document.frmRegistration.clsbpUserLogin_optYear.value == 0) {
 		alert("Enter Year of Birth");
		document.frmRegistration.clsbpUserLogin_optYear.focus();
		return false;
	}

	var months = document.frmRegistration.clsbpUserLogin_optMonth.value;
	var days = document.frmRegistration.clsbpUserLogin_optDay.value;
	var years = document.frmRegistration.clsbpUserLogin_optYear.value;
	if ((months==04 || months==06 || months==09 || months==11) && days==31) {
 		// errorlist +="\n Please enter a valid date!";
 		alert("Please enter a valid date!");
 		return false;
	}
	if (months == 02) { // check for february 29th
		var isleap = (years % 4 == 0 && (years % 100 != 0 || years % 400 == 0));
		if (days>29 || (days==29 && !isleap)) {
			// errorlist +="\n Please enter a valid date!";
			alert("Please enter a valid date!");
 			return false;
		}
	}
	if(document.frmRegistration.recaptcha_response_field.value == "") {
		alert("Please enter the text from the image in the Are You a Human? field");
		document.frmRegistration.recaptcha_response_field.focus();
		return false;
	}
	
	if(!document.frmRegistration.clsbpUserLogin_chkTerms.checked) {
		alert("Please read the guidelines and check the box below");
		document.frmRegistration.clsbpUserLogin_chkTerms.focus();
		return false;
	}
	
	emailId = document.frmRegistration.clsbpUserLogin_txtEmail.value;
	document.frmRegistration.clsbpUserLogin_returnUrl.value = "bpMyBopa.php";
	document.frmRegistration.clsbpUserLogin_action.value="SAVE";
	
}

var xmlHttp

function validate(str,value) {
	if (str.length==0) { 
  	document.getElementById("txtDisnameResponse").innerHTML=""
  	return
  }
  
	xmlHttp=GetXmlHttpObject()
	
	if (xmlHttp==null) {
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

function stateChangedDname() { 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") { 
		document.getElementById("txtDisnameResponse").innerHTML=xmlHttp.responseText 
	} 
}

function GetXmlHttpObject() {
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
<?php
 $msg = $_SESSION["BPMESSAGE"];


?>

<script type="text/javascript" src="scripts/validation.js"></script>
<script type="text/javascript" src="scripts/commonFunctions.js"></script>
  <div id="container">
    <div id="signUplaside">
      <div class="roundedTab" id="signUp">
        <div class="t">
          <div class="tab"><h3 class="selecttab wide">sign up</h3></div>
          <div class="tabOff"><h3 class="wide"><a href="bpBopaLogin.php">sign in</a></h3></div>
          <div class="tr"></div>
        </div>
        <div class="c">
          <div class="cl">
            <!--add content-->
            <div class="errormesg"><?php echo displayMessage(); ?></div>
            <form  method="post" name="frmRegistration" id="signupform" onsubmit="return fnValidate();">
              <ul id="signUpForm">
                <li>
                  <label for="email">email</label>
                  <span class="rside">
                  <input type="text"  name="clsbpUserLogin_txtEmail" value="<?php echo $clsbpUserLogin->vc_EmailId; ?>"  id="textfield"  class="inputStyle" onkeypress="allowCharNum(event,'clsbpUserLogin_txtEmail');" onblur="fnValidateEmail('vc_EmailId');"/>
                  </span> <!-- <span class="tick"></span><span class="errorMsg">invalid username</span> --></li>
                <li>
                  <label for="password">password</label>
                  <span class="rside">
                  <input type="password" name="clsbpUserLogin_txtPassword" id="textfield2"  class="inputStyle" onKeyUp="validatePassword(event);"/>
                  </span> </li>
                <li>
                  <label for="cpassword">confirm password </label>
                  <span class="rside">
                  <input type="password" name="clsbpUserLogin_txtConfirmation" id="textfield3"  class="inputStyle" onKeyUp="confirmPassword(event);"/>
                  </span> </li>
                <li>
                  <label for="dispName">display name</label>
                  <span class="rside">
                  <input type="text"  name="clsbpUserLogin_txtDisname" value="<?php echo $clsbpUserLogin->vc_DisplayName; ?>"  id="textfield4"  class="inputStyle" maxlength="20" onkeypress="allowCharNum(event,'clsbpUserLogin_txtDisname');" onblur="fnValidateDisplayName('vc_DisplayName');"/>
                  </span> </li>
                <li>
                  <label for="fName">first name</label>
                  <span class="rside">
                  <input type="text" name="clsbpUserLogin_txtFname" value="<?php echo $clsbpUserLogin->vc_FirstName; ?>"  id="textfield5"  class="inputStyle" />
                  </span> </li>
                <li>
                  <label for="lName">last name</label>
                  <span class="rside">
                  <input name="clsbpUserLogin_txtLname" value="<?php  echo $clsbpUserLogin->vc_LastName; ?>"  type="text"  class="inputStyle" id="textfield6" />
                  </span> </li>
                <li>
                  <label>country</label>
                  <span class="rside">
                  <select name="clsbpUserLogin_optCountry" id="select"  class="selectCountry" >
                  	<?php echo $coutryList; ?>
                  </select>
                  </span> </li>
                <li>
                  <label>date of birth</label>
                  <span class="rside">
                  <select name="clsbpUserLogin_optMonth" size="1" class="selectMonth" id="month">
                  	<option value="0">month</option>
                  	<?php echo $monthList; ?>
                  </select>
                  <select name="clsbpUserLogin_optDay" size="1" class="selectDate" id="month2">
                  	<option value="0" >date</option>
                  	<?php echo $dayList; ?>
                  </select>
                  <select name="clsbpUserLogin_optYear" size="1" class="selectYear" id="month3">
                  	<option value="0">year</option>
                  	<?php echo $yearList; ?>
                  </select>
                  </span> </li>
                <li>
                  <label>gender</label>
                  <span class="rside">
                  <input type="radio" name="clsbpUserLogin_optGender" value="1" class="nostyle"/>
                  male
                  <input type="radio" name="clsbpUserLogin_optGender"  value="0" class="nostyle" />
                  female</span> </li>
                <li style="height: 150px;">
                  <label for="secquestion">security question</label>
                  <span class="rside">
            <?php
				// Get a key from http://recaptcha.net/api/getkey
				//$publickey = "6Ld4qwEAAAAAAJCgNtxJSYehzqOKsxEHHeT-N0u-";
				//$privatekey = "6Ld4qwEAAAAAAKFmfhpIbNzncqrfXb_TVBYF6P7P";

	            if(isset($errorList['Captcha'])) $err=$errorList['Captcha']; else $err=''; $error='';
                echo recaptcha_get_html(PUBLICCAPTCHA, $error,  $err);
          ?>      	
                  </span> </li>
                <li>
                  <label>do you agree</label>
                  <span class="rside">
                  <input name="clsbpUserLogin_chkTerms" type="checkbox" class="checkboxYes"/>
                  &nbsp;by signing up, you accept the terms of use and confirm you're 13 or older.</span> </li>
                <li>&nbsp;</li>
                <li>
                  <label>&nbsp;</label>
                  <span class="rside">
                  	<input type="hidden" name="privateKey" value="<?php echo PRIVATECAPTCHA; ?>" />
                  	<input type="hidden"  id="clsbpUserLogin_action" name="clsbpUserLogin_action" value="">
                  	<input type="hidden"  id="clsbpUserLogin_returnUrl" name="clsbpUserLogin_returnUrl" value="bpConfirmSignup.php">
                  	<input type="hidden" id=""  />
                  	<input type="image" align="top" name="form_submitted" src="<?php echo IMAGEPATH ?>btnRegister.jpg" value="Send Email"  width="129" height="24" border="0" />
                  </span></li>
              </ul>
            </form>
            <!--finish content-->
          </div>
        </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- signUp ends -->
    </div>
    <!-- laside ends here -->
    <div id="signUpraside">
    	<div class="rounded" id="whyJoinBox">  
             <div class="t">
                 <div class="tr"></div>
             </div>
           <div class="c">
             <div class="cl"> 
             <!--add content-->
           	     <div class="pad">
                   <h1 class="hdrWhyJoin">why join bopaboo?</h1>
                    <div class="list1 top">
                        <p> legally sell unwanted music</p>
                    </div>
                    <div class="list2">
                        <p class="oneliner">buy DRM-Free music as low as $.25</p>
                   </div>
                <div class="list3">
                        <p> you're own digital music store  </p>
                   </div>
                  <div class="list4">
                        <p> unlimited digital music locker  </p>
                   </div>
                   <div class="list5">
                        <p> it's free  </p>
                   </div>
                 </div>
              <!--finish content--> 
           </div>
           </div>
             <div class="b"><span class="br"></span></div>
      </div>
      <!-- whyJoinBox ends -->
      <div class="rounded" id="privacyStatement">  
             <div class="t">
                 <div class="tr"></div>
             </div>
           <div class="c">
             <div class="cl"> 
             <!--add content-->
           	     <div class="pad">
                   <p>bopaboo understands that user privacy is key to our success.</p>
					<p>already a member?<br />
				   please read our <a href="bpPrivacyPolicy.php">privacy policy</a>                   </p>
           	     </div>
              <!--finish content--> 
           </div>
           </div>
             <div class="b"><span class="br"></span></div>
      </div>
      <!-- whyJoinBox ends -->
    </div>
    <!-- raside ends here -->
  </div>

<?php
if(trim($msg) <> ""){

	if(strstr($msg,'Display Name') <> ""){
?>
<script language="JavaScript">

	document.frmRegistration.clsbpUserLogin_txtDisname.value ="";
	document.frmRegistration.clsbpUserLogin_txtDisname.focus();

</script>
<?php

	}
}
?>
