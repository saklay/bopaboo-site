<div id="container">
    <div id="signUplaside">
      <div class="roundedTab" id="signUp">
        <div class="t">
          <div class="tab"><h3 class="wide">info</h3></div>
          <div class="tabOff"><h3 class="wide"><a href="<?php echo HTTP?>bpChangePassword.php">password</a></h3>
          </div><div class="tabOff"><h3 class="wide"><a href="<?php echo HTTP;?>bpChangeNotifications.php">notifications</a></h3>
          </div><div class="tabOff"><h3 class="wide"><a href="myPreferences.html">preferences</a></h3>
          </div>
          	  <!--<div class="loading"><img src="images/o2.gif" alt="loading" width="16" height="16" /> </div>-->
          <div class="tr"></div>
        </div>
        <div class="c">
          <div class="cl">
            <!--add content-->
            <form action="" method="post" name="frmCngAc" >
              <ul id="signUpForm">
                <li>
                  <label for="dispName">display name</label>
                  <span class="rside"><?php if(isset($clsbpUserLogin->vc_EmailId)){echo $clsbpUserLogin->vc_DisplayName;}?></span></li>
                <li>
                  <label for="email">email address</label>
                  <span class="rside">
                  <input type="text"  name="clsbpUserLogin_txtEmail" id="textfield2" value="<?php if(isset($clsbpUserLogin->vc_EmailId)){echo $clsbpUserLogin->vc_EmailId;}?>" class="inputStyle" />
                  </span>  </li>
                <li>
                  <label for="fName">first name</label>
                  <span class="rside">
                  <input type="text"  name="clsbpUserLogin_txtFname" id="textfield3" value="<?php if(isset($clsbpUserLogin->vc_EmailId)){echo $clsbpUserLogin->vc_FirstName;}?>" class="inputStyle" />
                  </span> </li>
                <li>
                  <label for="lName">last name</label>
                  <span class="rside">
                  <input type="text" name="clsbpUserLogin_txtLname" id="textfield4" value="<?php if(isset($clsbpUserLogin->vc_EmailId)){echo $clsbpUserLogin->vc_LastName;}?>" class="inputStyle" />
                  </span> </li>
                <li>
                  <label>country</label>
                  <span class="rside">
                  <select name="clsbpUserLogin_optCountry" id="select"  class="inputstyle02" >
                    	<?php echo $coutryList; ?>
                  </select>
                  </span> </li>
                <li>
                  <label>birthday</label>
                  <span class="rside">
                  <select name="clsbpUserLogin_optMonth" size="1" class="inputstyle03" id="month">
					    <option value="0">Month</option>
					    <?php echo $monthList; ?>
                  </select>
                  &nbsp;
                  <select name="clsbpUserLogin_optDay" size="1" class="inputstyle03" id="month2">
					    <option value="0" >Date</option>
					    <?php echo $dayList; ?>
                  </select>
                  &nbsp;
                  <select name="clsbpUserLogin_optYear" size="1" class="inputstyle03" id="month3">
					    <option value="0">Year</option>
					    <?php echo $yearList; ?>
                  </select>
                  </span> </li>
                <li>
                  <label>gender</label>
                  <span class="rside">
                  		<input  type="radio"  value="1"  name="clsbpUserLogin_optGender" value="radio" id="RadioGroup1_0" <?php if($clsbpUserLogin->b_Gender==1){echo "checked=true";}?> />
                  		 Male
  						<input  type="radio" value="0" name="clsbpUserLogin_optGender" value="radio" id="RadioGroup1_1" <?php if($clsbpUserLogin->b_Gender==0){echo "checked=true";}?> />
  						Female
  				  </span> 
  				</li>
                <li>
                  <label for="myStore">mystore</label>
                  <span class="rside"><a href="<?= HTTP?>bpMemberStore.php?mS=<?php echo $_COOKIE['COOKIE_USERNAME']  ;?>" style="text-decoration:none; color:#000000">http://staging.bopaboo.com/dev/<?php echo $_COOKIE['COOKIE_USERNAME'] ;?></a></span></li>
                <li>&nbsp;</li>
                <li>
                  <label>&nbsp;</label>
                  <!--<span class="rside"><a href="homeLoggedIn.html"><img src="../images/buttonSaveChanges.gif" alt="Save Changes" width="129" height="24" border="0" /></a></span></li>-->
                  <span class="rside btSaveChanges"><a href="#" onclick="return fnValidate();" name="form_submitted" style="float:left;" value="Send Email" id="sendbtn"></a></span></li>
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
  <!-- container ends -->
</div>
<!-- wrapper ends -->

<!--<div id="footer">
	
    <ul id="box001">
        <li><h3>Get your bopaboo on!</h3></li>
        <li>let's start buying!</li>
        <li> let's start selling!</li>
        <li>let's invite your friends!</li>
  </ul>
        
<ul id="box002">
        <li><h4>Business &amp; Media </h4></li>
        <li><a href="#" rel="facebox">Press Releases</a></li>
        <li><a href="#">In the News</a></li>
        <li><a href="#" target="_blank">Advertising Opportunities</a></li>
        <li><a href="#" target="_blank">Partnership Opportunities</a></li>
  </ul>
        
<ul id="box003">
        <li><h4>Company </h4></li>
        <li><a href="#" rel="facebox">About Us</a></li>
        <li><a href="#">Management</a></li>
        <li><a href="#" target="_blank">Blog</a></li>
        <li><a href="#" target="_blank"><strong>We're Hiring!</strong></a></li>
        <li><a href="#" target="_blank">Contact Us</a></li>
    </ul>
        
    <ul id="box004">
        <li><h4>Legal Info </h4></li>
        <li><a href="privacyPolicy.html" rel="facebox">Privacy Policy</a></li>
        <li><a href="termsOfServices.html">Terms of Use</a></li>
        <li><a href="#" target="_blank">site map</a></li>
  </ul>
	
<ul id="box005">
        <li><h4>Account </h4></li>
        <li><a href="#" rel="facebox">FAQ</a></li>
        <li><a href="#">Account</a></li>
        <li><a href="#" target="_blank">bopaBank</a></li>
        <li><a href="#" target="_blank">Messages</a></li>
        <li><a href="#" target="_blank">Feedback</a></li>
    </ul>
    
  <div id="footerBottom"><span>bopaboo, LLC.</span> &copy; Copyright  2008 All rights reserved.</div>
</div>
<!-- footer ends 
</body>
</html>
