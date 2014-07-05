<script language="javascript" type="text/javascript">
function fn_resend(){
	
	var frm = document.frmresend;
    frm.clsbpUserLogin_action.value = "RESEND";

frm.submit();

return true;
}
</script>

<div id="container">	   
        <div id="pagehead">
        	<h1>Check your Email</h1>
      </div><form action="" method="post" name="frmresend">
        <div id="confirm-registration-01">
        
        <h1>Just one more step!</h1>
        <p>We have sent email to your address, <?php echo $clsbpUserLogin->vc_EmailId; ?> Please wait a few moments for the email to arrive. <br />
        In the email message from us, click the &quot;Activate Now&quot; link to confirm your registration.</p>
        <h2>Didn't receive the email from us?</h2>
  <p> 
       
* Check that your email address <?php echo $clsbpUserLogin->vc_EmailId; ?> is spelled correctly. <a href="bpChangeAccount.php">Need to change your email adderss?</a><br />
* Check your bulk or junk email folder. <br />
<input type="hidden" name="clsbpUserLogin_action" value="" />
      <input type="hidden" name="clsbpUserLogin_returnUrl" value="bpConfirmSignup.php?emailId=<?php echo $clsbpUserLogin->vc_EmailId; ?>">
      <input type="hidden" name="clsbpUserLogin_vc_EmailId" value="<?php echo $clsbpUserLogin->vc_EmailId; ?>" />
      <input type="hidden" name="clsbpUserLogin_bi_MemberId" value="<?php echo $clsbpUserLogin->bi_MemberId; ?>" />
      
* Still can't find it? <a href="javascript:void(0);" onclick="return fn_resend();">We can resend the email</a>.</p>
      </div></form>
    </div>
    