  <div id="container">
    <div id="signUplaside">
      <div class="roundedTab" id="signUp">
        <div class="t">
          <div class="tabOff"><h3 class="wide"><a href="<?= HTTP ?>bpChangeAccount.php">info</a></h3></div>
          <div class="tabOff"><h3 class="wide"><a href="<?= HTTPS ?>bpChangePassword.php">password</a></h3></div>
          <div class="tab"><h3 class="wide">notifications</h3></div>
          <div class="tabOff"><h3 class="wide"><a href="<?= HTTP ?>bpChangePreferences.php">preferences</a></h3></div>
          <div class="tr"></div>
        </div>
        <div class="c">
          <div class="cl">
            <!--add content-->
            <div class="resetPassword">
            	
              <form action="" method="post" name="frmNotifications" onsubmit="javascript: return valSubmit();">	
              	<input type="hidden" name="clsbpUserLogin_returnUrl" value=""/>
								<input type="hidden" name="clsbpUserLogin_action" value=""/>
                <ul id="signUpForm" style="margin-left:25px;">
                <li>
                	<div><h5>personal notifications</h5></div>
                	<div style="clear:both;"></div>
                	<ul style="margin-left:20px;">
                		<div><span><input name="clsbpUserLogin_chkNotify" type="checkbox"  id="chckbox" value="1" <?php echo $checkStatus1; ?>/></span><span style="margin-left:10px;">Enable email notifications when one of your songs have been sold</span></div>
                	</ul>
                	<div style="clear:both;"></div>
                	<div style="margin-top:10px;"><h5>system notifications</h5></div>
                	<div style="clear:both;"></div>
                	<ul style="margin-left:20px;">
                		<div><span><input name="clsbpUserLogin_chkNotifyFeatures" type="checkbox" id="chckbox" value="1" <?php echo $checkStatus2; ?>/></span><span style="margin-left:10px;">I want occasional email announcing new site features</span></div>
                		<div><span><input name="clsbpUserLogin_chkNotifyPromos" type="checkbox" id="chckbox" value="1" <?php echo $checkStatus3; ?>/></span><span style="margin-left:10px;">I want occasional email announcing promotions, coupons and other discount offers</span></div>
                	</ul>
                </li>
                <li>&nbsp;</li>
                <li>
                  <label>&nbsp;</label>
                  <!--<span class="rside"><a href="homeLoggedIn.html"><img src="../images/buttonSaveChanges.gif" alt="Save Changes" width="129" height="24" border="0" /></a></span></li>-->
                  <!-- <span class="rside btUpdateSettings"><a href="homeLoggedIn.html" style="float:left;"></a></span></li> -->
                  <span class="rside"><input type="image" align="top" name="form_submitted" src="images/update-setting.jpg" value="Send Email" id="btnupdatesetng"/></span></li>
              </ul>
                    
              </form>
               
            	<p>&nbsp;</p>
            </div>
        </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- signUp ends -->
    </div>
  </div>
