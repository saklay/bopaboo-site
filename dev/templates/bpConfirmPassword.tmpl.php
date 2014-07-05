<script language="javascript" type="text/javascript">
function fn_resend(){
	
	var frm = document.frmresend;
	
frm.clsbpUserLogin_action.value = "FORGOTPASSWORD";

frm.submit();

return true;
}
</script>

  <div id="container">
    <div id="signUplaside">
      <div class="roundedTab" id="signUp">
        <div class="t"> 
          <div class="tabOff"><h3 class="selecttab wide"><a href="bpUserSignup.php" >sign up</a></h3></div>
          <div class="tab"><h3 class="wide">password</h3></div>
          <div class="tr"></div>
        </div>
        <div class="c">
          <div class="cl">
            <!--add content-->
            <form action="" method="post" name="frmresend">
                <div class="recoverPasswordConfirmationBox">
                <h1> just one more step!</h1><br />
                <p>We've sent a message to <?php echo $clsbpUserLogin->vc_EmailId; ?> that has all the instructions for resetting your password. If you don't recieve an email within the next hour, please submit your address agin.</p>
                <p>&nbsp;</p>
                <h1>didn't receive the email from us?</h1><br />
                <p> * Check your bulk or junk email folder.
                <br />* Still can't find it?
                <input type="hidden" name="clsbpUserLogin_action" value="" />
                <input type="hidden" name="clsbpUserLogin_returnUrl" value="bpConfirmPassword.php?emailId=<?php echo $clsbpUserLogin->vc_EmailId; ?>">
                <input type="hidden" name="clsbpUserLogin_vc_EmailId" value="<?php echo $clsbpUserLogin->vc_EmailId; ?>" />
                <a title="resend the email"  href="javascript:void(0);" onclick="return fn_resend();">We can resend the email</a>.
                </div>
            </form>
            <!--finish content-->
</div>
        </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- signUp ends -->
    </div>
    <!-- laside ends here -->
  </div>
