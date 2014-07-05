<script language="javascript">
function fnEcheck(str) {



		var at="@"

		var dot="."

		var lat=str.indexOf(at)

		var lstr=str.length

		var ldot=str.indexOf(dot)

		if (str.indexOf(at)==-1){

		   alert("Please enter your valid email address.")

		   return false

		}



		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){

		   alert("Please enter your valid email address.")

		   return false

		}



		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){

		    alert("Please enter your valid email address.")

		    return false

		}



		 if (str.indexOf(at,(lat+1))!=-1){

		    alert("Please enter your valid email address.")

		    return false

		 }



		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){

		    alert("Please enter your valid email address.")

		    return false

		 }



		 if (str.indexOf(dot,(lat+2))==-1){

		    alert("Please enter your valid email address.")

		    return false

		 }

		

		 if (str.indexOf(" ")!=-1){

		    alert("Please enter your valid email address.")

		    return false

		 }



 		 return true					

	}


function fnsubmitInformation() {

	var frm = document.forgotpass;

	

	if(frm.clsbpUserLogin_txtEmail.value ==""){
		alert("Please enter your valid email address");
		frm.clsbpUserLogin_txtEmail.value = frm.clsbpUserLogin_txtEmail.value;
		frm.clsbpUserLogin_txtEmail.focus();
		return false;
	}
if (fnEcheck(frm.clsbpUserLogin_txtEmail.value)==false){

		frm.clsbpUserLogin_txtEmail.value=""

		frm.clsbpUserLogin_txtEmail.focus()

		return false

	}
	emailId = frm.clsbpUserLogin_txtEmail.value;
frm.clsbpUserLogin_returnUrl.value = "bpConfirmPassword.php?emailId="+emailId;
frm.clsbpUserLogin_action.value = "FORGOTPASSWORD";


return true;
}
</script>
<?
//$_SESSION["BPMESSAGE"] .= "Email address does not exist";
?>


  <div id="container">
    <div id="signUplaside">
      <div class="roundedTab" id="signUp">
        <div class="t">
          <div class="tabOff"><h3 class="selecttab wide"> <a href="bpUserSignup.php" >sign up</a></h3></div>
          <div class="tab"><h3 class="wide">password</h3></div>
          <div class="tr"></div>
        </div>
        <div class="c">
          <div class="cl">
            <!--add content-->
            <div class="recoverPasswordBox">
           		<h1> forgot your password?</h1><br />
            
            	<p>don't worry! simply type your email address below and we'll send you instructions on how to reset your password.</p>
              <form action="" method="post" name="forgotpass" id="signupform" onsubmit="return fnsubmitInformation();">
              <input type="hidden" name="clsbpUserLogin_action" value=""/>
        			<input type="hidden" name="clsbpUserLogin_returnUrl" value="">
                	<label><strong>email address</strong> </label><span class="rside"><input type="text"  name="clsbpUserLogin_txtEmail" class="inputStyle" /></span>
                	<span class="btResetPassword" style="float:left;"><input type="image" id="sendbtn" src="<?php echo IMAGEPATH ?>transparent.png" width="130" height="25" border=0 /></span>
                	<div style="clear:both;"></div>
              </form>
              
                <h2><span class="greyText">Not a bopaboo member?</span><a href="bpUserSignup.php"> Register Now!</a></h1>
            	<p>&nbsp;</p>
            </div>
            <!--finish content-->
          </div>
        </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- signUp ends -->
    </div>
    <!-- laside ends here -->
  </div>
