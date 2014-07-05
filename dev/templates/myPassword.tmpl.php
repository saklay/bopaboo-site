  <div id="container">
    <div id="signUplaside">
      <div class="roundedTab" id="signUp">
        <div class="t">
          <div class="tabOff"><h3 class="wide"><a href="<?php echo HTTP?>bpChangeAccount.php">info</a></h3></div>
          <div class="tab"><h3 class="wide">password</h3>
          </div><div class="tabOff"><h3 class="wide"><a href="<?php echo HTTP?>bpChangeNotifications.php">notifications</a></h3>
          </div><div class="tabOff"><h3 class="wide"><a href="myPreferences.html">preferences</a></h3>
          </div>
      			<!--<div class="loading"> <img src="../images/o2.gif" alt="loading" width="16" height="16" /> </div>    -->
      			
          <div class="tr"></div>
        </div>
        <div class="c">
          <div class="cl">
            <!--add content-->
            <div class="resetPassword">
            	
              <form action="" method="post" name="frmChngUserPasswd" >
                <ul id="signUpForm">
                <li>
                  <label for="curpassword">current password</label>
                  <span class="rside">
                  <input type="password" name="clsbpUserLogin_txtOldPassword" id="textfield" class="inputStyle" />
                  </span> </li>
                  
                <li>
                  <label for="npassword">new password</label>
                  <span class="rside">
                  <input type="password" name="clsbpUserLogin_txtPassword" id="clsbpUserLogin_txtPassword"  class="inputStyle" />
                  
                  </span></li>
                <li>
                  <label for="cpassword">confirm password</label>
                  <span class="rside">
                  <input type="password" name="clsbpUserLogin_txtConfirmation" id="clsbpUserLogin_txtConfirmation" class="inputStyle" />
                  </span></li>
                <li>&nbsp;</li>
                
                <li>
                  <label>&nbsp;</label>
                  <!--<span class="rside"><a href="homeLoggedIn.html"><img src="../images/buttonSaveChanges.gif" alt="Save Changes" width="129" height="24" border="0" /></a></span></li>-->
                  <span class="rside">
                  	<span class="btChangePassword"><a href="#" onclick="return fnValidate();" style="display:block;" name="form_submitted" value="Send Email" id="sendbtn"></a></span>
                  	<br /><span><a href="<?php echo HTTP?>bpForgotPassword.php">Click here if you have forgotten your password</a></span>
                	</span>
                  </li>
              </ul>
              		<input type="hidden" name="clsbpUserLogin_bi_MemberId" value="<?php echo $clsbpUserLogin->bi_MemberId ?>" />
    				<input type="hidden" name="clsbpUserLogin_returnUrl" value="" />
					<input type="hidden" name="clsbpUserLogin_action" value="" />
              </form>
               
            	<p>&nbsp;</p>
            </div>
        </div>
        <div class="b"><span class="br"></span></div>
      </div>
      <!-- signUp ends -->
    </div>
  </div>
  <!-- container ends-->
</div>
<!-- wrapper ends -->
