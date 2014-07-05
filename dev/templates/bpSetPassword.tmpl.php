<script>
		var RecaptchaOptions = {
		theme: 'custom',
		lang: 'en',
		custom_theme_widget: 'recaptcha_widget'
		};
</script>
<script language="javascript">
function fnValidate()
{
	
	var newpass=document.frmSetPassword.clsbpUserLogin_txtPassword
	var confpass=document.frmSetPassword.clsbpUserLogin_vc_NewPassword
	
	if ((newpass.value==null)||(newpass.value=="")){
		alert("Please enter new password")
		newpass.focus()
		return false
	}
	if ((confpass.value==null)||(confpass.value=="")){
		alert("Please confirm new password")
		confpass.focus()
		return false
	}
if (newpass.value != confpass.value ){
		alert("Your Passwords Does Not Match.Please type More Carefully")
		confpass.focus()
		return false
	}
	document.frmSetPassword.clsbpUserLogin_action.value = "NEWPASSWORD";		

if(document.frmSetPassword.recaptcha_response_field.value == "")
	{
	alert("Enter Captcha");
	document.frmSetPassword.recaptcha_response_field.focus();
	return false;
	}

return true
}
</script>

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
            <form action="" method="post" enctype="multipart/form-data" name="frmSetPassword" onsubmit="return fnValidate()">
              <ul id="signUpForm">
                <li>
                  <label>display name</label>
                  <span class="rside">
                  <?php echo $clsbpUserLogin->vc_DisplayName;?>
                  </span> </li>
                <li>
                  <label>email address</label>
                  <span class="rside">
                  <?php echo $clsbpUserLogin->vc_EmailId;?>
                  </span> </li>
                <li>
                  <label for="password">new password</label>
                  <span class="rside">
                  <input type="password" name="clsbpUserLogin_txtPassword" id="newpass" class="inputStyle" />
                  </span> </li>
                <li>
                  <label for="cpassword">confirm password </label>
                  <span class="rside">
                  <input type="password" name="clsbpUserLogin_vc_NewPassword" id="confpass" class="inputStyle" />
                  </span> </li>
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
                <li>&nbsp;</li>
                <li>
                  <label>&nbsp;</label>
                  <span class="rside">
                  	<input type="hidden" name="clsbpUserLogin_action" value=""/>
  									<input type="hidden" name="clsbpUserLogin_returnUrl" value="index.php">
  									<input type="hidden" name="clsbpUserLogin_bi_MemberId" value="<?php echo $clsbpUserLogin->bi_MemberId;?>">
  									<input type="hidden" name="privateKey" value="<?php echo $privatekey; ?>"/>
                  	<input type="image" align="top" name="form_submitted" src="<?php echo IMAGEPATH ?>btn-resetpassword.png" value="reset password" border="0" />
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
  </div>
