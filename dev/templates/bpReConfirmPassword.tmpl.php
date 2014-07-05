<script language="javascript" type="text/javascript">
function fn_resend(){
	
	var frm = document.frmresend;
    frm.clsbpUserLogin_action.value = "PASSWORDSEND";

frm.submit();

return true;
}
</script>

<div id="container">
  <div id="pagehead">
    <h1>Check your Email</h1>
  </div> <form action="" method="post" name="frmresend">
  <div id="confirm-registration-01">
    <h1>Just one more step!</h1>
    <p>We've sent a message to <?php echo $clsbpUserLogin->vc_EmailId; ?> that has all the instructions for resetting your password.<br />
      If you don't receive an email within the next hour, please submit your address again.</p>
    <h2>Didn't receive the email from us?</h2>
    <p> * Check your bulk or junk email folder.<br />
      * Still can't find it?
      <input type="hidden" name="clsbpUserLogin_action" value="" />
      <input type="hidden" name="clsbpUserLogin_submitted" value="1" />
      <input type="hidden" name="clsbpUserLogin_returnUrl" value="bpReConfirmPassword.php?emailId=<?php echo $clsbpUserLogin->vc_EmailId; ?>">
      <input type="hidden" name="clsbpUserLogin_vc_EmailId" value="<?php echo $clsbpUserLogin->vc_EmailId; ?>" />
      <a title="Resend the email"  href="javascript:void(0);" onclick="return fn_resend();">We can resend the email</a>.
  
    
    </p>
  </div>  </form>
</div>