 <div id="container">
      <div id="pagehead-bopabank">
      
          <h1>My Account Settings</h1>
        
        
      </div>
    <div id="bopabank">
    	<form action="" method="post" name="frmCngAc" onsubmit="return fnValidate();">
    	<input type="hidden" name="clsbpUserLogin_bi_MemberId" value="<?php echo $clsbpUserLogin->bi_MemberId ?>" />
    	<input type="hidden" name="clsbpUserLogin_returnUrl" value="" />
    	<input type="hidden" name="clsbpUserLogin_action" value="" />
          <table width="914" border="0" cellspacing="0" cellpadding="0" class="datalist">
                <tr>
                  <td><ul id="bopabank-menu">
                    <li class="accountactivity"><a href="#"  class="currentsel">Info</a></li>
                    <li class="withdrawfunds"><a href="bpChangePassword.php">Password</a></li>
                    <li class="managecredit"><a href="bpChangeNotifications.php">Notification</a></li>
                    <li class="managecredit"><a href="bpChangePreferences.php">Preferences</a></li>
                  </ul></td>
                </tr>
                <tr>
                    <td class="hdr">&nbsp;</td>
            </tr>
                <tr>
                  <td valign="top" class="bdy"><div id="formrbox-my-account">
                    <p align="center">
				<font color="#f36734"><strong><?php  echo displayMessage();?></strong></font>
     		   </p>
                    <label for="textfield">Display Name</label>
                    <p><?if(isset($clsbpUserLogin->vc_EmailId)){echo $clsbpUserLogin->vc_DisplayName;}?>&nbsp;<span style="color:#A8A8A8">(display  names can not be changed)</span></p>
  <br />
  <label for="textfield2">Email Address</label>
  <input type="text" name="clsbpUserLogin_txtEmail" id="textfield2"  class="inputstyle01" value="<?if(isset($clsbpUserLogin->vc_EmailId)){echo $clsbpUserLogin->vc_EmailId;}?>"/>
  <br />
  <br />
  <label for="clsbpUserLogin_txtFname">First Name</label>
  <input type="text" name="clsbpUserLogin_txtFname" id="textfield3"  class="inputstyle01" value="<?if(isset($clsbpUserLogin->vc_EmailId)){echo $clsbpUserLogin->vc_FirstName;}?>"/>
  <br />
  <br />
  <label for="clsbpUserLogin_txtLname">Last Name</label>
  <input type="text" name="clsbpUserLogin_txtLname" id="textfield4"  class="inputstyle01" value="<?if(isset($clsbpUserLogin->vc_EmailId)){echo $clsbpUserLogin->vc_LastName;}?>"/>
  <br />
  <br />
  <label for="select">Country</label>
   <select name="clsbpUserLogin_optCountry" id="select"  class="inputstyle02" >
            <?php echo $coutryList; ?>
    </select>
  <br />
  <br />
  <label for="month">Date of Birth</label>
  <select name="clsbpUserLogin_optMonth" size="1" class="inputstyle03" id="month">
    <option value="0">Month</option>
    <?php echo $monthList; ?>
  </select>
  <select name="clsbpUserLogin_optDay" size="1" class="inputstyle03" id="month2">
    <option value="0" >Date</option>
    <?php echo $dayList; ?>
  </select>
  <select name="clsbpUserLogin_optYear" size="1" class="inputstyle03" id="month3">
    <option value="0">Year</option>
    <?php echo $yearList; ?>
  </select>
  <br />
  <br />
  <label for="Gender">Gender</label>
  <input  type="radio"  value="1"  name="clsbpUserLogin_optGender" value="radio" id="RadioGroup1_0" <?php if($clsbpUserLogin->b_Gender==1){echo "checked=true";}?> />
  <label class="chckboxlabel"> Male</label>
  <input  type="radio" value="0" name="clsbpUserLogin_optGender" value="radio" id="RadioGroup1_1" <?php if($clsbpUserLogin->b_Gender==0){echo "checked=true";}?> />
  <label class="chckboxlabel" >Female</label>
  <br />
  <br />
  <label>My URL</label>
                    <p><a href="http://staging.bopaboo.com/dev/bpMemberStore.php?mS=<?php echo $_COOKIE['COOKIE_USERNAME']  ;?>" style="text-decoration:none; color:#000000">http://staging.bopaboo.com/dev/<?php echo $_COOKIE['COOKIE_USERNAME'] ;?></a></p>
  <input type="image" align="top" name="form_submitted" src="images/save-changes-btn.jpg" value="Send Email" id="sendbtn"/>
                  </div>
                  <br /></td>
                </tr>
                <tr>
                  <td class="ftr">&nbsp;</td>
                </tr>
                </form>
          </table>
      <div style="clear:both;"></div>

        
        <div>
        </div>
        </div>
    </div>
    
    </div>